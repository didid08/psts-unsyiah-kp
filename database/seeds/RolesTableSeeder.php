<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'admin',
        	'display_name' => 'Administrator'
        ]);
        DB::table('roles')->insert([
            'name' => 'koor-prodi',
        	'display_name' => 'Koordinator Prodi'
        ]);
        DB::table('roles')->insert([
            'name' => 'ketua-kel-keahlian',
        	'display_name' => 'Ketua Kelompok Keahlian'
        ]);
        DB::table('roles')->insert([
            'name' => 'pembimbing',
        	'display_name' => 'Pembimbing'
        ]);
        DB::table('roles')->insert([
            'name' => 'pembahas',
        	'display_name' => 'Pembahas'
        ]);
        DB::table('roles')->insert([
            'name' => 'mhs',
        	'display_name' => 'Mahasiswa'
        ]);
    }
}
