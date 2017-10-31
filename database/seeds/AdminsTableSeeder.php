<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory('App\Admin', 1)->create([
            'id'=>1,
            'name'=>'admin',
            'password' => bcrypt('123456')
        ]);
    }
}
