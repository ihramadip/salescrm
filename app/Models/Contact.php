<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
