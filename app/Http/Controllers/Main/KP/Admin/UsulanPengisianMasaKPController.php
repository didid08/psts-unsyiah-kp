<?php

namespace App\Http\Controllers\Main\KP\Admin;

use App\Http\Controllers\Main\MainController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use App\UserRole;
use App\Disposisi;
use App\Data;
use App\Setting;

class UsulanPengisianMasaKPController extends MainController
{
    public function view()
    {
    	$data = new Data();

    	return $this->customView('kp.admin.usulan-pengisian-masa-kp', [
            'nav_item_active' => 'kp',
            'subtitle' => 'Usulan Pengisian Masa KP',

            'semua_mahasiswa' => Disposisi::where('progress', 15)->orderBy('updated_at')->get(),
            'masa_kerja_praktek_1' => $data->getDataMultiple('masa-kerja-praktek-1'),
            'masa_kerja_praktek_2' => $data->getDataMultiple('masa-kerja-praktek-2'),
            'surat_keterangan_telah_selesai_kp' => $data->getDataMultiple('surat-keterangan-telah-selesai-kp'),
            'buku_laporan_kp' => $data->getDataMultiple('buku-laporan-kp'),
            'lembar_pengesahan_kp' => $data->getDataMultiple('lembar-pengesahan-kp'),
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
	                'progress' => 14
	            ]);
	            return redirect()->back()->with('error', 'Usulan telah ditolak');
    		break;

    		case 'accept':

    			Data::where(['user_id' => $user->first()->id, 'name' => 'masa-kerja-praktek-1'])->update([
                    'verified' => true
                ]);
    			Data::where(['user_id' => $user->first()->id, 'name' => 'masa-kerja-praktek-2'])->update([
                    'verified' => true
                ]);
                Data::where(['user_id' => $user->first()->id, 'name' => 'surat-keterangan-telah-selesai-kp'])->update([
                    'verified' => true
                ]);
                Data::where(['user_id' => $user->first()->id, 'name' => 'buku-laporan-kp'])->update([
                    'verified' => true
                ]);
                Data::where(['user_id' => $user->first()->id, 'name' => 'lembar-pengesahan-kp'])->update([
                    'verified' => true
                ]);

	            $disposisi->update([
                    'progress' => 16
                ]);

                return redirect()->back()->with('success', 'Usulan telah diterima');
    		break;
    		default:
    			return abort(404);
    	}
    }
}
