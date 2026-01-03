<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'deal_id',
        'amount',
        'revenue_date',
    ];

    /**
     * Get the deal that owns the revenue.
     */
    public function deal()
    {
        return $this->belongsTo(Deal::class);
    }
}
