<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UmatLingkunganMisa extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'umat_lingkungan_misa_id';
    protected $guarded = ['umat_lingkungan_misa_id'];

    public function umat(){
        return $this->belongsTo(Umat::class, 'umat_id', 'umat_id');
    }

    public function lingkunganMisa(){
        return $this->belongsTo(LingkunganMisa::class, 'lingkungan_misa_id', 'lingkungan_misa_id');
    }
}
