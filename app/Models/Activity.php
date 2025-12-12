<?php
// app/Models/Activity.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'activity_name',
        'type',
        'duration_minutes',
        'mood_before',
        'mood_after',
        'notes',
        'performed_at'
    ];

    protected $casts = [
        'performed_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}