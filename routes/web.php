<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/terima-usul/{name}/{nim}', 'Main\KP\DisposisiController@terimaUsul')->name('terima-usul');

Route::middleware(['auth'])->group(function () {

	/* INDEX ROUTE */
	Route::get('/', 'IndexController')->name('index');

	/* AUTH ROUTES */
	Route::get('/auth/login/{opsi?}', 'Auth\LoginController@loginPage')->name('auth.login');
	Route::post('/auth/login', 'Auth\LoginController@loginProcess')->name('auth.login.process');
	Route::get('/auth/logout', 'Auth\AuthController@logout')->name('auth.logout');
	Route::put('/auth/password/change/{for?}', 'Auth\PasswordController@changePassword')->middleware('prevent.guest')->name('auth.password.change');

	/* MAIN ROUTES */
	Route::get('/main/dashboard', 'Main\MainController@dashboard')->name('main.dashboard');

	Route::get('/main/cek-data', 'Main\Admin\CekDataController@view')->middleware('only.admin')->name('main.admin.cek-data');
	Route::get('/main/cek-data/data', 'Main\Admin\CekDataController@viewWithData')->middleware('only.admin')->name('main.admin.cek-data.with-data');
	
	Route::get('/main/akun', 'Main\Admin\AkunController@view')->middleware('only.admin')->name('main.admin.akun');
	Route::post('/main/akun/tambah', 'Main\Admin\AkunController@tambahAkun')->middleware('only.admin')->name('main.admin.akun.tambah');
	Route::put('/main/akun/edit/{category?}/{nomorInduk?}', 'Main\Admin\AkunController@editAkun')->middleware('only.admin')->name('main.admin.akun.edit');
	Route::delete('/main/akun/hapus/{category?}/{nomorInduk?}', 'Main\Admin\AkunController@hapusAkun')->middleware('only.admin')->name('main.admin.akun.hapus');
	Route::put('/main/akun/ubah-role/{role}/{bidang?}', 'Main\Admin\AkunController@ubahRole')->middleware('only.admin')->name('main.admin.akun.ubah-role');
	
	Route::get('/main/dosen/info', 'Main\MainController@infoDosen')->name('main.dosen.info');
	Route::get('/main/dosen/rekap', 'Main\MainController@rekapDosen')->name('main.dosen.rekap');

	Route::get('/main/file/{filename}', 'Main\FileGetController')->name('main.file');
		//TGA
		Route::get('/main/kp/disposisi/{nim?}', 'Main\KP\DisposisiController@view')->middleware('prevent.guest')->name('main.kp.disposisi');
		Route::get('/main/kp/disposisi/{nim}/cetak', 'Main\KP\DisposisiController@print')->middleware('prevent.guest')->name('main.kp.disposisi.cetak');

		// Mahasiswa
		Route::middleware('only.mahasiswa')->group(function () {
			Route::post('/main/kp/disposisi/upload/{progress}/{optional?}', 'Main\KP\Mahasiswa\UploadDisposisiController')->middleware('prevent.guest')->name('main.kp.mahasiswa.upload-disposisi');

			Route::get('/main/kp/input-usul', 'Main\KP\Mahasiswa\InputUsulController@view')->name('main.kp.mahasiswa.input-usul');
			Route::post('/main/kp/input-usul', 'Main\KP\Mahasiswa\InputUsulController@process')->name('main.kp.mahasiswa.input-usul.process');

			Route::get('/main/kp/input-usul-sempro', 'Main\KP\Mahasiswa\InputUsulSemproController@view')->name('main.kp.mahasiswa.input-usul-sempro');
			Route::post('/main/kp/input-usul-sempro', 'Main\KP\Mahasiswa\InputUsulSemproController@process')->name('main.kp.mahasiswa.input-usul-sempro.process');

			Route::get('/main/kp/input-usul-sidang', 'Main\KP\Mahasiswa\InputUsulSidangController@view')->name('main.kp.mahasiswa.input-usul-sidang');
			Route::post('/main/kp/input-usul-sidang', 'Main\KP\Mahasiswa\InputUsulSidangController@process')->name('main.kp.mahasiswa.input-usul-sidang.process');

			Route::get('/main/kp/input-usul-yudisium', 'Main\KP\Mahasiswa\InputUsulYudisiumController@view')->name('main.kp.mahasiswa.input-usul-yudisium');
			Route::post('/main/kp/input-usul-yudisium', 'Main\KP\Mahasiswa\InputUsulYudisiumController@process')->name('main.kp.mahasiswa.input-usul-yudisium.process');

			Route::get('/main/biodata', 'Main\Mahasiswa\BiodataController@view')->name('main.mahasiswa.biodata');
			Route::post('/main/biodata', 'Main\Mahasiswa\BiodataController@process')->name('main.mahasiswa.biodata.process');
		});
		
		//Admin
		Route::middleware('only.admin')->group(function () {
			Route::get('/main/kp/admin/usulan-tga', 'Main\KP\Admin\UsulanTGAController@view')->name('main.kp.admin.usulan-tga');
			Route::post('/main/kp/admin/usulan-tga/process/{nim}/{opsi}', 'Main\KP\Admin\UsulanTGAController@process')->name('main.kp.admin.usulan-tga.process');

			Route::get('/main/kp/admin/usulan-sk-pembimbing', 'Main\KP\Admin\UsulanSKPembimbingController@view')->name('main.kp.admin.usulan-sk-pembimbing');
			Route::post('/main/kp/admin/usulan-sk-pembimbing/process/{nim}', 'Main\KP\Admin\UsulanSKPembimbingController@process')->name('main.kp.admin.usulan-sk-pembimbing.process');

			Route::get('/main/kp/admin/usulan-surat-permohonan-tugas-pengambilan-data', 'Main\KP\Admin\UsulanSuratPermohonanTugasPengambilanDataController@view')->name('main.kp.admin.usulan-sptpd');
			Route::post('/main/kp/admin/usulan-surat-permohonan-tugas-pengambilan-data/process/{nim}/{opsi}', 'Main\KP\Admin\UsulanSuratPermohonanTugasPengambilanDataController@process')->name('main.kp.admin.usulan-sptpd.process');

			Route::get('/main/kp/admin/usulan-surat-tugas-pengambilan-data', 'Main\KP\Admin\UsulanSuratTugasPengambilanDataController@view')->name('main.kp.admin.usulan-stpd');
			Route::post('/main/kp/admin/usulan-surat-tugas-pengambilan-data/process/{nim}', 'Main\KP\Admin\UsulanSuratTugasPengambilanDataController@process')->name('main.kp.admin.usulan-stpd.process');

			Route::get('/main/kp/admin/usulan-seminar-proposal', 'Main\KP\Admin\UsulanSeminarProposalController@view')->name('main.kp.admin.usulan-sempro');
			Route::post('/main/kp/admin/usulan-seminar-proposal/process/{nim}/{opsi}', 'Main\KP\Admin\UsulanSeminarProposalController@process')->name('main.kp.admin.usulan-sempro.process');

			Route::get('/main/kp/admin/usulan-sk-penguji-seminar-proposal', 'Main\KP\Admin\UsulanSKPengujiSeminarProposalController@view')->name('main.kp.admin.usulan-sk-penguji-sempro');
			Route::post('/main/kp/admin/usulan-sk-penguji-seminar-proposal/process/{nim}', 'Main\KP\Admin\UsulanSKPengujiSeminarProposalController@process')->name('main.kp.admin.usulan-sk-penguji-sempro.process');

			Route::get('/main/kp/admin/usulan-pengesahan-seminar-proposal', 'Main\KP\Admin\UsulanPengesahanSeminarProposalController@view')->name('main.kp.admin.usulan-pengesahan-sempro');
			Route::post('/main/kp/admin/usulan-pengesahan-seminar-proposal/process/{nim}/{opsi}', 'Main\KP\Admin\UsulanPengesahanSeminarProposalController@process')->name('main.kp.admin.usulan-pengesahan-sempro.process');

			Route::get('/main/kp/admin/usulan-kelengkapan-dokumen-administrasi-seminar-proposal', 'Main\KP\Admin\UsulanDaftarHadirSeminarProposalController@view')->name('main.kp.admin.usulan-daftar-hadir-sempro');
			Route::post('/main/kp/admin/usulan-kelengkapan-dokumen-administrasi-seminar-proposal/process/{nim}/{opsi}', 'Main\KP\Admin\UsulanDaftarHadirSeminarProposalController@process')->name('main.kp.admin.usulan-daftar-hadir-sempro.process');

			Route::get('/main/kp/admin/usulan-sidang', 'Main\KP\Admin\UsulanSidangController@view')->name('main.kp.admin.usulan-sidang');
			Route::post('/main/kp/admin/usulan-sidang/process/{nim}/{opsi}', 'Main\KP\Admin\UsulanSidangController@process')->name('main.kp.admin.usulan-sidang.process');

			Route::get('/main/kp/admin/usulan-sk-penguji-sidang', 'Main\KP\Admin\UsulanSKPengujiSidangController@view')->name('main.kp.admin.usulan-sk-penguji-sidang');
			Route::post('/main/kp/admin/usulan-sk-penguji-sidang/process/{nim}', 'Main\KP\Admin\UsulanSKPengujiSidangController@process')->name('main.kp.admin.usulan-sk-penguji-sidang.process');

			Route::get('/main/kp/admin/usulan-pengesahan-sidang', 'Main\KP\Admin\UsulanPengesahanSidangController@view')->name('main.kp.admin.usulan-pengesahan-sidang');
			Route::post('/main/kp/admin/usulan-pengesahan-sidang/process/{nim}/{opsi}', 'Main\KP\Admin\UsulanPengesahanSidangController@process')->name('main.kp.admin.usulan-pengesahan-sidang.process');

			Route::get('/main/kp/admin/usulan-yudisium', 'Main\KP\Admin\UsulanYudisiumController@view')->name('main.kp.admin.usulan-yudisium');
			Route::post('/main/kp/admin/usulan-yudisium/process/{nim}/{opsi}', 'Main\KP\Admin\UsulanYudisiumController@process')->name('main.kp.admin.usulan-yudisium.process');
		});

		//Koor Prodi
		Route::middleware('only.koor-prodi')->group(function () {
			Route::get('/main/kp/koor-prodi/persetujuan-usulan-tga', 'Main\KP\KoorProdi\PersetujuanUsulanTGAController@view')->name('main.kp.koor-prodi.persetujuan-usulan-tga');
			Route::post('/main/kp/koor-prodi/persetujuan-usulan-tga/process/{nim}/{opsi}', 'Main\KP\KoorProdi\PersetujuanUsulanTGAController@process')->name('main.kp.koor-prodi.persetujuan-usulan-tga.process');

			Route::get('/main/kp/koor-prodi/penetapan-sk-pembimbing', 'Main\KP\KoorProdi\PenetapanSKPembimbingController@view')->name('main.kp.koor-prodi.penetapan-sk-pembimbing');
			Route::post('/main/kp/koor-prodi/penetapan-sk-pembimbing/process/{nim}/{opsi}', 'Main\KP\KoorProdi\PenetapanSKPembimbingController@process')->name('main.kp.koor-prodi.penetapan-sk-pembimbing.process');

			Route::get('/main/kp/koor-prodi/persetujuan-surat-permohonan-tugas-pengambilan-data', 'Main\KP\KoorProdi\PersetujuanSuratPermohonanTugasPengambilanDataController@view')->name('main.kp.koor-prodi.persetujuan-sptpd');
			Route::post('/main/kp/koor-prodi/persetujuan-surat-permohonan-tugas-pengambilan-data/process/{nim}/{opsi}', 'Main\KP\KoorProdi\PersetujuanSuratPermohonanTugasPengambilanDataController@process')->name('main.kp.koor-prodi.persetujuan-sptpd.process');

			Route::get('/main/kp/koor-prodi/persetujuan-surat-tugas-pengambilan-data', 'Main\KP\KoorProdi\PersetujuanSuratTugasPengambilanDataController@view')->name('main.kp.koor-prodi.persetujuan-stpd');
			Route::post('/main/kp/koor-prodi/persetujuan-surat-tugas-pengambilan-data/process/{nim}/{opsi}', 'Main\KP\KoorProdi\PersetujuanSuratTugasPengambilanDataController@process')->name('main.kp.koor-prodi.persetujuan-stpd.process');

			Route::get('/main/kp/koor-prodi/penetapan-sk-penguji-sempro', 'Main\KP\KoorProdi\PenetapanSKPengujiSeminarProposalController@view')->name('main.kp.koor-prodi.penetapan-sk-penguji-sempro');
			Route::post('/main/kp/koor-prodi/penetapan-sk-penguji-sempro/process/{nim}/{opsi}', 'Main\KP\KoorProdi\PenetapanSKPengujiSeminarProposalController@process')->name('main.kp.koor-prodi.penetapan-sk-penguji-sempro.process');

			Route::get('/main/kp/koor-prodi/pengesahan-seminar-proposal', 'Main\KP\KoorProdi\PengesahanSeminarProposalController@view')->name('main.kp.koor-prodi.pengesahan-sempro');
			Route::post('/main/kp/koor-prodi/pengesahan-seminar-proposal/process/{nim}/{opsi}', 'Main\KP\KoorProdi\PengesahanSeminarProposalController@process')->name('main.kp.koor-prodi.pengesahan-sempro.process');

			Route::get('/main/kp/koor-prodi/penetapan-sk-penguji-sidang', 'Main\KP\KoorProdi\PenetapanSKPengujiSidangController@view')->name('main.kp.koor-prodi.penetapan-sk-penguji-sidang');
			Route::post('/main/kp/koor-prodi/penetapan-sk-penguji-sidang/process/{nim}/{opsi}', 'Main\KP\KoorProdi\PenetapanSKPengujiSidangController@process')->name('main.kp.koor-prodi.penetapan-sk-penguji-sidang.process');

			Route::get('/main/kp/koor-prodi/pengesahan-sidang', 'Main\KP\KoorProdi\PengesahanSidangController@view')->name('main.kp.koor-prodi.pengesahan-sidang');
			Route::post('/main/kp/koor-prodi/pengesahan-sidang/process/{nim}/{opsi}', 'Main\KP\KoorProdi\PengesahanSidangController@process')->name('main.kp.koor-prodi.pengesahan-sidang.process');

			Route::get('/main/kp/koor-prodi/pengesahan-usulan-yudisium', 'Main\KP\KoorProdi\PengesahanUsulanYudisiumController@view')->name('main.kp.koor-prodi.pengesahan-usulan-yudisium');
			Route::post('/main/kp/koor-prodi/pengesahan-usulan-yudisium/process/{nim}/{opsi}', 'Main\KP\KoorProdi\PengesahanUsulanYudisiumController@process')->name('main.kp.koor-prodi.pengesahan-usulan-yudisium.process');
		});

		//Ketua Kel Keahlian
		Route::middleware('only.ketua-kel-keahlian')->group(function () {
			Route::get('/main/kp/ketua-kel-keahlian/pengusulan-pembimbing-dan-co', 'Main\KP\KetuaKelKeahlian\PengusulanPembimbingController@view')->name('main.kp.ketua-kel-keahlian.pengusulan-pembimbing');
			Route::post('/main/kp/ketua-kel-keahlian/pengusulan-pembimbing-dan-co/process/{nim}', 'Main\KP\KetuaKelKeahlian\PengusulanPembimbingController@process')->name('main.kp.ketua-kel-keahlian.pengusulan-pembimbing.process');
			Route::post('/usul/pembimbing-co/{nim}', 'Main\KP\KetuaKelKeahlian\PengusulanPembimbingController@usul')->name('usul.pembimbing-co');

			Route::get('/main/kp/ketua-kel-keahlian/pengubahan-pembimbing-co', 'Main\KP\KetuaKelKeahlian\PengubahanPembimbingController@view')->name('main.kp.ketua-kel-keahlian.pengubahan-pembimbing');
			Route::post('/main/kp/ketua-kel-keahlian/pengubahan-pembimbing-co/process/{nim}', 'Main\KP\KetuaKelKeahlian\PengubahanPembimbingController@process')->name('main.kp.ketua-kel-keahlian.pengubahan-pembimbing.process');
			Route::post('/ubah/pembimbing-co/{nim}', 'Main\KP\KetuaKelKeahlian\PengubahanPembimbingController@ubah')->name('ubah.pembimbing-co');
		});

		//Pembimbing Co
		Route::middleware('only.pembimbing-co')->group(function () {
			Route::get('/main/kp/pembimbing/persetujuan-seminar-dan-sidang', 'Main\KP\PembimbingCo\PersetujuanSeminarDanSidangController@view')->name('main.kp.pembimbing-co.persetujuan-seminar-dan-sidang');
			Route::post('/main/kp/pembimbing/persetujuan-seminar-dan-sidang/process/{nim}/{type}/{opsi?}', 'Main\KP\PembimbingCo\PersetujuanSeminarDanSidangController@process')->name('main.kp.pembimbing-co.persetujuan-seminar-dan-sidang.process');
		});

		//Koor TGA
		Route::middleware('only.koor-tga')->group(function () {
			Route::get('/main/kp/koor-tga/usulan-seminar-proposal', 'Main\KP\KoorTGA\UsulanSeminarProposalController@view')->name('main.kp.koor-tga.usulan-sempro');
			Route::post('/main/kp/koor-tga/usulan-seminar-proposal/process/{nim}/{opsi}', 'Main\KP\KoorTGA\UsulanSeminarProposalController@process')->name('main.kp.koor-tga.usulan-sempro.process');

			Route::get('/main/kp/koor-tga/usulan-sidang', 'Main\KP\KoorTGA\UsulanSidangController@view')->name('main.kp.koor-tga.usulan-sidang');
			Route::post('/main/kp/koor-tga/usulan-sidang/process/{nim}/{opsi}', 'Main\KP\KoorTGA\UsulanSidangController@process')->name('main.kp.koor-tga.usulan-sidang.process');
		});

		//Komisi Penguji
		Route::middleware('only.komisi-penguji')->group(function () {
			Route::get('/main/kp/komisi-penguji/seminar-sidang', 'Main\KP\KomisiPenguji\SeminarSidangController@view')->name('main.kp.komisi-penguji.seminar-sidang');
			Route::post('/main/kp/komisi-penguji/seminar-sidang/mark-done/{nim}/{type}', 'Main\KP\KomisiPenguji\SeminarSidangController@markDone')->name('main.kp.komisi-penguji.seminar-sidang.mark-done');
		});
});