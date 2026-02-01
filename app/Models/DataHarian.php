<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Komoditas;
use App\Models\User;
use App\Models\Pasar;

class DataHarian extends Model
{
    protected $fillable = [
        'harga_pasar',
        'harga_petani',
        'ketersediaan_harian',
        'kebutuhan_harian',
        'neraca_harian',
        'komoditas_id',
        'pasar_id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function komoditas()
    {
        return $this->belongsTo(Komoditas::class);
    }

    public function pasar()
    {
        return $this->belongsTo(Pasar::class);
    }
}
