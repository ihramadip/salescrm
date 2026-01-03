<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'due_date',
        'priority',
        'status',
        'assigned_to',
        'related_type',
        'related_id',
    ];

    /**
     * Get the user that is assigned to the task.
     */
    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Get the parent model that the task belongs to.
     */
    public function related()
    {
        return $this->morphTo();
    }
}
