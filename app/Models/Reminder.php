<?php
// app/Models/Reminder.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'type',
        'reminder_time',
        'days_of_week',
        'is_active'
    ];

    protected $casts = [
        'days_of_week' => 'array',
        'is_active' => 'boolean',
        'last_triggered' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}