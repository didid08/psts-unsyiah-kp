<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Data;

class User extends Model
{
    protected $fillable = [
        'category', 'username', 'nomor_induk', 'nama', 'bidang_id', 'avatar', 'email', 'password'
    ];

    protected $hidden = [
        'password'
    ];

    public function bidang() {
        return $this->belongsTo('App\Bidang');
    }

    public function userRole() {
    	return $this->hasMany('App\UserRole');
    }

    public function disposisi() {
        return $this->hasOne('App\Disposisi');
    }

    public function data() {
        return $this->hasMany('App\Data');
    }

    public static function myData($column) {
        $auth = session('auth');

        $identityType;

        if (in_array($auth['category'], array('dosen', 'pejabat', 'mahasiswa'))) {
            $identityType = 'nomor_induk';
        }else {
            $identityType = 'username';
        }

        return User::firstwhere($identityType, $auth['identity'][$identityType])->$column;
    }

    public static function myAllData() {
        $auth = session('auth');

        $identityType;

        if (in_array($auth['category'], array('dosen', 'pejabat', 'mahasiswa'))) {
            $identityType = 'nomor_induk';
        }else {
            $identityType = 'username';
        }

        return User::where($identityType, $auth['identity'][$identityType])->first();
    }

    public static function dataWithCategory($category, $option = null) {
        if ($option != null) {
            if ($option == 'bidang') {
                return User::where('category', $category)->whereNotNull('bidang_id')->get();
            }
        }else {
            return User::where('category', $category)->get();
        }
    }

    public function dataBimbingan() {

        $bimbingan = [];

        $semua_dosen = $this->where('category', 'dosen')->get();

        foreach ($semua_dosen as $dosen) {
            $bimbingan[$dosen->nama] = [];
        }

        if (Data::where('name', 'pembimbing')->exists()) {

            $x = Data::where('name', 'pembimbing')->get();
            foreach ($x as $y) {
                array_push($bimbingan[$y->content], $y->user->nama);
            }
        }

        return $bimbingan;
    }

    public function calculateBimbingan($to_calculate) {

        $bimbingan = $this->dataBimbingan();

        if ($to_calculate == 'total') {

            $total_bimbingan = [];

            foreach ($bimbingan as $index => $value) {
                $total_bimbingan[$index] = count($value);
            }
            return $total_bimbingan;

        }
        else if ($to_calculate == 'selesai') {

            $selesai_bimbingan = [];

            foreach ($bimbingan as $index => $value) {
                $selesai_bimbingan[$index] = 0;

                if (count($value) != 0) {
                    foreach ($value as $value2) {
                        $mhs_id = $this->firstWhere('nama', $value2)->id;

                        if ($this->find($mhs_id)->disposisi()->value('progress') > 22) {
                            $selesai_bimbingan[$index] = $selesai_bimbingan[$index]+1;
                        }
                    }
                }
            }
            return $selesai_bimbingan;

        }
        return false;
    }

    public function dataPembahas() {

        $pembahas = [];

        $semua_dosen = $this->where('category', 'dosen')->get();

        foreach ($semua_dosen as $dosen) {
            $pembahas[$dosen->nama] = [];
        }

        if (Data::where('name', 'pembahas')->exists()) {

            $x = Data::where('name', 'pembahas')->get();
            foreach ($x as $y) {
                array_push($pembahas[$y->content], $y->user->nama);
            }
        }

        return $pembahas;
    }

    public function calculatePembahas($to_calculate) {

        $bimbingan = $this->dataPembahas();
        if ($to_calculate == 'total') {

            $total_bimbingan = [];
            foreach ($bimbingan as $index => $value) {
                $total_bimbingan[$index] = count($value);
            }
            return $total_bimbingan;

        }
        else if ($to_calculate == 'selesai') {

            $selesai_bimbingan = [];

            foreach ($bimbingan as $index => $value) {
                $selesai_bimbingan[$index] = 0;

                if (count($value) != 0) {
                    foreach ($value as $value2) {
                        $mhs_id = $this->firstWhere('nama', $value2)->id;

                        if ($this->find($mhs_id)->disposisi()->value('progress') > 22) {
                            $selesai_bimbingan[$index] = $selesai_bimbingan[$index]+1;
                        }
                    }
                }
            }
            return $selesai_bimbingan;

        }
        return false;
    }

    public function dataDosenWali () {
        $dosen_wali = [];

        $semua_dosen = $this->where('category', 'dosen')->get();

        foreach ($semua_dosen as $dosen) {
            $dosen_wali[$dosen->nama] = [];
        }

        if (Data::where('name', 'dosen-wali')->exists()) {

            $x = Data::where('name', 'dosen-wali')->get();
            foreach ($x as $y) {
                array_push($dosen_wali[$y->content], $y->user->nama);
            }
        }

        return $dosen_wali;
    }

    public function calculateDosenWali () {
        $bimbingan = $this->dataDosenWali();
            $dosen_wali = [];
            foreach ($bimbingan as $index => $value) {
                $dosen_wali[$index] = count($value);
            }
            return $dosen_wali;
        return false;
    }

    public function listMahasiswaWith($with)
    {
        if ($with == 'ketua-bidang') {
            $mahasiswa = [];
            $data = new Data();

            foreach(User::where('category', 'mahasiswa')->get() as $mhs) {
                $ketuaBidang = $data->getSingleData($mhs->id, 'ketua-bidang');
                if ($ketuaBidang != false) {
                    $mahasiswa[$mhs->nama] = $ketuaBidang->content;
                }
            }

            return $mahasiswa;
        }
    }
}
