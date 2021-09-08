<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Misa extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'misa_id';
    protected $guarded = ['misa_id'];

    public function lingkunganMisas(){
        return $this->hasMany(LingkunganMisa::class, 'misa_id', 'misa_id');
    }
}
