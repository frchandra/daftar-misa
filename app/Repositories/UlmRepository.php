<?php

namespace App\Repositories;


use App\Models\UmatLingkunganMisa;
use Illuminate\Support\Facades\DB; 

class UlmRepository
{
    protected $Ulm;

    public function __construct(UmatLingkunganMisa $Ulm){
        $this->Ulm = $Ulm;
    }

    public function getForeignKey($umatId, $lingkunganMisaId){ //query
        return UmatLingkunganMisa::select('umat_id', 'lingkungan_misa_id')
                ->where('umat_id', '=', $umatId)
                ->where('lingkungan_misa_id', '=', $lingkunganMisaId)
                ->get();
    }

    public function getUlm($umatId){ //query
        return UmatLingkunganMisa::join('umats', 'umat_lingkungan_misas.umat_id', '=', 'umats.umat_id')
                    ->join('lingkungan_misas', 'umat_lingkungan_misas.lingkungan_misa_id', '=', 'lingkungan_misas.lingkungan_misa_id')
                    ->join('lingkungans', 'lingkungan_misas.lingkungan_id', '=', 'lingkungans.lingkungan_id')
                    ->join('misas', 'lingkungan_misas.misa_id', '=', 'misas.misa_id')
                    ->select('umats.nama', 'lingkungans.nama AS namaLingkungan', 'misas.perayaan', 'misas.tanggal', 'misas.jam', 'umats.umat_id', 'lingkungan_misas.lingkungan_misa_id', 'umat_lingkungan_misas.umat_lingkungan_misa_id')
                    ->where('umats.umat_id', $umatId)
                    ->get();
    }

    public function create($umatId, $lingkunganMisaId){
        UmatLingkunganMisa::create([
            'umat_id'=>$umatId,
            'lingkungan_misa_id'=>$lingkunganMisaId
        ]);
    }

    public function delete($ulmId){
        UmatLingkunganMisa::where('umat_lingkungan_misa_id', '=', $ulmId)->delete();
    }

    public function store($umatIds, $lmId){
        DB::beginTransaction();
        foreach($umatIds as $umatId){
            if($this->getForeignKey($umatId, $lmId)->isNotEmpty()){
                $array = json_decode(json_encode($this->getUlm($umatId)), true);
                DB::rollBack();
                return view('response',[  //sudah terdaftar, kembalikan siapa yg terdaftar
                    'response'=>'gagal',
                    'data'=>$array
                ]);  
            }
            // $affected = 
        }
    }





}