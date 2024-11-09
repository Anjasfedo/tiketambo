<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Tiket;

class UserTicket extends Model
{
    use HasFactory;

    // Define the table name if it doesn't follow Laravel's plural convention
    protected $table = 'user_tickets';

    // Specify which attributes are mass-assignable
    protected $fillable = [
        'user_id',
        'tiket_id',
        'status',
        'price',
    ];

    // Define the possible statuses for a user ticket
    const STATUS_ACTIVE = 'active';
    const STATUS_FOR_SALE = 'for_sale';
    const STATUS_SOLD = 'sold';

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

    // Accessor for human-readable status
    public function getStatusLabelAttribute()
    {
        return ucfirst(str_replace('_', ' ', $this->status));
    }
}