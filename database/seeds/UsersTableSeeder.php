<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->username = 'admin';
        $user->email = '-';
        $user->password = bcrypt('admin');
        $user->status = '1';
        $user->role_id = '1';
        $user->save();
    }
}
