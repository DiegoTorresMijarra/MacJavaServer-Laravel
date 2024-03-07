<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert([
            [
                'name' => 'diego',
                'email' => 'diego@admin.es',
                'password' => bcrypt('diego'),
                'rol' => 'ADMIN',
                'avatar'=>'8e37c6fa-1667-498e-ac63-d06de4d52f83.webp',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'admin',
                'email' => 'admin@admin.es',
                'password' => bcrypt('Admin2024'),
                'rol' => 'ADMIN',
                'avatar'=>'8e37c6fa-1667-498e-ac63-d06de4d52f83.webp',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'user',
                'email' => 'user@user.es',
                'password' => bcrypt('User2024'),
                'rol' => 'USER',
                'avatar'=>User::$AVATAR_DEFAULT,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}
