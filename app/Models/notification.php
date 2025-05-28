<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notification extends Model
{
    /** @use HasFactory<\Database\Factories\NotificationFactory> */
    use HasFactory;

    protected $fillable = [
        "notification_type",
        "sender_id",
        "receiver_id",
        "message",
        "json_data"
    ];

    protected $primaryKey = "id_notification";
}
