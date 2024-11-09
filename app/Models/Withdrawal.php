<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Withdrawal extends Model
{
    use HasFactory;

    // Define the table name if it doesn't follow Laravel's plural convention
    protected $table = 'withdrawals';

    // Specify which attributes are mass-assignable
    protected $fillable = [
        'user_id',
        'amount',
        'status',
    ];

    // Define the possible statuses for a withdrawal request
    const STATUS_PENDING = 'pending';
    const STATUS_COMPLETED = 'completed';
    const STATUS_FAILED = 'failed';

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