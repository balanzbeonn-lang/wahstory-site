<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = collect(
            [ 
                [
                    'title' => 'Mr.',
                    'firstname' => 'Pavan',
                    'lastname' => 'Kumar',
                    'photo' => 'pavanpic.webp',
                    'phone' => '9258584360',
                    'email' => 'pavankumar@elementshrs.com'
                ],
                [
                    'title' => 'Miss.',
                    'firstname' => 'Anjali',
                    'lastname' => 'Sharma',
                    'photo' => 'anjalipic.jpg',
                    'phone' => '9192837465',
                    'email' => 'anjali.sharma@example.com'
                ],
                [
                    'title' => 'Mr.',
                    'firstname' => 'Ravi',
                    'lastname' => 'Sharma',
                    'photo' => 'ravipic.png',
                    'phone' => '9328475612',
                    'email' => 'ravi.m@techsol.com'
                ],
                [
                    'title' => 'Miss.',
                    'firstname' => 'Neha',
                    'lastname' => 'Singh',
                    'photo' => 'nehaimage.gif',
                    'phone' => '9213748560',
                    'email' => 'neha.k@designs.com'
                ]
            ]
        );

        $users->each(function($user){
            user::insert($user);
        });


        
    }
}
