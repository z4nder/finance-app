<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'icon',
        'color',
        'created_by'
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
