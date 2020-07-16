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

class PenetapanSuratKeProyekController extends MainController
{
    public function view()
    {
    	$data = new Data();

    	return $this->customView('kp.koor-prodi.penetapan-surat-ke-proyek', [
            'nav_item_active' => 'kp',
            'subtitle' => 'Penetapan Surat Ke Proyek',

            'semua_mahasiswa' => Disposisi::where('progress', 10)->orderBy('updated_at')->get(),
            'surat_ke_proyek' => $data->getDataMultiple('surat-ke-proyek'),
        ]);
    }

    public function process($nim, $opsi, Request $request)
    {
    	$user = User::where(['category' => 'mahasiswa', 'nomor_induk' => $nim]);
    	if (!$user->exists()) {
    		return abort(404);
    	}

    	$disposisi = Disposisi::where(['user_id' => $user->first()->id]);

    	if ($opsi == 'decline')
    	{
    		$disposisi->update([
                'progress' => 9
            ]);
            return redirect()->back()->with('error', 'Usulan telah ditolak');
    	}
    	 elseif ($opsi == 'accept')
    	{
    		$jumlahYgAdaNomor = Data::where('name', 'surat-ke-proyek')->whereNotNull('no')->whereNotNull('tgl')->get()->count();
            $no = $jumlahYgAdaNomor+1;

            if (Data::where(['user_id' => $user->first()->id, 'name' => 'surat-ke-proyek'])->first()->no == null) {
                Data::where(['user_id' => $user->first()->id, 'name' => 'surat-ke-proyek'])->update([
                    'no' => 'B/'.$no.'/UN11.1.4/1/KM/'.date('Y'),
                    'tgl' => date('Y m d')
                ]);
            }

    		Data::where(['user_id' => $user->first()->id, 'name' => 'surat-ke-proyek'])->update([
	            'verified' => true
	        ]);

	        $disposisi->update([
	            'progress' => 11
	        ]);

	        return redirect()->back()->with('success', 'Surat ke Proyek telah ditetapkan');
    	}
    }
}
