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

class UsulanSuratKeProyekController extends MainController
{
    public function view()
    {
    	$data = new Data();

    	return $this->customView('kp.admin.usulan-surat-ke-proyek', [
            'nav_item_active' => 'kp',
            'subtitle' => 'Usulan Surat Ke Proyek',

            'semua_mahasiswa' => Disposisi::where('progress', 9)->orderBy('updated_at')->get()
        ]);
    }

    public function process($nim, Request $request)
    {
    	$user = User::where(['category' => 'mahasiswa', 'nomor_induk' => $nim]);
    	if (!$user->exists()) {
    		return abort(404);
    	}

    	$disposisi = Disposisi::where(['user_id' => $user->first()->id]);

        /*Data::where(['user_id' => $user->first()->id, 'name' => 'surat-permohonan-ke-proyek'])->update([
            'verified' => true
        ]);*/

        $validate_rules = [
            'surat-ke-proyek' => 'required|file|mimes:pdf|max:5120'
        ];
        $validate_errors = [
            'surat-ke-proyek.required' => 'Harap unggah Surat Ke Proyek',
            'surat-ke-proyek.mimes' => 'Harap unggah dalam format pdf',
            'surat-ke-proyek.max' => 'Ukuran Surat Ke Proyek melebihi 5 MB'
        ];

        $validator = Validator::make($request->all(), $validate_rules, $validate_errors);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $ext = $request->file('surat-ke-proyek')->extension();
        $filename = $nim.'-surat-ke-proyek.'.$ext;
        $request->file('surat-ke-proyek')->storeAs(
            'data', $filename
        );
        Data::updateOrCreate([
            'user_id' => $user->first()->id,
            'category' => 'data_usul',
            'type' => 'file',
            'name' => 'surat-ke-proyek',
            'display_name' => 'Surat Ke Proyek'
        ], [
            'content' => $filename
        ]);

        $disposisi->update([
            'progress' => 10
        ]);

        return redirect()->back()->with('success', 'Usulan telah dikirim ke Koor Prodi');
    }
}
