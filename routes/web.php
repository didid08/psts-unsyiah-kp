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

			Route::get('/main/biodata', 'Main\Mahasiswa\BiodataController@view')->name('main.mahasiswa.biodata');
			Route::post('/main/biodata', 'Main\Mahasiswa\BiodataController@process')->name('main.mahasiswa.biodata.process');
		});
		
		//Admin
		Route::middleware('only.admin')->group(function () {
			Route::get('/main/kp/admin/usulan-kp', 'Main\KP\Admin\UsulanKPController@view')->name('main.kp.admin.usulan-kp');
			Route::post('/main/kp/admin/usulan-kp/process/{nim}/{opsi}', 'Main\KP\Admin\UsulanKPController@process')->name('main.kp.admin.usulan-kp.process');

			Route::get('/main/kp/admin/usulan-surat-permohonan-ke-proyek', 'Main\KP\Admin\UsulanSuratPermohonanKeProyekController@view')->name('main.kp.admin.usulan-surat-permohonan-ke-proyek');
			Route::post('/main/kp/admin/usulan-surat-permohonan-ke-proyek/process/{nim}', 'Main\KP\Admin\UsulanSuratPermohonanKeProyekController@process')->name('main.kp.admin.usulan-surat-permohonan-ke-proyek.process');

			Route::get('/main/kp/admin/usulan-surat-ke-proyek', 'Main\KP\Admin\UsulanSuratKeProyekController@view')->name('main.kp.admin.usulan-surat-ke-proyek');
			Route::post('/main/kp/admin/usulan-surat-ke-proyek/process/{nim}', 'Main\KP\Admin\UsulanSuratKeProyekController@process')->name('main.kp.admin.usulan-surat-ke-proyek.process');

			Route::get('/main/kp/admin/usulan-sk-pembimbing-pembahas', 'Main\KP\Admin\UsulanSKPembimbingPembahasController@view')->name('main.kp.admin.usulan-sk-pembimbing-pembahas');
			Route::post('/main/kp/admin/usulan-sk-pembimbing-pembahas/process/{nim}', 'Main\KP\Admin\UsulanSKPembimbingPembahasController@process')->name('main.kp.admin.usulan-sk-pembimbing-pembahas.process');
			
			Route::get('/main/kp/admin/usulan-surat-balasan-dari-proyek', 'Main\KP\Admin\UsulanSuratBalasanDariProyekController@view')->name('main.kp.admin.usulan-surat-balasan-dari-proyek');
			Route::post('/main/kp/admin/usulan-surat-balasan-dari-proyek/process/{nim}/{opsi}', 'Main\KP\Admin\UsulanSuratBalasanDariProyekController@process')->name('main.kp.admin.usulan-surat-balasan-dari-proyek.process');

			Route::get('/main/kp/admin/usulan-surat-permohonan-tugas-pengambilan-data', 'Main\KP\Admin\UsulanSuratPermohonanTugasPengambilanDataController@view')->name('main.kp.admin.usulan-sptpd');
			Route::post('/main/kp/admin/usulan-surat-permohonan-tugas-pengambilan-data/process/{nim}/{opsi}', 'Main\KP\Admin\UsulanSuratPermohonanTugasPengambilanDataController@process')->name('main.kp.admin.usulan-sptpd.process');

			Route::get('/main/kp/admin/usulan-surat-tugas-pengambilan-data', 'Main\KP\Admin\UsulanSuratTugasPengambilanDataController@view')->name('main.kp.admin.usulan-stpd');
			Route::post('/main/kp/admin/usulan-surat-tugas-pengambilan-data/process/{nim}', 'Main\KP\Admin\UsulanSuratTugasPengambilanDataController@process')->name('main.kp.admin.usulan-stpd.process');

			Route::get('/main/kp/admin/usulan-pengisian-masa-kp', 'Main\KP\Admin\UsulanPengisianMasaKPController@view')->name('main.kp.admin.usulan-pengisian-masa-kp');
			Route::post('/main/kp/admin/usulan-pengisian-masa-kp/process/{nim}/{opsi}', 'Main\KP\Admin\UsulanPengisianMasaKPController@process')->name('main.kp.admin.usulan-pengisian-masa-kp.process');

			Route::get('/main/kp/admin/usulan-kelengkapan-dokumen-administrasi', 'Main\KP\Admin\UsulanKelengkapanDokumenAdministrasiController@view')->name('main.kp.admin.usulan-kelengkapan-dokumen-administrasi');
			Route::post('/main/kp/admin/usulan-kelengkapan-dokumen-administrasi/process/{nim}/{opsi}', 'Main\KP\Admin\UsulanKelengkapanDokumenAdministrasiController@process')->name('main.kp.admin.usulan-kelengkapan-dokumen-administrasi.process');

			Route::get('/main/kp/cetak/surat-permohonan-ke-proyek/{nim}', 'Main\KP\Admin\UsulanSuratPermohonanKeProyekController@cetak')->name('main.kp.admin.cetak.surat-permohonan-ke-proyek');
			Route::get('/main/kp/cetak/surat-ke-proyek/{nim}', 'Main\KP\Admin\UsulanSuratKeProyekController@cetak')->name('main.kp.admin.cetak.surat-ke-proyek');
		});

		//Koor Prodi
		Route::middleware('only.koor-prodi')->group(function () {
			Route::get('/main/kp/koor-prodi/persetujuan-usulan-kp', 'Main\KP\KoorProdi\PersetujuanUsulanKPController@view')->name('main.kp.koor-prodi.persetujuan-usulan-kp');
			Route::post('/main/kp/koor-prodi/persetujuan-usulan-kp/process/{nim}/{opsi}', 'Main\KP\KoorProdi\PersetujuanUsulanKPController@process')->name('main.kp.koor-prodi.persetujuan-usulan-kp.process');

			Route::get('/main/kp/koor-prodi/penetapan-surat-ke-proyek', 'Main\KP\KoorProdi\PenetapanSuratKeProyekController@view')->name('main.kp.koor-prodi.penetapan-surat-ke-proyek');
			Route::post('/main/kp/koor-prodi/penetapan-surat-ke-proyek/process/{nim}/{opsi}', 'Main\KP\KoorProdi\PenetapanSuratKeProyekController@process')->name('main.kp.koor-prodi.penetapan-surat-ke-proyek.process');

			Route::get('/main/kp/koor-prodi/penetapan-sk-pembimbing-pembahas', 'Main\KP\KoorProdi\PenetapanSKPembimbingPembahasController@view')->name('main.kp.koor-prodi.penetapan-sk-pembimbing-pembahas');
			Route::post('/main/kp/koor-prodi/penetapan-sk-pembimbing-pembahas/process/{nim}/{opsi}', 'Main\KP\KoorProdi\PenetapanSKPembimbingPembahasController@process')->name('main.kp.koor-prodi.penetapan-sk-pembimbing-pembahas.process');

			Route::get('/main/kp/koor-prodi/persetujuan-stpd', 'Main\KP\KoorProdi\PersetujuanSuratTugasPengambilanDataController@view')->name('main.kp.koor-prodi.persetujuan-stpd');
			Route::post('/main/kp/koor-prodi/persetujuan-stpd/process/{nim}/{opsi}', 'Main\KP\KoorProdi\PersetujuanSuratTugasPengambilanDataController@process')->name('main.kp.koor-prodi.persetujuan-stpd.process');
		
			Route::get('/main/kp/koor-prodi/pengisian-rekap-nilai-kp', 'Main\KP\KoorProdi\PengisianRekapNilaiKPController@view')->name('main.kp.koor-prodi.pengisian-rekap-nilai-kp');
			Route::post('/main/kp/koor-prodi/pengisian-rekap-nilai-kp/process/{nim}', 'Main\KP\KoorProdi\PengisianRekapNilaiKPController@process')->name('main.kp.koor-prodi.pengisian-rekap-nilai-kp.process');

			Route::get('/main/kp/koor-prodi/persetujuan-usulan-kelengkapan-dokumen-administrasi', 'Main\KP\KoorProdi\PersetujuanUsulanKelengkapanDokumenAdministrasiController@view')->name('main.kp.koor-prodi.persetujuan-usulan-kelengkapan-dokumen-administrasi');
			Route::post('/main/kp/koor-prodi/persetujuan-usulan-kelengkapan-dokumen-administrasi/process/{nim}/{opsi}', 'Main\KP\KoorProdi\PersetujuanUsulanKelengkapanDokumenAdministrasiController@process')->name('main.kp.koor-prodi.persetujuan-usulan-kelengkapan-dokumen-administrasi.process');
		});
		Route::get('/main/kp/cetak/rekap-nilai-kp/{nim}', 'Main\KP\KoorProdi\PengisianRekapNilaiKPController@cetakRekapNilaiKP')->name('main.kp.cetak-rekap-nilai-kp');

		//Ketua Kel Keahlian
		Route::middleware('only.ketua-kel-keahlian')->group(function () {
			Route::get('/main/kp/ketua-kel-keahlian/pengusulan-pembimbing-dan-pembahas', 'Main\KP\KetuaKelKeahlian\PengusulanPembimbingPembahasController@view')->name('main.kp.ketua-kel-keahlian.pengusulan-pembimbing-pembahas');
			Route::post('/main/kp/ketua-kel-keahlian/pengusulan-pembimbing-dan-pembahas/process/{nim}', 'Main\KP\KetuaKelKeahlian\PengusulanPembimbingPembahasController@process')->name('main.kp.ketua-kel-keahlian.pengusulan-pembimbing-pembahas.process');
			Route::post('/usul/pembimbing-pembahas/{nim}', 'Main\KP\KetuaKelKeahlian\PengusulanPembimbingPembahasController@usul')->name('usul.pembimbing-pembahas');
		});

		//Pembimbing
			Route::get('/main/kp/pembimbing/pemeriksaan-berkas-kp', 'Main\KP\Pembimbing\PemeriksaanBerkasKPController@view')->name('main.kp.pembimbing.pemeriksaan-berkas-kp');
			Route::post('/main/kp/pembimbing/pemeriksaan-berkas-kp/process/{nim}', 'Main\KP\Pembimbing\PemeriksaanBerkasKPController@process')->name('main.kp.pembimbing.pemeriksaan-berkas-kp.process');

			Route::get('/main/kp/pembimbing/penilaian-kp', 'Main\KP\Pembimbing\PenilaianKPController@view')->name('main.kp.pembimbing.penilaian-kp');
			Route::post('/main/kp/pembimbing/penilaian-kp/process/{nim}', 'Main\KP\Pembimbing\PenilaianKPController@process')->name('main.kp.pembimbing.penilaian-kp.process');

			Route::get('/main/kp/pembimbing/isi-nilai-kp/{nim}', 'Main\KP\Pembimbing\PenilaianKPController@isiNilaiKP')->name('main.kp.pembimbing.isi-nilai-kp');
			Route::get('/main/kp/cetak-nilai-kp-dari-pembimbing/{nim}', 'Main\KP\Pembimbing\PenilaianKPController@cetakNilaiKP')->name('main.kp.cetak-nilai-kp-pembimbing');
			Route::post('/main/kp/pembimbing/isi-nilai-kp/{nim}/simpan', 'Main\KP\Pembimbing\PenilaianKPController@isiNilaiKPSimpan')->name('main.kp.pembimbing.isi-nilai-kp.simpan');

			Route::get('/main/kp/pembimbing/pemeriksaan-kelengkapan-dokumen-kp', 'Main\KP\Pembimbing\PemeriksaanKelengkapanDokumenKPController@view')->name('main.kp.pembimbing.pemeriksaan-kelengkapan-dokumen-kp');
			Route::post('/main/kp/pembimbing/pemeriksaan-kelengkapan-dokumen-kp/process/{nim}', 'Main\KP\Pembimbing\PemeriksaanKelengkapanDokumenKPController@process')->name('main.kp.pembimbing.pemeriksaan-kelengkapan-dokumen-kp.process');

		//Pembahas
			Route::get('/main/kp/pembahas/penilaian-kp', 'Main\KP\Pembahas\PenilaianKPController@view')->name('main.kp.pembahas.penilaian-kp');
			Route::post('/main/kp/pembahas/penilaian-kp/process/{nim}', 'Main\KP\Pembahas\PenilaianKPController@process')->name('main.kp.pembahas.penilaian-kp.process');

			Route::get('/main/kp/pembahas/isi-nilai-kp/{nim}', 'Main\KP\Pembahas\PenilaianKPController@isiNilaiKP')->name('main.kp.pembahas.isi-nilai-kp');
			Route::get('/main/kp/cetak-nilai-kp-dari-pembahas/{nim}', 'Main\KP\Pembahas\PenilaianKPController@cetakNilaiKP')->name('main.kp.cetak-nilai-kp-pembahas');
			Route::post('/main/kp/pembahas/isi-nilai-kp/{nim}/simpan', 'Main\KP\Pembahas\PenilaianKPController@isiNilaiKPSimpan')->name('main.kp.pembahas.isi-nilai-kp.simpan');
});