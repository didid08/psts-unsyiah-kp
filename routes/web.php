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
		});

		//Koor Prodi
		Route::middleware('only.koor-prodi')->group(function () {
			Route::get('/main/kp/koor-prodi/persetujuan-usulan-kp', 'Main\KP\KoorProdi\PersetujuanUsulanKPController@view')->name('main.kp.koor-prodi.persetujuan-usulan-kp');
			Route::post('/main/kp/koor-prodi/persetujuan-usulan-kp/process/{nim}/{opsi}', 'Main\KP\KoorProdi\PersetujuanUsulanKPController@process')->name('main.kp.koor-prodi.persetujuan-usulan-kp.process');
		});

		//Ketua Kel Keahlian
		Route::middleware('only.ketua-kel-keahlian')->group(function () {
			Route::get('/main/kp/ketua-kel-keahlian/pengusulan-pembimbing-dan-pembahas', 'Main\KP\KetuaKelKeahlian\PengusulanPembimbingPembahasController@view')->name('main.kp.ketua-kel-keahlian.pengusulan-pembimbing-pembahas');
			Route::post('/main/kp/ketua-kel-keahlian/pengusulan-pembimbing-dan-pembahas/process/{nim}', 'Main\KP\KetuaKelKeahlian\PengusulanPembimbingPembahasController@process')->name('main.kp.ketua-kel-keahlian.pengusulan-pembimbing-pembahas.process');
			Route::post('/usul/pembimbing-pembahas/{nim}', 'Main\KP\KetuaKelKeahlian\PengusulanPembimbingPembahasController@usul')->name('usul.pembimbing-pembahas');
		});

		//Pembimbing
		Route::middleware('only.pembimbing-co')->group(function () {
			
		});

		//Pembahas
		Route::middleware('only.koor-tga')->group(function () {
			
		});
});