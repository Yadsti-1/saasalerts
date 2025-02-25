<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Calendar extends Model
{
    protected $fillable = ['year', 'file_path', 'user_id', 'uploaded_at'];

    protected static function boot()
    {
        parent::boot();

        // Asignar automáticamente el usuario autenticado antes de crear el registro
        static::creating(function ($calendar) {
            $calendar->user_id = \Illuminate\Support\Facades\Auth::check() ? \Illuminate\Support\Facades\Auth::user()->id : null;
            $calendar->uploaded_at = now();
        });
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
