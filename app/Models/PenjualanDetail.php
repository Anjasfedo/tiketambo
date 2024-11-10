<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanDetail extends Model
{
    use HasFactory;

    protected $fillable = ['penjualan_id', 'user_ticket_id', 'is_resale'];

    // Relationship to Penjualan
    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class);
    }

    // Relationship to UserTicket
    public function userTicket()
    {
        return $this->belongsTo(UserTicket::class);
    }
}