<?php

namespace App\Http\Controllers\Main\KP\Admin;

use App\Http\Controllers\Main\MainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Data;
use App\Disposisi;
use App\User;

class UsulanSKPembimbingPembahasController extends MainController
{
    public function view()
    {
    	$data = new Data();

    	return $this->customView('kp.admin.usulan-sk-pembimbing-pembahas', [
            'nav_item_active' => 'kp',
            'subtitle' => 'Usulan SK Pembimbing & Pembahas',

            'semua_mahasiswa' => Disposisi::where('progress', 11)->orderBy('updated_at')->get(),
            'pembimbing' => $data->getDataMultiple('pembimbing'),
            'pembahas' => $data->getDataMultiple('pembahas')
        ]);
    }

    public function process($nim, Request $request)
    {
        $user = User::where(['category' => 'mahasiswa', 'nomor_induk' => $nim]);
        if (!$user->exists()) {
            return abort(404);
        }

        $validate_rules = [
            'sk-pembimbing-pembahas' => 'required|file|mimes:pdf|max:5120'
        ];
        $validate_errors = [
            'sk-pembimbing-pembahas.required' => 'Harap unggah SK Penunjukan Pembimbing dan Pembahas',
            'sk-pembimbing-pembahas.mimes' => 'Harap unggah dalam format pdf',
            'sk-pembimbing-pembahas.max' => 'Ukuran SK Penunjukan Pembimbing dan Pembahas melebihi 5 MB'
        ];

        $validator = Validator::make($request->all(), $validate_rules, $validate_errors);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $ext = $request->file('sk-pembimbing-pembahas')->extension();
        $filename = $nim.'-sk-pembimbing-pembahas.'.$ext;
        $request->file('sk-pembimbing-pembahas')->storeAs(
            'data', $filename
        );
        Data::updateOrCreate([
            'user_id' => $user->first()->id,
            'category' => 'data_usul',
            'type' => 'file',
            'name' => 'sk-pembimbing-pembahas',
            'display_name' => 'SK Penunjukan Pembimbing dan Pembahas'
        ], [
            'content' => $filename
        ]);

        $disposisi = Disposisi::where(['user_id' => $user->first()->id]);
        $disposisi->update([
            'progress' => 12
        ]);

        return redirect()->back()->with('success', 'Usulan telah dikirim ke Koor Prodi');
    }
}
