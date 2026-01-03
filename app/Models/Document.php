<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'file_name',
        'file_path',
        'related_type',
        'related_id',
        'uploaded_by',
        'version',
    ];

    /**
     * Get the user who uploaded the document.
     */
    public function uploadedBy()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    /**
     * Get the parent model that the document belongs to.
     */
    public function related()
    {
        return $this->morphTo();
    }
}
