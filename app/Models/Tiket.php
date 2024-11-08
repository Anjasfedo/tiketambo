<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    use HasFactory;

    protected $fillable = ['acara_id', 'nama', 'harga_tiket', 'stok_tiket'];

    public function acara()
    {
        return $this->belongsTo(Acara::class);
    }

    public function penjualanTiket()
    {
        return $this->hasMany(PenjualanTiket::class);
    }
}