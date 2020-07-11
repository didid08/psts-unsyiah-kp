<?php

namespace App\Http\Controllers\Main\KP\Pembimbing;

use App\Http\Controllers\Main\MainController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use App\UserRole;
use App\Disposisi;
use App\Data;
use App\Setting;

class PemeriksaanBerkasKPController extends MainController
{
    public function view()
    {
    	$data = new Data();

    	return $this->customView('kp.pembimbing.pemeriksaan-berkas-kp', [
            'nav_item_active' => 'kp',
            'subtitle' => 'Pemeriksaan Berkas KP',

            'semua_mahasiswa' => Data::where(['name' => 'pembimbing', 'content' => User::myData('nama')])
            						->join('disposisi', 'data.user_id', '=', 'disposisi.user_id')
            						->select('disposisi.*')
            						->where('progress', 13)
            						->orderBy('updated_at')
            						->get(),
            'pemeriksaan_berkas_kp_1' => $data->getDataMultiple('pemeriksaan-berkas-kp-1'),
            'pemeriksaan_berkas_kp_2' => $data->getDataMultiple('pemeriksaan-berkas-kp-2'),
            'pemeriksaan_berkas_kp_3' => $data->getDataMultiple('pemeriksaan-berkas-kp-3')
        ]);
    }

    public function process($nim, Request $request)
    {
        $user = User::where(['category' => 'mahasiswa', 'nomor_induk' => $nim]);
        if (!$user->exists()) {
            return abort(404);
        }

        $validator = Validator::make($request->all(), [
    		'opsi1' => 'required',
    		'opsi2' => 'required',
    		'opsi3' => 'required'
    	], [
    		'required' => 'Harap lengkapi opsi'
    	]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        Data::updateOrCreate([
    		'user_id' => $user->first()->id,
    		'category' => 'data_usul',
    		'type' => 'text',
    		'name' => 'pemeriksaan-berkas-kp-1',
    		'display_name' => 'Pembimbing dan Pembahas telah menerima SK'
    	], [
    		'content' => $request->input('opsi1'),
    		'verified' => true
    	]);

    	Data::updateOrCreate([
    		'user_id' => $user->first()->id,
    		'category' => 'data_usul',
    		'type' => 'text',
    		'name' => 'pemeriksaan-berkas-kp-2',
    		'display_name' => 'Mahasiswa mendapatkan persetujuan pembimbing untuk kelapangan'
    	], [
    		'content' => $request->input('opsi2'),
    		'verified' => true
    	]);

    	Data::updateOrCreate([
    		'user_id' => $user->first()->id,
    		'category' => 'data_usul',
    		'type' => 'text',
    		'name' => 'pemeriksaan-berkas-kp-3',
    		'display_name' => 'Melaporkan kegiatan menggunakan lembar asistensi panduan kp mengacu pada website : http://sipil.unsyiah.ac.id/download/'
    	], [
    		'content' => $request->input('opsi3'),
    		'verified' => true
    	]);

    	if ($request->input('opsi1') == 'ya' && $request->input('opsi2') == 'ya' && $request->input('opsi3') == 'ya')
    	{
    		$disposisi = Disposisi::where(['user_id' => $user->first()->id]);
    		$disposisi->update([
    			'progress' => 14
    		]);
    		return redirect()->back()->with('success', 'Mahasiswa bernama '.$user->first()->nama.' ('.$user->first()->nomor_induk.') ditetapkan memenuhi pemeriksaan berkas KP');
    	}
    	return redirect()->back()->with('success', 'Disimpan');
    }
}
