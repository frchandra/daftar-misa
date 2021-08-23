<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class HomeController extends Controller
{
    
    public function index(){
        return view('home',[
            'header'=>'hello world...'
        ]);
    }


    // Validator::make($data, [
    //     'email' => [
    //         'required',
    //         Rule::exists('staff')->where(function ($query) {
    //             return $query->where('account_id', 1);
    //         }),
    //     ],
    // ]);

    

    public function cekNik(Request $request){

        $nik = $request->input('nik');
        $nama = $request->input('nama');  
        $lingkungan = $request->input('lingkungan');

        


        // $validator = Validator::make($request->toArray(),
        //     [
        //     'nama' => Rule::exists('umats')->where('nama', $nama)->where('nik', $nik),
        //     'lingkungan' => Rule::exists('umats', 'lingkungan_id')->where('nama', $nama)->where('lingkungan_id',$lingkungan) 
        //     ],
        //     [
        //         'nama' => 'nama atau NIK anda belum terdaftar atau salah lingkungan',
        //         'lingkungan' => 'lingkungan tdk cocok'
        //     ]
        // );
        

        // if ($validator->fails()) {
        //     return redirect('/')->withErrors($validator);
        // }


        $cekNik = Validator::make($request->toArray(),
            [
            'nama' => Rule::exists('umats')->where('nama', $nama)->where('nik', $nik) 
            ]
        );

        $cekLink = Validator::make($request->toArray(),
            [
            'lingkungan' => Rule::exists('umats', 'lingkungan_id')->where('nama', $nama)->where('lingkungan_id',$lingkungan) 
            ]
        );

        // if ($cekNik->fails()&&$cekLink->fails()) {
        //     return redirect('/')->with('success', 'cekNik fail, ceklink fail');
        // }



        if (!$cekNik->fails()) {
            if($cekLink->fails()){
                return redirect('/')->with('success', 'terdaftar, nama nik bener, link typo');
            }
            return redirect('/')->with('success', 'terdaftar, nama nik bener, link bener');
        }

        if ($cekNik->fails()){
            return redirect('/')->with('success', 'tidak terdaftar, nik salah');
        }

        // if ($cekLink->fails()) {
        //     return redirect('/')->with('success', 'cekLink fail');
        // }
        
        

        // if ($validator->fails()) {
        //     return redirect('/')->withErrors($validator);
        // }

        

        
        // $validated = $request->validate([
        //     'nama' => 'exists:umats,nama',
        //     'nik' => 'exists:umats,nik'
        // ]);

        //return redirect('/')->with('success', 'validation success');
    }


}
