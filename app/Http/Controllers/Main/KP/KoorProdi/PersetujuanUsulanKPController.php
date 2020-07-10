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

class PersetujuanUsulanKPController extends MainController
{
    public function view()
    {
    	$data = new Data();

    	return $this->customView('kp.koor-prodi.persetujuan-usulan-kp', [
            'nav_item_active' => 'kp',
            'subtitle' => 'Persetujuan Usulan KP',

            'semua_mahasiswa' => Disposisi::where('progress', 3)->orderBy('updated_at')->get(),
            'spp' => $data->getDataMultiple('spp'),
            'krs' => $data->getDataMultiple('krs'),
            'transkrip_sementara' => $data->getDataMultiple('transkrip-sementara'),
            'foto' => $data->getDataMultiple('foto')
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
                    'progress' => 1
                ]);
                return redirect()->back()->with('error', 'Usulan telah ditolak');
            break;

            case 'accept':
                Data::where(['user_id' => $user->first()->id])->update([
                    'verified' => true
                ]);

                if ($disposisi->first()->no_disposisi == null
                        && $disposisi->first()->tgl_disposisi == null)
                {
                    $jumlahYgAdaNomor = Disposisi::whereNotNull('no_disposisi')->get()->count();
                    $no = $jumlahYgAdaNomor+1;

                    Disposisi::where('user_id', $user->first()->id)->update([
                        'no_disposisi' => $no.'/KP/I/'.date('Y'),
                        'tgl_disposisi' => date('Y m d')
                    ]);
                }

                $disposisi->update([
                    'progress' => 4
                ]);

                return redirect()->back()->with('success', 'Usulan telah disetujui');
            break;
            default:
                return abort(404);
        }
        
    }
}
