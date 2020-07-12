<?php

namespace App\Http\Controllers\Main\KP\KoorProdi;

use App\Http\Controllers\Main\MainController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use App\UserRole;
use App\Disposisi;
use App\Data;
use App\Setting;

class PersetujuanUsulanKelengkapanDokumenAdministrasiController extends MainController
{
    public function view()
    {
    	$data = new Data();

    	return $this->customView('kp.koor-prodi.persetujuan-usulan-kelengkapan-dokumen-administrasi', [
            'nav_item_active' => 'kp',
            'subtitle' => 'Persetujuan Usulan Kelengkapan Dokumen Administrasi',

            'semua_mahasiswa' => Disposisi::where('progress', 22)->orderBy('updated_at')->get(),
            'kelengkapan_dokumen_administrasi' => $data->getDataMultiple('kelengkapan-dokumen-administrasi')
        ]);
    }

    public function process($nim, $opsi, Request $request)
    {
    	$user = User::where(['category' => 'mahasiswa', 'nomor_induk' => $nim]);
    	if (!$user->exists()) {
    		return abort(404);
    	}

    	$disposisi = Disposisi::where(['user_id' => $user->first()->id]);

    	switch ($opsi)
    	{
    		case 'decline':
    			$disposisi->update([
	                'progress' => 20
	            ]);
	            return redirect()->back()->with('error', 'Usulan telah ditolak');
    		break;

    		case 'accept':

                Data::where(['user_id' => $user->first()->id, 'name' => 'kelengkapan-dokumen-administrasi'])->update([
                    'verified' => true
                ]);

	            $disposisi->update([
                    'progress' => 23
                ]);

                return redirect()->back()->with('success', 'Usulan telah diterima');
    		break;
    		default:
    			return abort(404);
    	}
    }
}
