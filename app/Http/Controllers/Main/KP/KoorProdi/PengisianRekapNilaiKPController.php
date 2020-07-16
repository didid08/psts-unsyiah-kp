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
use PDF;

class PengisianRekapNilaiKPController extends MainController
{
    public function view()
    {
    	$data = new Data();

    	return $this->customView('kp.koor-prodi.pengisian-rekap-nilai-kp', [
            'nav_item_active' => 'kp',
            'subtitle' => 'Pengisian Rekap Nilai KP',

            'semua_mahasiswa' => Disposisi::where('progress', 18)->orderBy('updated_at')->get(),
            'buku_laporan_kp' => $data->getDataMultiple('buku-laporan-kp'),
            'lembar_pengesahan_kp' => $data->getDataMultiple('lembar-pengesahan-kp'),
        ]);
    }

    public function cetakRekapNilaiKP ($nim)
    {
        $user = User::where(['category' => 'mahasiswa', 'nomor_induk' => $nim]);
        if (!$user->exists()) {
            return abort(404);
        }

        $userRole = new UserRole();
        $role = $userRole->myRoles();

        if (isset($role->mhs)) {
            if ($user->first()->nomor_induk != User::myData('nomor_induk')) {
                return abort(404);
            }
        }

        $disposisi = Disposisi::where(['user_id' => $user->first()->id]);
        if ($disposisi->first()->progress < 18) {
            return abort(404);
        }

        if (isset($role->mhs) && $disposisi->first()->progress < 19) {
            return abort(404);
        }

        $pdf = PDF::loadView('main.kp.koor-prodi.rekap-nilai-kp', [
            'mahasiswa' => $user->first()
        ]);
        return $pdf->stream($nim.'-rekap-nilai-kp.pdf');
    }

    public function process($nim, Request $request)
    {
        $user = User::where(['category' => 'mahasiswa', 'nomor_induk' => $nim]);
        if (!$user->exists()) {
            return abort(404);
        }

        $disposisi = Disposisi::where(['user_id' => $user->first()->id]);
		$disposisi->update([
			'progress' => 19
		]);

    	return redirect()->back()->with('success', 'Berhasil menetapkan Rekap Nilai KP untuk mahasiswa bernama '.$user->first()->nama.' ('.$user->first()->nomor_induk.')');
    }
}
