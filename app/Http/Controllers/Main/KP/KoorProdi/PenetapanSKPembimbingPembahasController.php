<?php

namespace App\Http\Controllers\Main\KP\KoorProdi;

use App\Http\Controllers\Main\MainController;
use Illuminate\Http\Request;
use App\User;
use App\Disposisi;
use App\Data;

class PenetapanSKPembimbingPembahasController extends MainController
{
    public function view()
    {
    	$data = new Data();

    	return $this->customView('kp.koor-prodi.penetapan-sk-pembimbing-pembahas', [
            'nav_item_active' => 'kp',
            'subtitle' => 'Penetapan SK Pembimbing & Pembahas',

            'semua_mahasiswa' => Disposisi::where('progress', 12)->orderBy('updated_at')->get(),
            'pembimbing' => $data->getDataMultiple('pembimbing'),
            'pembahas' => $data->getDataMultiple('pembahas'),
            'sk_pembimbing_pembahas' => $data->getDataMultiple('sk-pembimbing-pembahas')
        ]);
    }

    public function process($nim, $opsi, Request $request)
    {
        $user = User::where(['category' => 'mahasiswa', 'nomor_induk' => $nim]);
        if (!$user->exists()) {
            return abort(404);
        }

        $disposisi = Disposisi::where(['user_id' => $user->first()->id]);

        switch ($opsi)
        {
            case 'decline':
                $disposisi->update([
                    'progress' => 11
                ]);
                return redirect()->back()->with('error', 'Usulan telah ditolak');
            break;

            case 'accept':

                $jumlahYgAdaNomor = Data::where('name', 'sk-pembimbing-pembahas')->whereNotNull('no')->whereNotNull('tgl')->get()->count();
                $no = $jumlahYgAdaNomor+1;

                if (Data::where(['user_id' => $user->first()->id, 'name' => 'sk-pembimbing-pembahas'])->first()->no == null) {
                    Data::where(['user_id' => $user->first()->id, 'name' => 'sk-pembimbing-pembahas'])->update([
                        'no' => 'B/'.$no.'/UN11.1.4/1/KM/'.date('Y'),
                        'tgl' => date('Y m d')
                    ]);
                }

                Data::where(['user_id' => $user->first()->id, 'name' => 'sk-pembimbing-pembahas'])->update([
                    'verified' => true
                ]);

                $disposisi->update([
                    'progress' => 13
                ]);

                return redirect()->back()->with('success', 'SK Penunjukan Pembimbing & Pembahas telah ditetapkan');
            break;
            default:
                return abort(404);
        }
    }
}
