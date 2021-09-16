<?php

namespace App\Services;



use App\Repositories\LingkunganMisaRepository;
use App\Repositories\UlmRepository;
use App\Repositories\UmatRepository;

class ValidatorService
{
    private $umat;
    private $lingkunganMisa;
    private $ulm;

    public function __construct(UmatRepository $umatRepository, UlmRepository $ulmRepository, LingkunganMisaRepository $lingkunganMisaRepository){
        $this->umat = $umatRepository;
        $this->lingkunganMisa = $lingkunganMisaRepository;
        $this->ulm = $ulmRepository;
    }

    private function getFilteredMisas($lingkungan_id){ //helper, filter
        $misas = $this->lingkunganMisa->getPresentMisas()->groupBy('misa_id');
        $out = collect();

        foreach ($misas as $misa){            
            $temp = collect($misa->firstWhere('lingkungan_id', $lingkungan_id));
            if($temp->isEmpty()){
                $out->push(collect($misa->firstWhere('lingkungan_id', 1)));           
            }
            else{
                $out->push($temp);
            }
        }
        return $out;       
    }

    public function validateUmat($nik, $nama, $lingkungan){   
        if ($this->umat->getByUmatNik($nama, $nik)->isNotEmpty()) {
            if($this->umat->getByUmatLingId($nama, $lingkungan)->isEmpty()){
                return response()->json(['sukses'=>'lingkungan error']);
            } 
            $kk = $this->umat->getKk($nik);
            $keluarga = $this->umat->getByKk($kk);
            $misas = $this->getFilteredMisas($lingkungan);            
            return response()->json([
                'content'=>view('modal.pendaftaran-lama')->render(),
                'sukses'=>'berhasil',
                'success'=>$keluarga,
                'misa'=>$misas
            ]);
        }  

        else{
            $misas = $this->getFilteredMisas(2);
            return response()->json([
                'content'=>view('modal.pendaftaran-baru')->render(),
                'misa'=>$misas
            ]);
        }
    }






}