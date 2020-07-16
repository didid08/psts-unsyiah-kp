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

class UsulanSuratBalasanDariProyekController extends MainController
{
    public function view()
    {
    	$data = new Data();

    	return $this->customView('kp.admin.usulan-surat-balasan-dari-proyek', [
            'nav_item_active' => 'kp',
            'subtitle' => 'Usulan Surat Balasan Dari Proyek',

            'semua_mahasiswa' => Disposisi::where('progress', 7)->orderBy('updated_at')->get(),
            'surat_balasan_dari_proyek' => $data->getDataMultiple('surat-balasan-dari-proyek')
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
	                'progress' => 6
	            ]);
	            return redirect()->back()->with('error', 'Usulan telah ditolak');
    		break;

    		case 'accept':

                Data::where(['user_id' => $user->first()->id, 'name' => 'surat-balasan-dari-proyek'])->update([
                    'verified' => true
                ]);

	            $disposisi->update([
                    'progress' => 8
                ]);

                return redirect()->back()->with('success', 'Usulan telah diterima');
    		break;
    		default:
    			return abort(404);
    	}
    }
}
