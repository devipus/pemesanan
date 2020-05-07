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
        $user=new User();
        $user->name='rahmi';
        $user->username='rahmi12';
        $user->password=bcrypt('rahmi');
        $user->save();
    }
}
