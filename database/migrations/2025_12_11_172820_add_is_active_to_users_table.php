<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Check if columns exist before adding them
            
            if (!Schema::hasColumn('users', 'role_id')) {
                $table->foreignId('role_id')->nullable()->after('password')->constrained()->onDelete('set null');
            }
            
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable()->after('role_id');
            }
            
            if (!Schema::hasColumn('users', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('phone');
            }
            
            if (!Schema::hasColumn('users', 'last_login_at')) {
                $table->timestamp('last_login_at')->nullable()->after('is_active');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Remove columns if they exist
            $columns = ['role_id', 'phone', 'is_active', 'last_login_at'];
            
            foreach ($columns as $column) {
                if (Schema::hasColumn('users', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};