<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lingkungan extends Model
{
    use HasFactory;

    protected $primaryKey = 'lingkungan_id';
    protected $guarded = ['lingkungan_id'];

    public function umats(){
        return $this->hasMany(Umat::class, 'lingkungan_id', 'lingkungan_id');
    }

    public function lingkunganMisas(){
        return $this->hasMany(LingkunganMisa::class, 'lingkungan_id', 'lingkungan_id');
    }
    

}
