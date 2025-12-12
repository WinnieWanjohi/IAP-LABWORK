<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of roles.
     */
    public function index()
    {
        // Get roles with user count and paginate
        $roles = Role::withCount('users')->paginate(10);
        
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new role.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created role in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:roles,name',
            'slug' => 'required|string|max:255|unique:roles,slug|regex:/^[a-z0-9-]+$/',
            'description' => 'nullable|string|max:500',
        ], [
            'slug.regex' => 'Slug can only contain lowercase letters, numbers, and hyphens.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create the role
        Role::create($validator->validated());

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role created successfully!');
    }

    /**
     * Display the specified role.
     */
    public function show(Role $role)
    {
        // Load users with the role
        $role->load(['users' => function($query) {
            $query->latest()->take(10);
        }])->loadCount('users');
        
        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified role.
     */
    public function edit(Role $role)
    {
        // Load users count
        $role->loadCount('users');
        
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified role in storage.
     */
    public function update(Request $request, Role $role)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'slug' => 'required|string|max:255|unique:roles,slug,' . $role->id . '|regex:/^[a-z0-9-]+$/',
            'description' => 'nullable|string|max:500',
        ], [
            'slug.regex' => 'Slug can only contain lowercase letters, numbers, and hyphens.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Update the role
        $role->update($validator->validated());

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role updated successfully!');
    }

    /**
     * Remove the specified role from storage.
     */
    public function destroy(Role $role)
    {
        // Check if role has users
        if ($role->users()->count() > 0) {
            return redirect()->route('admin.roles.index')
                ->with('error', 'Cannot delete role that has users assigned. Please reassign users first.');
        }

        // Delete the role
        $role->delete();

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role deleted successfully!');
    }
}