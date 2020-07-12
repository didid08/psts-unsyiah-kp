<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//Admin
        DB::table('user_roles')->insert([
        	'user_id' => 1,
        	'role_id' => 1
        ]);

        //Koordinator Prodi
		DB::table('user_roles')->insert([
        	'user_id' => 1136,
        	'role_id' => 2
        ]);

		//KK Keahlian
        DB::table('user_roles')->insert([
        	'user_id' => 1137,
        	'role_id' => 3
        ]);
        DB::table('user_roles')->insert([
        	'user_id' => 1138,
        	'role_id' => 3
        ]);
        DB::table('user_roles')->insert([
        	'user_id' => 1139,
        	'role_id' => 3
        ]);
        DB::table('user_roles')->insert([
        	'user_id' => 1140,
        	'role_id' => 3
        ]);
        DB::table('user_roles')->insert([
        	'user_id' => 1141,
        	'role_id' => 3
        ]);

        //Pembimbing
        for ($i = 2; $i <= 67; $i++) {
        	DB::table('user_roles')->insert([
        		'user_id' => $i,
        		'role_id' => 4
        	]);
        }


        //Pembahas
		for ($i = 2; $i <= 67; $i++) {
        	DB::table('user_roles')->insert([
        		'user_id' => $i,
        		'role_id' => 5
        	]);
        }

        //Mahasiswa
        for ($i = 68; $i <= 1068; $i++) {
        	DB::table('user_roles')->insert([
        		'user_id' => $i,
        		'role_id' => 6
        	]);
        }
    }
}
