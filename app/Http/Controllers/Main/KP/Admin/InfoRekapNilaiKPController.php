<?php

namespace App\Http\Controllers\Main\KP\Admin;

use App\Http\Controllers\Main\MainController;
use Illuminate\Http\Request;
use App\User;
use App\Disposisi;
use App\Data;
use PDF;

class InfoRekapNilaiKPController extends MainController
{
    public function __invoke ($opsi = null)
    {
    	if ($opsi == 'cetak')
    	{
    		$pdf = PDF::loadView('main.kp.admin.info-rekap-nilai-kp-cetak', [
    			'semua_mahasiswa' => Disposisi::where('progress', '>', 18)
            						->join('users', 'users.id', '=', 'disposisi.user_id')
            						->orderBy('users.nomor_induk', 'DESC')
            						->select('disposisi.*')
            						->get(),
    			'cetak' => true
	        ])->setPaper('a4');
	        return $pdf->stream('info-rekap-nilai-kp.pdf');
    	}

    	return $this->customView('kp.admin.info-rekap-nilai-kp', [
            'nav_item_active' => 'kp',
            'subtitle' => 'Info Rekap Nilai KP',

            'semua_mahasiswa' => Disposisi::where('progress', '>', 18)
            						->join('users', 'users.id', '=', 'disposisi.user_id')
            						->orderBy('users.nomor_induk', 'DESC')
            						->select('disposisi.*')
            						->get(),
        ]);
    }
}
