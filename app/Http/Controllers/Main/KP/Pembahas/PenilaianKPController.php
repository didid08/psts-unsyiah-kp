<?php

namespace App\Http\Controllers\Main\KP\Pembahas;

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

class PenilaianKPController extends MainController
{
    public function view()
    {
    	$data = new Data();

    	return $this->customView('kp.pembahas.penilaian-kp', [
            'nav_item_active' => 'kp',
            'subtitle' => 'Penilaian KP (Pembahas)',

            'semua_mahasiswa' => Data::where(['name' => 'pembahas', 'content' => User::myData('nama')])
            						->join('disposisi', 'data.user_id', '=', 'disposisi.user_id')
            						->select('disposisi.*')
            						->where('progress', 17)
            						->orderBy('updated_at')
            						->get(),
            'buku_laporan_kp' => $data->getDataMultiple('buku-laporan-kp'),
            'nilai_materi_pembahas' => $data->getDataMultiple('nilai-materi-pembahas')
        ]);
    }

    public function isiNilaiKP($nim, Request $request)
    {
    	$user = User::where(['category' => 'mahasiswa', 'nomor_induk' => $nim]);
        if (!$user->exists()) {
            return abort(404);
        }

        $disposisi = Disposisi::where(['user_id' => $user->first()->id]);
        if ($disposisi->first()->progress != 17) {
        	return abort(404);
        }

        if (Data::where(['user_id' => $user->first()->id, 'name' => 'pembahas', 'content' => User::myData('nama')])->exists())
        {
        	return $this->customView('kp.pembahas.nilai-kp', [
	        	'mahasiswa' => $user->first()
	        ]);
        }

        return abort(404);
    }

    public function isiNilaiKPSimpan ($nim, Request $request)
    {
    	$user = User::where(['category' => 'mahasiswa', 'nomor_induk' => $nim]);
        if (!$user->exists()) {
            return abort(404);
        }

        $disposisi = Disposisi::where(['user_id' => $user->first()->id]);
        if ($disposisi->first()->progress != 17) {
        	return abort(404);
        }

        $this->validate($request, [
        	'materi' => 'required|numeric',
        	'penulisan' => 'required|numeric',
        	'penguasaan' => 'required|numeric',
        	'sikap' => 'required|numeric'
        ]);

        Data::updateOrCreate([
    		'user_id' => $user->first()->id,
    		'category' => 'nilai-kp',
    		'type' => 'text',
    		'name' => 'nilai-materi-pembahas',
    		'display_name' => 'Nilai Materi (Pembahas)'
    	], [
    		'content' => $request->input('materi'),
    		'verified' => true
    	]);
    	Data::updateOrCreate([
    		'user_id' => $user->first()->id,
    		'category' => 'nilai-kp',
    		'type' => 'text',
    		'name' => 'nilai-penulisan-pembahas',
    		'display_name' => 'Nilai Penulisan (Pembahas)'
    	], [
    		'content' => $request->input('penulisan'),
    		'verified' => true
    	]);
    	Data::updateOrCreate([
    		'user_id' => $user->first()->id,
    		'category' => 'nilai-kp',
    		'type' => 'text',
    		'name' => 'nilai-penguasaan-pembahas',
    		'display_name' => 'Nilai Penguasaan (Pembahas)'
    	], [
    		'content' => $request->input('penguasaan'),
    		'verified' => true
    	]);
    	Data::updateOrCreate([
    		'user_id' => $user->first()->id,
    		'category' => 'nilai-kp',
    		'type' => 'text',
    		'name' => 'nilai-sikap-pembahas',
    		'display_name' => 'Nilai Sikap (Pembahas)'
    	], [
    		'content' => $request->input('sikap'),
    		'verified' => true
    	]);

    	return redirect(route('main.kp.pembahas.penilaian-kp'))->with('success', 'Berhasil mengisi nilai KP untuk mahasiswa bernama '.$user->first()->nama.' ('.$user->first()->nomor_induk.')');
    }

    public function cetakNilaiKP ($nim)
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

        $pdf = PDF::loadView('main.kp.pembahas.nilai-kp', [
            'mahasiswa' => $user->first(),
            'cetak' => true
        ])->setPaper('a4');
        return $pdf->stream($nim.'-nilai-kp-dari-pembahas.pdf');

        return abort(404);
    }

    public function process($nim, Request $request)
    {
        $user = User::where(['category' => 'mahasiswa', 'nomor_induk' => $nim]);
        if (!$user->exists()) {
            return abort(404);
        }

        if (!Data::where(['user_id' => $user->first()->id, 'name' => 'nilai-materi-pembahas'])->exists()) {
        	return redirect()->back()->with('error', 'Anda belum mengisi Nilai KP');
        }

        if (!empty($request->input('catatan-kp'))) {
        	Data::updateOrCreate([
	    		'user_id' => $user->first()->id,
	    		'category' => 'data_usul',
	    		'type' => 'text',
	    		'name' => 'catatan-kp-pembahas',
	    		'display_name' => 'Catatan KP (Pembahas)'
	    	], [
	    		'content' => $request->input('catatan-kp'),
	    		'verified' => true
	    	]);
        }

        $disposisi = Disposisi::where(['user_id' => $user->first()->id]);
		$disposisi->update([
			'progress' => 18
		]);

    	return redirect()->back()->with('success', 'Berhasil menetapkan nilai KP untuk mahasiswa bernama '.$user->first()->nama.' ('.$user->first()->nomor_induk.')');
    }
}
