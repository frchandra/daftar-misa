<?php

namespace App\Repositories;

use App\Models\LingkunganMisa;
use Illuminate\Support\Facades\DB;

class LingkunganMisaRepository
{
    protected $LingkunganMisa;

    public function __construct(LingkunganMisa $LingkunganMisa){
        $this->LingkunganMisa = $LingkunganMisa;
    }

    public function getPresentMisas(){ //query
        $misas = LingkunganMisa::join('misas', 'lingkungan_misas.misa_id', '=', 'misas.misa_id')
                ->join('lingkungans' ,'lingkungan_misas.lingkungan_id', '=', 'lingkungans.lingkungan_id')
                ->select('lingkungan_misas.lingkungan_misa_id', 'misas.misa_id', 'misas.perayaan', 'misas.tanggal', 'misas.jam', 'lingkungans.lingkungan_id', 'lingkungans.nama', 'lingkungan_misas.kuota', 'lingkungan_misas.terdaftar')
                ->orderBy('misas.tanggal', 'asc')
                ->orderBy('misas.jam', 'asc')
                ->get();
        return $misas;
    }

    public function addUmat($lmId){
        $affected = LingkunganMisa::where('lingkungan_misa_id', $lmId)->where('kuota', '!=', 0)
        ->update(['kuota' => DB::raw('kuota-1'), 'terdaftar' => DB::raw('terdaftar+1')]); 
        return $affected;
    }

    public function deleteUmat($lmId){
        LingkunganMisa::where('lingkungan_misa_id', $lmId)
        ->update(['kuota' => DB::raw('kuota+1'), 'terdaftar' => DB::raw('terdaftar-1')]); 
    }





}