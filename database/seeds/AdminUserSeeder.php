<?php

use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        \DB::statement("SET FOREIGN_KEY_CHECKS=0");

        // \DB::table('users')->truncate();

        \DB::table('users')->insert(array(
            0 =>
            array(
                'id' => 1,
                'firstname' => 'Khedut Unity',
                'lastname' => 'App Admin',
                'username' => 'khedutunity_app',
                'email' => 'khedut.unity@gmail.com',
                'password' => bcrypt('123456'),
                'is_admin' => 1,
                'created_at' => '2017-08-03 17:04:00',
                'updated_at' => '2017-08-03 17:04:00',
                'deleted_at' => NULL,
            ),
        ));

        \DB::statement("SET FOREIGN_KEY_CHECKS=1");
    }

}
