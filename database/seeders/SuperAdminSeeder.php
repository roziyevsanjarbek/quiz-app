<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SuperAdminSeeder extends Seeder
{
    public function run()
    {
        // 1) ADMIN roli bor-yo‘qligini tekshiramiz
        $roleId = DB::table('roles')->where('name', 'admin')->value('id');

        // Yo‘q bo‘lsa yaratamiz
        if (! $roleId) {
            $roleId = DB::table('roles')->insertGetId([
                'name' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 2) Superadmin foydalanuvchisi
        $user = User::firstOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        // 3) pivotga biriktiramiz
        DB::table('role_user')->updateOrInsert(
            ['user_id' => $user->id, 'role_id' => $roleId],
            ['created_at' => now(), 'updated_at' => now()]
        );

        echo "Superadmin created and role attached.\n";
    }
}
