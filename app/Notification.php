<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'from',
        'to',
        'message',
    ];

    /**
     * Get the sent records for the notification.
     */
    public function sentRecords()
    {
        return $this->hasMany(NotificationSent::class);
    }
}
