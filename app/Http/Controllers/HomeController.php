<?php

namespace App\Http\Controllers;

use App\Models\Umat;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{

    private function getMisas(){
        $misas = DB::table('lingkungan_misas')
                ->join('misas', 'lingkungan_misas.misa_id', '=', 'misas.misa_id')
                ->join('lingkungans' ,'lingkungan_misas.lingkungan_id', '=', 'lingkungans.lingkungan_id')
                ->select('misas.misa_id', 'misas.perayaan', 'misas.tanggal', 'misas.jam', 'lingkungans.lingkungan_id', 'lingkungans.nama', 'lingkungan_misas.kuota', 'lingkungan_misas.terdaftar')
                ->orderBy('misas.tanggal', 'asc')
                ->orderBy('misas.jam', 'asc')
                ->get();
        return $misas;
    }

    private function getFilteredMisas($linggkungan_id){
        $misas = $this->getMisas()->groupBy('misa_id');

        $out = collect();

        foreach ($misas as $misa){            
            $temp = collect($misa->firstWhere('lingkungan_id', $linggkungan_id));
            if($temp->isEmpty()){
                $out->push(collect($misa->firstWhere('lingkungan_id', $linggkungan_id)));
            }
            else{
                $out->push($temp);
            }
        }

        return $out;       
    }

    private function getKk($nik){
        return Umat::select('kk')->where('nik', $nik)->first();
    }

    private function getUmats($kk){
        return DB::table('umats')
        ->join('lingkungans', 'umats.lingkungan_id', '=', 'lingkungans.lingkungan_id')
        ->select('umats.nama', 'umats.nik', 'umats.kk', 'lingkungans.nama AS namaLingkungan', 'lingkungans.lingkungan_id')->where('kk', strval($kk['kk']) )->get();
    }

    public function index(){        
        $misas = $this->getMisas();
        return view('home',[
            'misas'=>$misas
        ]);
    }

    public function validatePendaftaran(Request $request){
        $nik = $request->nik;
        $nama = $request->nama;
        $lingkungan = $request->lingkungan;     
        
        $cekNik = Validator::make($request->toArray(),
            [
            'nama' => Rule::exists('umats', 'nama')->where('nama', $nama)->where('nik', $nik) 
            ]
        );

        $cekLing = Validator::make($request->toArray(),
            [
            'lingkungan' => Rule::exists('umats', 'lingkungan_id')->where('nama', $nama)->where('lingkungan_id',$lingkungan) 
            ]
        );

        if (!$cekNik->fails()) {
            if($cekLing->fails()){
               return response()->json(['success'=>'lingkungan error']);
            }      
            $kk = $this->getKk($nik);
            $keluarga = $this->getUmats($kk);
            $misas = $this->getFilteredMisas($lingkungan);            
            return response()->json([
                'success'=>$keluarga,
                'misa'=>$misas
            ]);
        }

        if ($cekNik->fails()){
            return response()->json(['success'=>'tidak terdaftar']);
        }
    }
}
