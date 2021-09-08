<?php

namespace App\Http\Controllers;

// use App\Models\Umat;
use App\Models\UmatLingkunganMisa;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{

    private function getPresentMisas(){ //query
        $misas = DB::table('lingkungan_misas')
                ->join('misas', 'lingkungan_misas.misa_id', '=', 'misas.misa_id')
                ->join('lingkungans' ,'lingkungan_misas.lingkungan_id', '=', 'lingkungans.lingkungan_id')
                ->select('lingkungan_misas.lingkungan_misa_id', 'misas.misa_id', 'misas.perayaan', 'misas.tanggal', 'misas.jam', 'lingkungans.lingkungan_id', 'lingkungans.nama', 'lingkungan_misas.kuota', 'lingkungan_misas.terdaftar')
                ->orderBy('misas.tanggal', 'asc')
                ->orderBy('misas.jam', 'asc')
                ->get();
        return $misas;
    }

    private function getFilteredMisas($lingkungan_id){ //helper, filter
        $misas = $this->getPresentMisas()->groupBy('misa_id');

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

    public function checkUlm($umatId, $lingkunganMisaId){ //query
        return DB::table('umat_lingkungan_misas')
                ->select('umat_id', 'lingkungan_misa_id')
                ->where('umat_id', '=', $umatId)
                ->where('lingkungan_misa_id', '=', $lingkunganMisaId)
                ->get();
    }

    public function getUlm($umatId){ //query
        return DB::table('umat_lingkungan_misas')
                    ->join('umats', 'umat_lingkungan_misas.umat_id', '=', 'umats.umat_id')
                    ->join('lingkungan_misas', 'umat_lingkungan_misas.lingkungan_misa_id', '=', 'lingkungan_misas.lingkungan_misa_id')
                    ->join('lingkungans', 'lingkungan_misas.lingkungan_id', '=', 'lingkungans.lingkungan_id')
                    ->join('misas', 'lingkungan_misas.misa_id', '=', 'misas.misa_id')
                    ->select('umats.nama', 'lingkungans.nama AS namaLingkungan', 'misas.perayaan', 'misas.tanggal', 'misas.jam', 'umats.umat_id')
                    ->where('umats.umat_id', $umatId)
                    ->get();
    }

    private function getKk($nik){ //query
        // return Umat::select('kk')->where('nik', $nik)->first();
        return DB::table('umats')->select('kk')->where('nik', $nik)->first();
    }

    private function getUmats($kk){ //query
        return DB::table('umats')
        ->join('lingkungans', 'umats.lingkungan_id', '=', 'lingkungans.lingkungan_id')
        ->select('umats.umat_id', 'umats.nama', 'umats.nik', 'umats.kk', 'lingkungans.nama AS namaLingkungan', 'lingkungans.lingkungan_id')->where('kk', strval($kk['kk']) )->get();
    }

    public function index(){ //getpresentmisas   
        $misas = $this->getPresentMisas();
        return view('home',[
            'misas'=>$misas
        ]);
    }

    public function validatePendaftaran(Request $request){ //logic, validation
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
               return response()->json(['sukses'=>'lingkungan error']);
            }      
            $kk = $this->getKk($nik);
            $keluarga = $this->getUmats($kk);
            $misas = $this->getFilteredMisas($lingkungan);            
            return response()->json([
                'content'=>view('modal.pendaftaran-lama')->render(),
                'sukses'=>'berhasil',
                'success'=>$keluarga,
                'misa'=>$misas
            ]);
        }

        if ($cekNik->fails()){
            $misas = $this->getFilteredMisas(2);
            return response()->json([
                'content'=>view('modal.pendaftaran-baru')->render(),
                'misa'=>$misas
            ]);
        }
    }

    public function storePendaftaran(Request $request){ //logic, query
        $umatIds = $request->input('umats');
        $lingkunganMisaId = $request->input('lingkungan_misa_id');  

        $store = collect();
        

        //logic
        foreach($umatIds as $umatId){            
            if($this->checkUlm($umatId, $lingkunganMisaId)->isEmpty()){
                $store->push(['umat_id'=>$umatId, 'lingkungan_misa_id'=>$lingkunganMisaId]);
            }
            else{
                $array = json_decode(json_encode($this->getUlm($umatId)), true);
                return view('response',[
                    'response'=>'gagal',
                    'data'=>$array
                ]);            
            }  
        }
        //transaksi query
        DB::transaction(function () use ($umatIds, $lingkunganMisaId){
            foreach($umatIds as $umatId){
                UmatLingkunganMisa::create([
                    'umat_id'=>$umatId,
                    'lingkungan_misa_id'=>$lingkunganMisaId
                ]);
                DB::table('lingkungan_misas')
                ->where('lingkungan_misa_id', $lingkunganMisaId)
                ->update(['kuota' => DB::raw('kuota-1'), 'terdaftar' => DB::raw('terdaftar+1')]);
            } 
        });



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

        if($this->checkDuplicate($nama, $nik, $kk)->isEmpty()){
            $id = DB::table('umats')->insertGetId([
                'lingkungan_id' => '2',
                'nama' => $nama,
                'nama_babtis' => $namaBabtis,
                'nik' => $nik,
                'kk'=>$kk,
                'tanggal_lahir' => $tgl,
                'jenis_kelamin' => $kl,
                'vaksin' => $vaksin,
                'hp'=> $hp
            ]);

            //transaksi
            DB::transaction(function () use ($id, $lmId){
                UmatLingkunganMisa::create([
                    'umat_id'=>$id,
                    'lingkungan_misa_id'=>$lmId
                ]);
                DB::table('lingkungan_misas')
                ->where('lingkungan_misa_id', $lmId)
                ->update(['kuota' => DB::raw('kuota-1'), 'terdaftar' => DB::raw('terdaftar+1')]); 
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

    public function checkDuplicate($nama, $nik, $kk){ //query
        return DB::table('umats')
                    ->where('nama', $nama)
                    ->where('nik', $nik)
                    ->where('kk', $kk)
                    ->get();
    }

}
