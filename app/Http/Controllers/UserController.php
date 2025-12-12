<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $search = $request->input('search');
    $status = $request->input('status');
    $role = $request->input('role');

    $users = User::with('role')
        ->when($search, function ($query, $search) {
            return $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhereHas('role', function ($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        })
        ->when($status === 'active', function ($query) {
            return $query->where('is_active', true);
        })
        ->when($status === 'inactive', function ($query) {
            return $query->where('is_active', false);
        })
        ->when($role, function ($query, $role) {
            return $query->whereHas('role', function ($q) use ($role) {
                $q->where('slug', $role);
            });
        })
        ->latest()
        ->paginate(10);

    $roles = Role::all();
    
    return view('users.index', compact('users', 'roles', 'search', 'status', 'role'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role_id' => ['required', 'exists:roles,id'],
            'phone' => ['nullable', 'string', 'max:20'],
            'is_active' => ['boolean'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'phone' => $request->phone,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user->load('role');
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'role_id' => ['required', 'exists:roles,id'],
            'phone' => ['nullable', 'string', 'max:20'],
            'is_active' => ['boolean'],
        ]);

        // Update password if provided
        if ($request->filled('password')) {
            $request->validate([
                'password' => ['confirmed', Rules\Password::defaults()],
            ]);
            
            $user->password = Hash::make($request->password);
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'phone' => $request->phone,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Prevent deleting yourself
        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully.');
    }

    /**
     * Toggle user active status.
     */
    public function toggleStatus(User $user)
    {
        // Prevent deactivating yourself
        if ($user->id === auth()->id() && $user->is_active) {
            return redirect()->route('users.index')
                ->with('error', 'You cannot deactivate your own account.');
        }

        $user->update([
            'is_active' => !$user->is_active
        ]);

        $status = $user->is_active ? 'activated' : 'deactivated';
        
        return redirect()->route('users.index')
            ->with('success', "User {$status} successfully.");
    }

    /**
     * Show user's activity log (simplified version).
     */
    public function activity(User $user)
    {
        // This is a simple version. You can expand with actual activity logs
        $user->load('role');
        $lastLogin = $user->last_login_at 
            ? $user->last_login_at->diffForHumans() 
            : 'Never';
            
        return view('users.activity', compact('user', 'lastLogin'));
    }
}