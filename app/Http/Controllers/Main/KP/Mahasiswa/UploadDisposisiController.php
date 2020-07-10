<?php

namespace App\Http\Controllers\Main\KP\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use App\UserRole;
use App\Disposisi;
use App\Data;
use App\Setting;

class UploadDisposisiController extends Controller
{
    public function __invoke($progress, $optional = null, Request $request)
    {
    	$disposisi = Disposisi::where('user_id', User::myData('id'));

    	if ($optional != null) {
    		if ($progress == 1)
    		{
    			$validate_rules = [
                    'sptpd' => 'required|file|mimes:pdf|max:5120'
                ];
                $validate_errors = [
                    'sptpd.required' => 'Harap unggah Surat Permohonan Tugas Pengambilan Data',
                    'sptpd.mimes' => 'Harap unggah dalam format pdf',
                    'sptpd.max' => 'Ukuran Surat Permohonan Tugas Pengambilan Data melebihi 5 MB'
                ];

                $validator = Validator::make($request->all(), $validate_rules, $validate_errors);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator);
                }

                $ext = $request->file('sptpd')->extension();
                $filename = User::myData('nomor_induk').'-sptpd.'.$ext;
                $request->file('sptpd')->storeAs(
                    'data', $filename
                );
                Data::updateOrCreate([
                    'user_id' => User::myData('id'),
                    'category' => 'data_usul',
                    'type' => 'file',
                    'name' => 'sptpd',
                    'display_name' => 'Surat Permohonan Tugas Pengambilan Data'
                ], [
                    'content' => $filename
                ]);

                $disposisi->update([
                    'progress_optional' => 2
                ]);

                return redirect()->back()->with('success', 'Berhasil mengunggah Surat Permohonan Tugas Pengambilan Data');
    		}
    	} else {
            if ($progress == 5) {
                $validate_rules = [
                    'surat-permohonan-ke-proyek' => 'required|file|mimes:pdf|max:5120'
                ];
                $validate_errors = [
                    'surat-permohonan-ke-proyek.required' => 'Harap unggah Surat Permohonan ke Proyek',
                    'surat-permohonan-ke-proyek.mimes' => 'Harap unggah dalam format pdf',
                    'surat-permohonan-ke-proyek.max' => 'Ukuran Surat Permohonan ke Proyek melebihi 5 MB'
                ];

                $validator = Validator::make($request->all(), $validate_rules, $validate_errors);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator);
                }

                $filename = User::myData('nomor_induk').'-surat-permohonan-ke-proyek.'.$request->file('surat-permohonan-ke-proyek')->extension();

                $request->file('surat-permohonan-ke-proyek')->storeAs(
                    'data', $filename
                );

                Data::updateOrCreate([
                    'user_id' => User::myData('id'),
                    'category' => 'data_usul',
                    'type' => 'file',
                    'name' => 'surat-permohonan-ke-proyek',
                    'display_name' => 'Surat Permohonan ke Proyek'
                ], [
                    'content' => $filename
                ]);

                $disposisi->update([
                    'progress' => 6
                ]);

                return redirect()->back()->with('success', 'Berhasil mengunggah surat permohonan ke proyek');
            } elseif ($progress == 33) {
                $data = new Data;
                if (!$data->checkMultipleData(User::myData('id'), ['biodata', 'transkrip', 'bukti-bebas-lab', 'artikel-jim'])) {
                    return redirect()->back()->with('error', 'Harap lengkapi data usul yudisium');
                }

                $validate_rules = [
                    'kelengkapan-dokumen-administrasi-sidang-buku' => 'required|file|mimes:zip|max:10240'
                ];
                $validate_errors = [
                    'kelengkapan-dokumen-administrasi-sidang-buku.required' => 'Harap unggah Kelengkapan Dokumen Administrasi Sidang Buku',
                    'kelengkapan-dokumen-administrasi-sidang-buku.mimes' => 'Harap unggah dalam format zip',
                    'kelengkapan-dokumen-administrasi-sidang-buku.max' => 'Ukuran Kelengkapan Dokumen Administrasi Sidang Buku melebihi 10 MB'
                ];

                $validator = Validator::make($request->all(), $validate_rules, $validate_errors);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator);
                }

                $filename = User::myData('nomor_induk').'-kelengkapan-dokumen-administrasi-sidang-buku.'.$request->file('kelengkapan-dokumen-administrasi-sidang-buku')->extension();

                $request->file('kelengkapan-dokumen-administrasi-sidang-buku')->storeAs(
                    'data', $filename
                );

                Data::updateOrCreate([
                    'user_id' => User::myData('id'),
                    'category' => 'data_yudisium',
                    'type' => 'file',
                    'name' => 'kelengkapan-dokumen-administrasi-sidang-buku',
                    'display_name' => 'Kelengkapan Dokumen Administrasi Sidang Buku'
                ], [
                    'content' => $filename
                ]);

                $disposisi->update([
                    'progress' => 34
                ]);

                return redirect()->back()->with('success', 'Berhasil mengunggah berkas yudisium');
            }
            return abort(404);
        }
    }
}
