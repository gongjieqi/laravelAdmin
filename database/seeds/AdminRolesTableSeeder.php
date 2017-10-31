<?php

use Illuminate\Database\Seeder;

class AdminRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('admin_roles')->insert([
            'id'=>1,
            'name'=>'admin',
            'display_name'=>'系统管理员',
        ]);

        DB::table('admin_role_user')->insert([
            'admin_id'=>1,
            'admin_roles_id'=>1,
        ]);
    }
}
