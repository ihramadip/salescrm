<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesTarget extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'month',
        'year',
        'target_amount',
    ];

    /**
     * Get the user that owns the sales target.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
