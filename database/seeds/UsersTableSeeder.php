<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'username' => 'admin',
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin'),
                'role' => 'admin',
                'phone' => '08124583875',
                'gender' => 'Male',
                'photo' => null,
                'birthday' => '1997-01-01',
            ],
            [
                'username' => 'ahmad',
                'name' => 'Ahmad',
                'email' => 'ahmad@gmail.com',
                'password' => bcrypt('qwe123'),
                'role' => 'member',
                'phone' => '08981064875',
                'gender' => 'Male',
                'photo' => 'pict1.jpg',
                'birthday' => '1997-01-01',
            ],
            [
                'username' => 'halim',
                'name' => 'Halim',
                'email' => 'halim@gmail.com',
                'password' => bcrypt('qwe123'),
                'role' => 'member',
                'phone' => '08981064875',
                'gender' => 'Female',
                'photo' => 'pict2.jpg',
                'birthday' => '1997-01-01',
            ]
        ]);
    }
}
