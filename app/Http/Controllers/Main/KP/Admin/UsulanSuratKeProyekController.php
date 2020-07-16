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

class UsulanSuratKeProyekController extends MainController
{
    public function view()
    {
    	$data = new Data();

    	return $this->customView('kp.admin.usulan-surat-ke-proyek', [
            'nav_item_active' => 'kp',
            'subtitle' => 'Usulan Surat Ke Proyek',

            'semua_mahasiswa' => Disposisi::where('progress', 10)->orderBy('updated_at')->get()
        ]);
    }

    public function cetak($nim)
    {
        $user = User::where(['category' => 'mahasiswa', 'nomor_induk' => $nim]);
        if (!$user->exists()) {
            return abort(404);
        }

        $disposisi = Disposisi::where(['user_id' => $user->first()->id]);
        if ($disposisi->first()->progress < 10) {
            return abort(404);
        }

        $pdf = PDF::loadView('main.kp.admin.surat-ke-proyek', [
            'mahasiswa' => $user->first()
        ])->setPaper('a4');
        return $pdf->stream($nim.'-surat-ke-proyek.pdf');
    }

    public function process($nim, Request $request)
    {
        $user = User::where(['category' => 'mahasiswa', 'nomor_induk' => $nim]);
        if (!$user->exists()) {
            return abort(404);
        }

        $disposisi = Disposisi::where(['user_id' => $user->first()->id]);
        Data::where(['user_id' => $user->first()->id, 'category' => 'data_surat_ke_proyek'])->update([
            'verified' => true
        ]);

        $disposisi->update([
            'progress' => 11
        ]);

        return redirect()->back()->with('success', 'Surat Ke Proyek telah ditetapkan "Sudah dto Koor Prodi"');
    }
}
