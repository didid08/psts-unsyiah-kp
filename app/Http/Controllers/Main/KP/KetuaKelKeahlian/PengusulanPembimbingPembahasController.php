<?php

namespace App\Http\Controllers\Main\KP\KetuaKelKeahlian;

use App\Http\Controllers\Main\MainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Data;
use App\Disposisi;
use App\User;
use App\Mail\UsulPembimbing;
use App\Mail\UsulPembahas;

class PengusulanPembimbingPembahasController extends MainController
{
    public function view()
    {
    	$data = new Data();
    	$user = new User();

    	$pembimbing_array = json_decode(json_encode($data->getDataMultiple('pembimbing')), true);
    	foreach($pembimbing_array as $index => $value) {
            if ($value['verified'] == false) {
        		$diff = time() - strtotime($value['updated_at']);
    	        $hariLewat = floor($diff / (60 * 60 * 24));
    	        if ($hariLewat >= 2) {
    	            Data::where(['user_id' => $value['user_id'], 'name' => 'pembimbing'])->delete();
    	            Data::where(['user_id' => $value['user_id'], 'name' => 'pembahas'])->delete();
    	        }
            }
    	}
    	$pembahas_array = json_decode(json_encode($data->getDataMultiple('pembahas')), true);
    	foreach($pembahas_array as $index => $value) {
            if ($value['verified'] == false) {
        		$diff2 = time() - strtotime($value['updated_at']);
    	        $hariLewat2 = floor($diff2 / (60 * 60 * 24));
    	        if ($hariLewat2 >= 2) {
    	            Data::where(['user_id' => $value['user_id'], 'name' => 'pembimbing'])->delete();
    	            Data::where(['user_id' => $value['user_id'], 'name' => 'pembahas'])->delete();
    	        }
            }
    	}
        
        $myBidang = User::find(User::myData('id'))->bidang()->value('nama');

    	return $this->customView('kp.ketua-kel-keahlian.pengusulan-pembimbing-pembahas', [
            'nav_item_active' => 'kp',
            'subtitle' => 'Pengusulan Pembimbing dan Pembahas',

            'semua_mahasiswa' => Data::where(['name' => 'bidang', 'content' => $myBidang])
            						->join('disposisi', 'data.user_id', '=', 'disposisi.user_id')
            						->select('disposisi.*')
            						->where('progress', 8)
            						->orderBy('updated_at')
            						->get(),
            'semua_dosen' => User::where('category', 'dosen')->get(),
            'daftar_pembimbing' => $data->getDataMultiple('pembimbing'),
            'daftar_pembahas' => $data->getDataMultiple('pembahas'),
            'judul_kp' => $data->getDataMultiple('judul-kp')
        ]);
    }

    public function usul($nim, Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		'pembimbing' => 'required',
    		'pembahas' => 'required'
    	], [
    		'pembimbing.required' => 'Harap pilih nama pembimbing',
    		'pembahas.required' => 'Harap pilih nama pembahas'
    	]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

    	$nomorIndukPembimbing = $request->input('pembimbing');
    	$nomorIndukPembahas = $request->input('pembahas');

    	$mahasiswa = User::where('nomor_induk', $nim)->first();
    	$pembimbing = User::where('nomor_induk', $nomorIndukPembimbing)->first();
    	$pembahas = User::where('nomor_induk', $nomorIndukPembahas)->first();

    	if ($pembimbing->email == null) {
    		return redirect()->back()->with('error', 'Pembimbing tidak memiliki email yang dapat dikirim');
    	}

    	if ($pembahas->email == null) {
    		return redirect()->back()->with('error', 'Pembahas tidak memiliki email yang dapat dikirim');
    	}

    	$key1 = uniqid(rand());
    	$key2 = uniqid(rand());

    	Data::updateOrCreate([
    		'user_id' => $mahasiswa->id,
    		'category' => 'data_usul',
    		'type' => 'text',
    		'name' => 'pembimbing',
    		'display_name' => 'Nama Pembimbing'
    	], [
    		'content' => $pembimbing->nama,
    		'verified' => false,
    		'verification_key' => Hash::make($key1)
    	]);

    	Data::updateOrCreate([
    		'user_id' => $mahasiswa->id,
    		'category' => 'data_usul',
    		'type' => 'text',
    		'name' => 'pembahas',
    		'display_name' => 'Nama Pembahas'
    	], [
    		'content' => $pembahas->nama,
    		'verified' => false,
    		'verification_key' => Hash::make($key2)
    	]);

    	Mail::to($pembimbing->email)->send(new UsulPembimbing($mahasiswa->nama, $mahasiswa->nomor_induk, $key1));
    	Mail::to($pembahas->email)->send(new UsulPembahas($mahasiswa->nama, $mahasiswa->nomor_induk, $key2));

    	return redirect()->back()->with('success', 'Berhasil mengusulkan Pembimbing dan Pembahas untuk '.$mahasiswa->nama.' ('.$nim.')');
    }

    public function process($nim, Request $request)
    {
        $user = User::where(['category' => 'mahasiswa', 'nomor_induk' => $nim]);
        if (!$user->exists()) {
            return abort(404);
        }

        $disposisi = Disposisi::where(['user_id' => $user->first()->id]);

        $disposisi->update([
            'progress' => 9
        ]);

        return redirect()->back()->with('success', 'Pembimbing dan Pembahas telah ditetapkan');
    }
}
