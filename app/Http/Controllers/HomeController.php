<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 


use App\Repositories\LingkunganMisaRepository;
use App\Repositories\UlmRepository;
use App\Repositories\UmatRepository;

use App\Services\ValidatorService;


class HomeController extends Controller
{

    private $umat;
    private $lingkunganMisa;
    private $ulm;
    private $validator;

    public function __construct(UmatRepository $umatRepository, UlmRepository $ulmRepository, LingkunganMisaRepository $lingkunganMisaRepository, ValidatorService $validator){
        $this->umat = $umatRepository;
        $this->lingkunganMisa = $lingkunganMisaRepository;
        $this->ulm = $ulmRepository;
        $this->validator = $validator;
    }
    
    public function index(){ 
        $misas = $this->lingkunganMisa->getPresentMisas();
        return view('home',[
            'misas'=>$misas
        ]);
    }

    public function validatePendaftaran(Request $request){ //logic, validation
        $nik = $request->nik;
        $nama = $request->nama;
        $lingkungan = $request->lingkungan;    

        return $this->validator->validateUmat($nik, $nama, $lingkungan);

    }

    public function storePendaftaran(Request $request){ //logic, query
        $umatIds = $request->input('umats');
        $lingkunganMisaId = $request->input('lingkungan_misa_id');  



        //$store = collect();        

        //logic
        foreach($umatIds as $umatId){            
            if($this->ulm->getForeignKey($umatId, $lingkunganMisaId)->isNotEmpty()){
                // $store->push(['umat_id'=>$umatId, 'lingkungan_misa_id'=>$lingkunganMisaId]);
                $array = json_decode(json_encode($this->ulm->getUlm($umatId)), true);
                return view('response',[  //sudah terdaftar, kembalikan siapa yg terdaftar
                    'response'=>'gagal',
                    'data'=>$array
                ]);  
            }
             
        }
        //transaksi query

        DB::beginTransaction();
        // DB::transaction(function () use ($umatIds, $lingkunganMisaId){
            foreach($umatIds as $umatId){
                $this->ulm->create($umatId, $lingkunganMisaId);
                $affected = $this->lingkunganMisa->addUmat($lingkunganMisaId);
                
                
                if($affected<1){
                    DB::rollBack();
                    return view('response',[
                        'response'=>'penuh'
                    ]);
                    // return $affected;
                }

            } 
        // });
        DB::commit();

        return view('response',[
            'response'=>'sukses'
        ]);       

    }

    public function daftarBaru(Request $request){ //query
        $nama = $request->nama;
        $namaBabtis = $request->namaBabtis;
        $nik = $request->nik;
        $kk = $request->kk;
        $hp = $request->hp;
        $tgl = $request->tgl;
        $kl = $request->jenisKelamin;
        $vaksin = $request->vaksin;
        $lmId = $request->lingkungan_misa_id;

        if($this->umat->getByNik($nik)->isEmpty()){
            $id = $this->umat->insert($nama, $namaBabtis, $nik, $kk, $tgl, $kl, $vaksin, $hp);

            //transaksi
            DB::transaction(function () use ($id, $lmId){ 
                $this->ulm->create($id, $lmId);
                $this->lingkunganMisa->addUmat($lmId);
            });

            return view('response',[
                'response'=>'sukses',                
            ]);            
        }

        else{
            return view('response',[
                'response'=>'error',                
            ]);
        }

    }

}
