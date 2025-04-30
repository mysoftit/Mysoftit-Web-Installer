<?php

namespace MySoftITWebInstaller\Services;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

class DatabaseService
{
    public function importDatabase()
    {
        try {
            // Run migrations
            Artisan::call('migrate', ['--force' => true]);

            // Run seeders if needed
            Artisan::call('db:seed', ['--force' => true]);

            return true;
        } catch (Exception $e) {
            throw new Exception('Database import failed: ' . $e->getMessage());
        }
    }

    public function createAdminUser($data)
    {
        try {
            $user = DB::table('users')->insertGetId([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Assign admin role if using permissions system
            if (class_exists('Spatie\Permission\Models\Role')) {
                $adminRole = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'admin']);
                $userModel = config('auth.providers.users.model');
                $user = $userModel::find($user);
                $user->assignRole($adminRole);
            }

            return $user;
        } catch (Exception $e) {
            throw new Exception('Failed to create admin user: ' . $e->getMessage());
        }
    }
}