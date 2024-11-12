<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    use HasFactory;

    protected $fillable = ['acara_id', 'nama', 'harga', 'stok'];

    public function acara()
    {
        return $this->belongsTo(Acara::class);
    }

    public function penjualans()
    {
        return $this->hasMany(Penjualan::class);
    }

    // Relationship with UserTiket (a ticket can be owned by multiple users over time)
    public function userTikets()
    {
        return $this->hasMany(UserTiket::class);
    }
}