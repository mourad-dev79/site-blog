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
        $user = App\User::create([
            'name' => 'admin',
            'email' => 'admin@admin.fr',
            'password' => bcrypt('admin123'),
            'admin' => 1
        ]);

        App\Profile::create([
            'user_id'=>$user->id,
            'avatar' => 'uploads/avatars/1.jpg',
            'about' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sequi corporis omnis voluptate impedit perferendis unde minus sed, saepe, vel facere ipsam alias odit dolorem repellat illo praesentium corrupti iusto veniam?',
            'facebook' => 'facebook.com',
            'youtube' => 'youtube.com'

        ]);
    }
}
