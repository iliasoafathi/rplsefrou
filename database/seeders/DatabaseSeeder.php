<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\Admin;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'admin']);
        $moderatorRole = Role::firstOrCreate(['name' => 'moderator', 'guard_name' => 'admin']);

            // Create default admin user
            $admin = Admin::firstOrCreate(
                ['email' => 'admin@rplsefrou.local'],
                [
                    'name' => 'Super Admin',
                    'password' => Hash::make('password'),
                    'role' => 'admin',
                ]
            );

        // Assign role
        if (! $admin->hasRole($adminRole)) {
            $admin->assignRole($adminRole);
        }

            // Seed sample content
            $this->call(ContentSeeder::class);
            $this->call(MemberSeeder::class);
    }
}
