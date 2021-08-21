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


        $validator = Validator::make($request->toArray(),
            [
            'nama' => Rule::exists('umats')->where('nama', $nama)->where('nik', $nik),
            ],
            [
                'exists' => 'nama atau NIK anda belum terdaftar',
            ]
        );
        

        if ($validator->fails()) {
            return redirect('/')->withErrors($validator);
        }

        

        
        // $validated = $request->validate([
        //     'nama' => 'exists:umats,nama',
        //     'nik' => 'exists:umats,nik'
        // ]);

        return redirect('/')->with('success', 'validation success');
    }


}
