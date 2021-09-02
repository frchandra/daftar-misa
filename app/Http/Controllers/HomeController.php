<?php

namespace App\Http\Controllers;

use App\Models\Umat;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    
    public function index(){
        return view('home',[
            'header'=>'hello world...'
        ]);
    }
  

    public function cekNik(Request $request){

        // $nik = $request->input('nik');
        // $nama = $request->input('nama');  
        // $lingkungan = $request->input('lingkungan');

        // $cekNik = Validator::make($request->toArray(),
        //     [
        //     'nama' => Rule::exists('umats')->where('nama', $nama)->where('nik', $nik) 
        //     ]
        // );

        // $cekLink = Validator::make($request->toArray(),
        //     [
        //     'lingkungan' => Rule::exists('umats', 'lingkungan_id')->where('nama', $nama)->where('lingkungan_id',$lingkungan) 
        //     ]
        // );

        // if (!$cekNik->fails()) {
        //     if($cekLink->fails()){
        //         return redirect('/')->with('success', 'terdaftar, nama nik bener, link typo');
        //     }
        //     return redirect('/')->with('success', 'terdaftar, nama nik bener, link bener');
        // }

        // if ($cekNik->fails()){
        //     return redirect('/')->with('success', 'tidak terdaftar, nik salah');
        // }

        $nik = $request->nik;
        $nama = $request->nama;
        $lingkungan = $request->lingkungan; 


        $cekNik = Validator::make($request->toArray(),
            [
            'nama' => Rule::exists('umats', 'nama')->where('nama', $nama)->where('nik', $nik) 
            ]
        );

        $cekLink = Validator::make($request->toArray(),
            [
            'lingkungan' => Rule::exists('umats', 'lingkungan_id')->where('nama', $nama)->where('lingkungan_id',$lingkungan) 
            ]
        );


        if (!$cekNik->fails()) {
            if($cekLink->fails()){
               return response()->json(['success'=>'lingkungan error']);
            }      
            $kk = Umat::select('kk')->where('nik', $nik)->first();
            $keluarga = DB::table('umats')->select('nama', 'nik', 'kk')->where('kk', strval($kk['kk']) )->get();

            return response()->json([
                'success'=>$keluarga
            ]);
        }

        if ($cekNik->fails()){
            return response()->json(['success'=>'tidak terdaftar']);
        }

        // return response()->json(['success'=>[$nama, $nik, $lingkungan]]);

    }


}
