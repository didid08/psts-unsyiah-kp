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
            if ($progress == 4) {
                $validate_rules = [
                    'nama-direktur-perusahaan' => 'required',
                    'nama-bapak-ibu-pada-tujuan-surat' => 'required',
                    'alamat-proyek' => 'required',
                    'nama-proyek' => 'required',
                    'kp-selama' => 'required'
                ];
                $validate_errors = [
                    'required' => 'Harap Lengkapi Data'
                ];

                $validator = Validator::make($request->all(), $validate_rules, $validate_errors);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator);
                }

                foreach ($validate_rules as $index => $value) {
                    Data::updateOrCreate([
                        'user_id' => User::myData('id'),
                        'category' => 'data_surat_permohonan_ke_proyek',
                        'type' => 'text',
                        'name' => $index,
                        'display_name' => str_replace('Bapak Ibu', 'Bapak/Ibu', ucwords(str_replace('-', ' ', $index)))
                    ], [
                        'content' => $request->input($index),
                        'verified' => false
                    ]);
                }

                if (Data::where(['user_id' => User::myData('id'), 'name' => 'no-surat-permohonan-ke-proyek'])->get()->count() == 0) {
                    $jumlahYgAdaNomor = Data::where('name', 'no-surat-permohonan-ke-proyek')->get()->count();
                    $no = $jumlahYgAdaNomor+1;

                    Data::updateOrCreate([
                        'user_id' => User::myData('id'),
                        'category' => 'data_surat_permohonan_ke_proyek',
                        'type' => 'text',
                        'name' => 'no-surat-permohonan-ke-proyek',
                        'display_name' => 'Nomor Surat Permohonan Ke Proyek'
                    ], [
                        'content' => 'B/'.$no.'/UN11.1.4/1/KM/'.date('Y'),
                        'verified' => false
                    ]);
                }

                $disposisi->update([
                    'progress' => 5
                ]);

                return redirect()->back()->with('success', 'Surat Permohonan ke Proyek telah diproses dan dikirim ke Admin');
            } elseif ($progress == 6) {
                $validate_rules = [
                    'surat-balasan-dari-proyek' => 'required|file|mimes:pdf|max:5120'
                ];
                $validate_errors = [
                    'surat-balasan-dari-proyek.required' => 'Harap unggah Surat Balasan Dari Proyek',
                    'surat-balasan-dari-proyek.mimes' => 'Harap unggah dalam format pdf',
                    'surat-balasan-dari-proyek.max' => 'Ukuran Surat Balasan Dari Proyek melebihi 5 MB'
                ];

                $validator = Validator::make($request->all(), $validate_rules, $validate_errors);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator);
                }

                $filename = User::myData('nomor_induk').'-surat-balasan-dari-proyek.'.$request->file('surat-balasan-dari-proyek')->extension();

                $request->file('surat-balasan-dari-proyek')->storeAs(
                    'data', $filename
                );

                Data::updateOrCreate([
                    'user_id' => User::myData('id'),
                    'category' => 'data_usul',
                    'type' => 'file',
                    'name' => 'surat-balasan-dari-proyek',
                    'display_name' => 'Surat Balasan Dari Proyek'
                ], [
                    'content' => $filename
                ]);

                $disposisi->update([
                    'progress' => 7
                ]);

                return redirect()->back()->with('success', 'Berhasil mengunggah Surat Balasan Dari Proyek');
            } elseif ($progress == 9) {
                $validate_rules = [
                    'pembimbing-lapangan-kp' => 'required'
                ];
                $validate_errors = [
                    'required' => 'Harap Lengkapi Data'
                ];

                $validator = Validator::make($request->all(), $validate_rules, $validate_errors);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator);
                }
                Data::updateOrCreate([
                    'user_id' => User::myData('id'),
                    'category' => 'data_surat_ke_proyek',
                    'type' => 'text',
                    'name' => 'pembimbing-lapangan-kp',
                    'display_name' => 'Pembimbing Lapangan KP'
                ], [
                    'content' => $request->input('pembimbing-lapangan-kp'),
                    'verified' => false
                ]);

                if (Data::where(['user_id' => User::myData('id'), 'name' => 'no-surat-ke-proyek'])->get()->count() == 0) {
                    $jumlahYgAdaNomor = Data::where('name', 'no-surat-ke-proyek')->get()->count();
                    $no = $jumlahYgAdaNomor+1;

                    Data::updateOrCreate([
                        'user_id' => User::myData('id'),
                        'category' => 'data_surat_ke_proyek',
                        'type' => 'text',
                        'name' => 'no-surat-ke-proyek',
                        'display_name' => 'Nomor Surat Ke Proyek'
                    ], [
                        'content' => 'B/'.$no.'/UN11.1.4/1/KM/'.date('Y'),
                        'verified' => false
                    ]);
                }

                $disposisi->update([
                    'progress' => 10
                ]);

                return redirect()->back()->with('success', 'Surat Ke Proyek telah diproses dan dikirim ke Admin');
            } elseif ($progress == 14) {
                $validate_rules = [
                    'masa-kerja-praktek-1' => 'required',
                    'masa-kerja-praktek-2' => 'required',

                    'surat-keterangan-telah-selesai-kp' => 'required|file|mimes:pdf|max:5120',
                    'buku-laporan-kp' => 'required|file|mimes:pdf|max:5120',
                    'lembar-pengesahan-kp' => 'required|file|mimes:pdf|max:5120'
                ];
                $validate_errors = [
                    'masa-kerja-praktek-1.required' => 'Harap tetapkan tanggal mulai Kerja Praktek',
                    'masa-kerja-praktek-2.required' => 'Harap tetapkan tanggal berakhir Kerja Praktek',

                    'surat-keterangan-telah-selesai-kp.required' => 'Harap unggah Surat Keterangan Telah Selesai KP',
                    'surat-keterangan-telah-selesai-kp.mimes' => 'Harap unggah dalam format pdf',
                    'surat-keterangan-telah-selesai-kp.max' => 'Ukuran Surat Keterangan Telah Selesai KP melebihi 5 MB',

                    'buku-laporan-kp.required' => 'Harap unggah Buku Laporan KP',
                    'buku-laporan-kp.mimes' => 'Harap unggah dalam format pdf',
                    'buku-laporan-kp.max' => 'Ukuran Buku Laporan KP melebihi 5 MB',

                    'lembar-pengesahan-kp.required' => 'Harap unggah Lembar Pengesahan KP',
                    'lembar-pengesahan-kp.mimes' => 'Harap unggah dalam format pdf',
                    'lembar-pengesahan-kp.max' => 'Ukuran Lembar Pengesahan KP melebihi 5 MB'
                ];

                $validator = Validator::make($request->all(), $validate_rules, $validate_errors);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator);
                }

                Data::updateOrCreate([
                    'user_id' => User::myData('id'),
                    'category' => 'data_usul',
                    'type' => 'text',
                    'name' => 'masa-kerja-praktek-1',
                    'display_name' => 'Masa Kerja Praktek Mulai'
                ], [
                    'content' => $request->input('masa-kerja-praktek-1')
                ]);
                Data::updateOrCreate([
                    'user_id' => User::myData('id'),
                    'category' => 'data_usul',
                    'type' => 'text',
                    'name' => 'masa-kerja-praktek-2',
                    'display_name' => 'Masa Kerja Praktek Berakhir'
                ], [
                    'content' => $request->input('masa-kerja-praktek-2')
                ]);

                $filename1 = User::myData('nomor_induk').'-surat-keterangan-telah-selesai-kp.'.$request->file('surat-keterangan-telah-selesai-kp')->extension();
                $filename2 = User::myData('nomor_induk').'-buku-laporan-kp.'.$request->file('buku-laporan-kp')->extension();
                $filename3 = User::myData('nomor_induk').'-lembar-pengesahan-kp.'.$request->file('lembar-pengesahan-kp')->extension();

                $request->file('surat-keterangan-telah-selesai-kp')->storeAs(
                    'data', $filename1
                );
                $request->file('buku-laporan-kp')->storeAs(
                    'data', $filename2
                );
                $request->file('lembar-pengesahan-kp')->storeAs(
                    'data', $filename3
                );

                Data::updateOrCreate([
                    'user_id' => User::myData('id'),
                    'category' => 'data_usul',
                    'type' => 'file',
                    'name' => 'surat-keterangan-telah-selesai-kp',
                    'display_name' => 'Surat Keterangan Telah Selesai KP'
                ], [
                    'content' => $filename1
                ]);
                Data::updateOrCreate([
                    'user_id' => User::myData('id'),
                    'category' => 'data_usul',
                    'type' => 'file',
                    'name' => 'buku-laporan-kp',
                    'display_name' => 'Buku Laporan KP'
                ], [
                    'content' => $filename2
                ]);
                Data::updateOrCreate([
                    'user_id' => User::myData('id'),
                    'category' => 'data_usul',
                    'type' => 'file',
                    'name' => 'lembar-pengesahan-kp',
                    'display_name' => 'Lembar Pengesahan KP'
                ], [
                    'content' => $filename3
                ]);

                $disposisi->update([
                    'progress' => 15
                ]);

                return redirect()->back()->with('success', 'Berhasil mengunggah data pengisian masa KP');
            } elseif ($progress == 20) {
                $validate_rules = [
                    'kelengkapan-dokumen-administrasi' => 'required|file|mimes:zip|max:10240'
                ];
                $validate_errors = [
                    'kelengkapan-dokumen-administrasi.required' => 'Harap unggah Kelengkapan Dokumen Administrasi',
                    'kelengkapan-dokumen-administrasi.mimes' => 'Harap unggah dalam format zip',
                    'kelengkapan-dokumen-administrasi.max' => 'Ukuran Kelengkapan Dokumen Administrasi melebihi 10 MB'
                ];

                $validator = Validator::make($request->all(), $validate_rules, $validate_errors);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator);
                }

                $filename = User::myData('nomor_induk').'-kelengkapan-dokumen-administrasi.'.$request->file('kelengkapan-dokumen-administrasi')->extension();

                $request->file('kelengkapan-dokumen-administrasi')->storeAs(
                    'data', $filename
                );

                Data::updateOrCreate([
                    'user_id' => User::myData('id'),
                    'category' => 'data_usul',
                    'type' => 'file',
                    'name' => 'kelengkapan-dokumen-administrasi',
                    'display_name' => 'Kelengkapan Dokumen Administrasi'
                ], [
                    'content' => $filename
                ]);

                $disposisi->update([
                    'progress' => 21
                ]);

                return redirect()->back()->with('success', 'Berhasil mengunggah Kelengkapan Dokumen Administrasi');
            }
            return abort(404);
        } 
    }
}
