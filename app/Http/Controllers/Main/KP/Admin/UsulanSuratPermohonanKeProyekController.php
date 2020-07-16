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
use PDF;

class UsulanSuratPermohonanKeProyekController extends MainController
{
    public function view()
    {
    	$data = new Data();

    	return $this->customView('kp.admin.usulan-surat-permohonan-ke-proyek', [
            'nav_item_active' => 'kp',
            'subtitle' => 'Usulan Surat Permohonan Ke Proyek',

            'semua_mahasiswa' => Disposisi::where('progress', 5)->orderBy('updated_at')->get()
        ]);
    }

    public function cetak($nim)
    {
        $user = User::where(['category' => 'mahasiswa', 'nomor_induk' => $nim]);
        if (!$user->exists()) {
            return abort(404);
        }

        $disposisi = Disposisi::where(['user_id' => $user->first()->id]);
        if ($disposisi->first()->progress < 5) {
            return abort(404);
        }

        $pdf = PDF::loadView('main.kp.admin.surat-permohonan-ke-proyek', [
            'mahasiswa' => $user->first()
        ])->setPaper('a4');
        return $pdf->stream($nim.'-surat-permohonan-ke-proyek.pdf');
    }

    public function process($nim, Request $request)
    {
    	$user = User::where(['category' => 'mahasiswa', 'nomor_induk' => $nim]);
    	if (!$user->exists()) {
    		return abort(404);
    	}

        $validate_rules = [
            'status' => 'required'
        ];
        $validate_errors = [
            'required' => 'Anda belum menetapkan status'
        ];

        $validator = Validator::make($request->all(), $validate_rules, $validate_errors);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $disposisi = Disposisi::where(['user_id' => $user->first()->id]);

        if ($request->input('status') == 'diterima')
        {
            Data::where(['user_id' => $user->first()->id, 'category' => 'data_surat_permohonan_ke_proyek'])->update([
                'verified' => true
            ]);

            $disposisi->update([
                'progress' => 6
            ]);

            return redirect()->back()->with('success', 'Surat Permohonan telah ditetapkan sebagai "Diterima"');
        }
        elseif ($request->input('status') == 'ditolak')
        {
            $disposisi->update([
                'progress' => 4
            ]);

            return redirect()->back()->with('error', 'Surat Permohonan telah ditetapkan sebagai "Ditolak"');
        }
    }
}
