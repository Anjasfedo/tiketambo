<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Tiket;

class UserTiket extends Model
{
    use HasFactory;

    // Define the table name if it doesn't follow Laravel's plural convention
    protected $table = 'user_tikets';

    // Specify which attributes are mass-assignable
    protected $fillable = [
        'user_id',
        'tiket_id',
        'status',
        'harga_jual',
    ];

    // Define the possible statuses for a user ticket
    const STATUS_ACTIVE = 'aktif';
    const STATUS_FOR_SALE = 'dijual';
    const STATUS_SOLD = 'terjual';

    const STATUS_EXPIRED = 'kedaluwarsa';

    // Relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with the Tiket model
    public function tiket()
    {
        return $this->belongsTo(Tiket::class, 'tiket_id');
    }

    public function penjualanDetails()
    {
        return $this->hasMany(PenjualanDetail::class);
    }

    // Accessor for human-readable status
    public function getStatusLabelAttribute()
    {
        return ucfirst(str_replace('_', ' ', $this->status));
    }
}