<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DataHarian;
use App\Models\Komoditas;

class Pasar extends Model
{
    protected $fillable = [
        'daerah',
        'nama_pasar'
    ];

    public function dataHarians()
    {
        return $this->hasMany(DataHarian::class);  
    }

    public function komoditas()
    {
        return $this->belongsToMany(Komoditas::class,'komoditas_pasar');
    }
}
