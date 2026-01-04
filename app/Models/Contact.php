<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Contact extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_id',
        'lead_id',
        'name',
        'email',
        'phone',
    ];

    /**
     * Get the company that the contact belongs to.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get all of the contact's activities.
     */
    public function activities(): MorphMany
    {
        return $this->morphMany(Activity::class, 'subject');
    }
}
