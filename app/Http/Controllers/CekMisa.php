<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Repositories\LingkunganMisaRepository;
use App\Repositories\UlmRepository;
use App\Repositories\UmatRepository;


class CekMisa extends Controller
{

    private $umat;
    private $lingkunganMisa;
    private $ulm;

    public function __construct(UmatRepository $umatRepository, UlmRepository $ulmRepository, LingkunganMisaRepository $lingkunganMisaRepository){
        $this->umat = $umatRepository;
        $this->lingkunganMisa = $lingkunganMisaRepository;
        $this->ulm = $ulmRepository;
    }

    public function index(Request $request){
        $nama = $request->nama;
        $nik = $request->nik;
        $lingkunganId = $request->lingkungan;

        $umatId = $this->umat->getUmatIdByNIklId($nik, $lingkunganId);

        if($umatId==NULL){
            $umatId = $this->umat->getUmatIdByNik($nik);
            if($umatId==NULL){
                return view('cekMisa',[
                    'response'=>'gagal'
                ]);
            }
            return view('cekMisa',[
                'response'=>'lingkungan error'
            ]);
        }

        $umatId = json_decode(json_encode($umatId), true);
        
        $misa = $this->ulm->getUlm($umatId);
        
        if($misa->isEmpty()){
            return view('cekMisa',[
                'response'=>'sukses',
                'nama'=> $nama,
                'data'=>'kosong'
            ]);
        }
        $misa = json_decode(json_encode($misa), true);
        return view('cekMisa',[
            'response'=>'sukses',
            'nama'=> $nama,
            'data'=>$misa 
        ]);
    }

    public function delete(Request $request){
        $ulmId = $request->ulmId;
        $umatId = $request->umatId;
        $nama = $request->nama;
        $lmId = $request->lingkunganMisaId;

        //transaksi
        DB::transaction(function () use ($ulmId, $lmId) {
            $this->ulm->delete($ulmId);
            $this->lingkunganMisa->deleteUmat($lmId);

        });

        $misa = $this->ulm->getUlm($umatId);
        if($misa->isEmpty()){
            return view('cekMisa', [
                'response'=> 'sukses',
                'data'=>'kosong',
                'nama'=>$nama
            ]);
        }
        else{
            $misa = json_decode(json_encode($misa), true);
            return view('cekMisa', [
                'response'=> 'sukses',
                'data'=>$misa,
                'nama'=>$nama
            ]);
        }
    }
}
