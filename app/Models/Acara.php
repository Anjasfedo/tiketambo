<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Acara extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'lokasi', 'deskripsi', 'tanggal', 'waktu', 'gambar', 'user_id', 'details'];

    protected $casts = [
        'details' => 'json',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tiket()
    {
        return $this->hasMany(Tiket::class);
    }

    public function getGambarUrlAttribute()
    {
        if ($this->gambar && Storage::exists('public/' . $this->gambar)) {
            return url('storage/' . $this->gambar);
        }

        return $this->gambar;
    }
}