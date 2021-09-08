<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LingkunganMisa extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'lingkungan_misa_id';
    protected $guarded = ['lingkungan_misa_id'];

    public function lingkungan(){
        return $this->belongsTo(Lingkungan::class, 'lingkungan_id', 'lingkungan_id');
    }

    public function misa(){
        return $this->belongsTo(Misa::class, 'misa_id', 'misa_id');
    }

    public function umatLingkunganMisas(){
        return $this->hasMany(UmatLingkunganMisa::class, 'lingkungan_misa_id', 'lingkungan_misa_id');
    }


}
