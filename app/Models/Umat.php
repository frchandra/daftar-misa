<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umat extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'umat_id';
    protected $guarded = ['umat_id'];

    public function lingkungan(){
        return $this->belongsTo(Lingkungan::class, 'lingkungan_id', 'lingkungan_id');
    }

    public function umatLingkunganMisas(){
        return $this->hasMany(umatLingkunganMisa::class, 'umat_id', 'umat_id');
    }
}
