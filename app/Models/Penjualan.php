<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $fillable = ['nomor_pesanan', 'tiket_id', 'status', 'tanggal_pemesanan', 'user_id', 'seller_id', 'is_resale'];

    public function tiket()
    {
        return $this->belongsTo(Tiket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function pembayaran()
    // {
    //     return $this->hasOne(Pembayaran::class);
    // }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'penjualan_id')->withDefault();
    }

    // Relationship with User (Buyer)
    public function buyer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship with User (Seller)
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

}