<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CekMisa extends Controller
{

    public function getUlm($umatId){
        return DB::table('umat_lingkungan_misas')
                    ->join('umats', 'umat_lingkungan_misas.umat_id', '=', 'umats.umat_id')
                    ->join('lingkungan_misas', 'umat_lingkungan_misas.lingkungan_misa_id', '=', 'lingkungan_misas.lingkungan_misa_id')
                    ->join('lingkungans', 'lingkungan_misas.lingkungan_id', '=', 'lingkungans.lingkungan_id')
                    ->join('misas', 'lingkungan_misas.misa_id', '=', 'misas.misa_id')
                    ->select('umats.nama', 'misas.perayaan', 'misas.tanggal', 'misas.jam', 'umats.umat_id', 'umat_lingkungan_misas.umat_lingkungan_misa_id', 'lingkungan_misas.lingkungan_misa_id')
                    ->where('umats.umat_id', $umatId)
                    ->get();
    }

    public function index(Request $request){
        // return 'ok';
        $nama = $request->nama;
        $nik = $request->nik;
        $lingkunganId = $request->lingkungan;

        $umatId = DB::table('umats')->select('umat_id')->where('nik', $nik)->where('lingkungan_id', $lingkunganId)->first();


       

        if($umatId==NULL){
            $umatId = DB::table('umats')->select('umat_id')->where('nik', $nik)->first();
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

        $misa = $this->getUlm($umatId);
        
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
            DB::table('umat_lingkungan_misas')->where('umat_lingkungan_misa_id', '=', $ulmId)->delete();
            DB::table('lingkungan_misas')
                ->where('lingkungan_misa_id', $lmId)
                ->update(['kuota' => DB::raw('kuota+1'), 'terdaftar' => DB::raw('terdaftar-1')]);  
        });


        $misa = $this->getUlm($umatId);
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
