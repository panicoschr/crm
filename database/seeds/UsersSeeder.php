<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    factory(App\User::class, 1)->create([
        'email' => 'admin@admin.com',
        'password' => Hash::make('password'),
        ]);
    }
}
