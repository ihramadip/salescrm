<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Deal extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_id',
        'contact_id',
        'title',
        'value',
        'stage',
        'probability',
        'expected_close_date',
        'assigned_to',
    ];

    /**
     * Get the company associated with the deal.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the contact associated with the deal.
     */
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    /**
     * Get the user assigned to the deal.
     */
    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Get all of the deal's activities.
     */
    public function activities(): MorphMany
    {
        return $this->morphMany(Activity::class, 'subject');
    }
}
