<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = ['penjualan_id', 'metode_pembayaran', 'jumlah_tiket', 'jumlah_bayar', 'tanggal_pembayaran'];

    const METODE_CREDIT_CARD = 'credit_card';
    const METODE_BANK_TRANSFER = 'bank_transfer';

    const PAYMENT_METHODS = [
        self::METODE_CREDIT_CARD,
        self::METODE_BANK_TRANSFER
    ];

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class);
    }
}