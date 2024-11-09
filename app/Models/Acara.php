<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acara extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'lokasi', 'deskripsi', 'tanggal', 'jam', 'gambar', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tiket()
    {
        return $this->hasMany(Tiket::class);
    }
}