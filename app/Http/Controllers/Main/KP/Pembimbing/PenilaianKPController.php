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
use PDF;

class PenilaianKPController extends MainController
{
    public function view()
    {
    	$data = new Data();

    	return $this->customView('kp.pembimbing.penilaian-kp', [
            'nav_item_active' => 'kp',
            'subtitle' => 'Penilaian KP (Pembimbing)',

            'semua_mahasiswa' => Data::where(['name' => 'pembimbing', 'content' => User::myData('nama')])
            						->join('disposisi', 'data.user_id', '=', 'disposisi.user_id')
            						->select('disposisi.*')
            						->where('progress', 16)
            						->orderBy('updated_at')
            						->get(),
            'buku_laporan_kp' => $data->getDataMultiple('buku-laporan-kp'),
            'nilai_materi_pembimbing' => $data->getDataMultiple('nilai-materi-pembimbing')
        ]);
    }

    public function isiNilaiKP($nim, Request $request)
    {
    	$user = User::where(['category' => 'mahasiswa', 'nomor_induk' => $nim]);
        if (!$user->exists()) {
            return abort(404);
        }

        $disposisi = Disposisi::where(['user_id' => $user->first()->id]);
        if ($disposisi->first()->progress != 16) {
        	return abort(404);
        }

        if (Data::where(['user_id' => $user->first()->id, 'name' => 'pembimbing', 'content' => User::myData('nama')])->exists())
        {
        	return $this->customView('kp.pembimbing.nilai-kp', [
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
        if ($disposisi->first()->progress != 16) {
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
    		'name' => 'nilai-materi-pembimbing',
    		'display_name' => 'Nilai Materi (Pembimbing)'
    	], [
    		'content' => $request->input('materi'),
    		'verified' => true
    	]);
    	Data::updateOrCreate([
    		'user_id' => $user->first()->id,
    		'category' => 'nilai-kp',
    		'type' => 'text',
    		'name' => 'nilai-penulisan-pembimbing',
    		'display_name' => 'Nilai Penulisan (Pembimbing)'
    	], [
    		'content' => $request->input('penulisan'),
    		'verified' => true
    	]);
    	Data::updateOrCreate([
    		'user_id' => $user->first()->id,
    		'category' => 'nilai-kp',
    		'type' => 'text',
    		'name' => 'nilai-penguasaan-pembimbing',
    		'display_name' => 'Nilai Penguasaan (Pembimbing)'
    	], [
    		'content' => $request->input('penguasaan'),
    		'verified' => true
    	]);
    	Data::updateOrCreate([
    		'user_id' => $user->first()->id,
    		'category' => 'nilai-kp',
    		'type' => 'text',
    		'name' => 'nilai-sikap-pembimbing',
    		'display_name' => 'Nilai Sikap (Pembimbing)'
    	], [
    		'content' => $request->input('sikap'),
    		'verified' => true
    	]);

    	return redirect(route('main.kp.pembimbing.penilaian-kp'))->with('success', 'Berhasil mengisi nilai KP untuk mahasiswa bernama '.$user->first()->nama.' ('.$user->first()->nomor_induk.')');
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
        if ($disposisi->first()->progress < 17) {
            return abort(404);
        }

        $pdf = PDF::loadView('main.kp.pembimbing.nilai-kp', [
            'mahasiswa' => $user->first(),
            'cetak' => true
        ])->setPaper('a4');
        return $pdf->stream($nim.'-nilai-kp-dari-pembimbing.pdf');

        return abort(404);
    }

    public function process($nim, Request $request)
    {
        $user = User::where(['category' => 'mahasiswa', 'nomor_induk' => $nim]);
        if (!$user->exists()) {
            return abort(404);
        }

        if (!Data::where(['user_id' => $user->first()->id, 'name' => 'nilai-materi-pembimbing'])->exists()) {
        	return redirect()->back()->with('error', 'Anda belum mengisi Nilai KP');
        }

        if (!empty($request->input('catatan-kp'))) {
        	Data::updateOrCreate([
	    		'user_id' => $user->first()->id,
	    		'category' => 'data_usul',
	    		'type' => 'text',
	    		'name' => 'catatan-kp-pembimbing',
	    		'display_name' => 'Catatan KP (Pembimbing)'
	    	], [
	    		'content' => $request->input('catatan-kp'),
	    		'verified' => true
	    	]);
        }

        $disposisi = Disposisi::where(['user_id' => $user->first()->id]);
		$disposisi->update([
			'progress' => 17
		]);

    	return redirect()->back()->with('success', 'Berhasil menetapkan nilai KP untuk mahasiswa bernama '.$user->first()->nama.' ('.$user->first()->nomor_induk.')');
    }
}
