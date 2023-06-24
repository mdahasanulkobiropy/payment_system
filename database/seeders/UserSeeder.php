<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
            'phone' => '01630342799',
            'role' => 'admin',
            'balance' => '500',
            'creator_id' => '1',
            'status' => '1'
        ]);
        User::create([
            'name' => 'user',
            'email' => 'user@user.com',
            'password' => Hash::make('12345678'),
            'phone' => '01886342799',
            'role' => 'user',
            'balance' => '500',
            'creator_id' => '1',
            'status' => '1'

        ]);
        User::create([
            'name' => 'user1',
            'email' => 'user1@user.com',
            'password' => Hash::make('12345678'),
            'phone' => '01913211217',
            'role' => 'user',
            'balance' => '500',
            'creator_id' => '1',
            'status' => '1'
        ]);
        User::create([
            'name' => 'agent',
            'email' => 'agent@agent.com',
            'password' => Hash::make('12345678'),
            'phone' => '01990452789',
            'role' => 'agent',
            'balance' => '500',
            'creator_id' => '1',
            'status' => '1'
        ]);
        User::create([
            'name' => 'Bank',
            'email' => 'bank@bank.com',
            'password' => Hash::make('12345678'),
            'phone' => '01911111111',
            'role' => 'bank',
            'balance' => '500',
            'creator_id' => '1',
            'status' => '1'
        ]);
    }
}
