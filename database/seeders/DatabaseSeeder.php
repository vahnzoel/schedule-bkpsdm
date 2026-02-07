<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $AdminRole = Role::create(['name' => 'admin']);
        $UserRole = Role::create(['name' => 'user']);

        $AdminUser = User::firstOrCreate([
            'username' => 'admin',
        ], [
            'name' => 'Administrator',
            'username' => 'admin',
            'bidang_id' => 0,
            'password' => Hash::make('12345'),
        ]);

        $AdminUser->assignRole($AdminRole);

        $User = User::firstOrCreate([
            'username' => 'ppik',
        ], [
            'name' => 'PPIK',
            'username' => 'ppik',
            'bidang_id' => 1,
            'password' => Hash::make('12345'),
        ]);

        $User->assignRole($UserRole);
    }
}
