<?php

use Illuminate\Database\Seeder;

class ApisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
 factory(App\Api::class, 1)->create([
        'id' => '1',
        ]);
    }
}
