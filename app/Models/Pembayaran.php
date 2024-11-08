<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = ['penjualan_tiket_id', 'metode_pembayaran', 'jumlah_tiket', 'jumlah_bayar', 'tanggal_pembayaran'];

    public function penjualanTiket()
    {
        return $this->belongsTo(PenjualanTiket::class);
    }
}