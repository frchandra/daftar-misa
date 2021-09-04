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
                    ->select('umats.nama', 'lingkungans.nama AS namaLingkungan', 'misas.perayaan', 'misas.tanggal', 'misas.jam', 'umat_lingkungan_misas.umat_lingkungan_misa_id')
                    ->where('umats.umat_id', $umatId)
                    ->get();
    }

    public function index(Request $request){
        // return 'ok';
        $nama = $request->nama;
        $nik = $request->nik;
        $lingkunganId = $request->lingkungan;
        $umatId = DB::table('umats')->select('umat_id')->where('nik', $nik)->where('lingkungan_id', $lingkunganId)->first();
        $umatId = json_decode(json_encode($umatId), true);
        $misa = $this->getUlm($umatId);
        // $misa->dd();
        if($misa->isEmpty()){
            
            return view('cekMisa',[
                'response'=>'gagal'                
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

        DB::table('umat_lingkungan_misas')->where('umat_lingkungan_misa_id', '=', $ulmId)->delete();

        return response()->json([
            'response'=>'sukses'
        ]);


    }
}
