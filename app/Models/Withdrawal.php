<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Withdrawal extends Model
{
    use HasFactory;

    // Specify which attributes are mass-assignable
    protected $fillable = ['user_id', 'jumlah', 'status'];

    // Define the possible statuses for a withdrawal request
    const STATUS_PENDING = 'menunggu';
    const STATUS_COMPLETED = 'selesai';
    const STATUS_FAILED = 'gagal';

    // Relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Accessor for human-readable status
    public function getStatusLabelAttribute()
    {
        return ucfirst($this->status);
    }
}
