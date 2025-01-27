<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlobalNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'url',
        'read_by',
    ];

    // Dans GlobalNotification.php
public function read_by()
{
    return $this->belongsToMany(User::class, 'notification_user', 'notification_id', 'user_id')
                ->withPivot('read_at')
                ->withTimestamps();
}
}

