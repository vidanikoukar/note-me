<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // تعریف مجوزها
        $permissions = [
            'manage-users',
            'edit-users',
            'delete-users',
            'manage-content',
            'preview-content',
            'manage-roles',
        ];

        // ایجاد یا به‌روزرسانی مجوزها
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // تعریف نقش‌ها
        $roles = ['super-admin', 'admin', 'editor', 'user'];

        // ایجاد یا به‌روزرسانی نقش‌ها
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role, 'guard_name' => 'web']);
        }

        // اختصاص مجوزها به نقش‌ها
        $superAdmin = Role::findByName('super-admin', 'web');
        $superAdmin->syncPermissions(Permission::all());

        $admin = Role::findByName('admin', 'web');
        $admin->syncPermissions(['manage-users', 'manage-content', 'preview-content']);

        $editor = Role::findByName('editor', 'web');
        $editor->syncPermissions(['manage-content', 'preview-content']);

        $user = Role::findByName('user', 'web');
        $user->syncPermissions(['manage-content']);

        // Find the main admin user and assign the super-admin role
        $user = User::where('email', 'admin@example.com')->first();
        if ($user) {
            $user->syncRoles(['super-admin']);
        }
    }
}