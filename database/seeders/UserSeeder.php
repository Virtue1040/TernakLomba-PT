<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Users_detail;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $default = array(
            array(
                'username' => 'Admin',
                'email' => 'rafbbbb@gmail.com',
                'password' => 'password',
                'first_name' => 'Rafi',
                'last_name' => 'Hidayat',
                'bio' => '',
                'gender' => 'male',
                'born_date' => '2000-01-01',
                'id_role' => 1,
            ),
        );

        // Create Admin Starter Account
        foreach ($default as $users) {
            $user = User::create([
                'username' => $users['username'],
                'email' => $users['email'],
                'password' => Hash::make($users['password']),
            ]);
            $userdetail = Users_detail::create([
                'user_id' => $user->id_user,
                'first_name' => $users['first_name'],
                'last_name' => $users['last_name'],
                'bio' => $users['bio'],
                'gender' => $users['gender'],
                'born_date' => $users['born_date']
            ]);

            // $streamChatService = new StreamChatService;
            // $streamChatService->createUser(strval($user->id_user), $users['first_name'] . ' ' . $users['last_name'], null);
            
            $userx = User::find($user->id_user);
            $userx->assignRole([$users['id_role']]);
        }
    }
}
