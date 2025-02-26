<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Notifications\NewCalendarUploaded;
use App\Notifications\CalendarUploadedConfirmation;
use Illuminate\Support\Facades\Notification;
use App\Models\User;

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

        // Enviar notificación al usuario cuando se suba un nuevo calendario
        static::created(function ($calendar) {
            $uploadedBy = \Illuminate\Support\Facades\Auth::user();

            //sent notification to the user where role is user
            $users = User::where('role', 'user')->get();
            Notification::send($users, new NewCalendarUploaded($calendar->year, $uploadedBy));

            //sent notification to the user where role is admin
            $admin = User::where('role', 'admin')->first();
            Notification::send($admin, new CalendarUploadedConfirmation($calendar->year));

        });
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
