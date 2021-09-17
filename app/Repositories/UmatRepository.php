<?php

namespace App\Repositories;

use App\Models\Umat;

class UmatRepository
{
    protected $Umat;

    public function __construct(Umat $Umat){
        $this->Umat = $Umat;
    }

    public function getByUmatNik($nama, $nik){
        return Umat::where('nama', 'like', '%'. $nama .'%')->where('nik', $nik)->get();
    }

    public function getByUmatNikLingId($nama, $nik, $lingkunganId){
        return Umat::where('lingkungan_id', $lingkunganId)->where('nik', $nik)->where('nama', 'like', '%'. $nama .'%')->get();
    }

    public function getByKk($kk){
        return Umat::join('lingkungans', 'umats.lingkungan_id', '=', 'lingkungans.lingkungan_id')
        ->select('umats.umat_id', 'umats.nama', 'umats.nik', 'umats.kk', 'lingkungans.nama AS namaLingkungan', 'lingkungans.lingkungan_id')->where('kk', strval($kk['kk']) )->get();
    }

    public function getKk($nik){
        return Umat::select('kk')->where('nik', $nik)->first();
    }

    public function getUmatIdByNikNama($nik, $nama){
        return Umat::where('nik', $nik)->where('nama', $nama)->first();
    }

    public function getUmatIdByNIklIdNama($nik, $lingkunganId, $nama){
        return Umat::where('nik', $nik)->where('lingkungan_id', $lingkunganId)->where('nama', $nama)->first();
    }


    public function insert($nama, $namaBabtis, $nik, $kk, $tgl, $kl, $vaksin, $hp){
        $id = Umat::insertGetId([
            'lingkungan_id' => '2',
            'nama' => $nama,
            'nama_babtis' => $namaBabtis,
            'nik' => $nik,
            'kk'=>$kk,
            'tanggal_lahir' => $tgl,
            'jenis_kelamin' => $kl,
            'vaksin' => $vaksin,
            'hp'=> $hp
        ]);

        return $id;
    }

    public function getByNik($nik){ //query //todo validate nik //pengganti checkDuplicate
        return Umat::where('nik', $nik)->get();
    }


}
