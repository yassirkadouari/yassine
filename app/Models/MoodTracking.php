<?php
// app/Models/MoodTracking.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoodTracking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mood',
        'energy_level',
        'stress_level',
        'sleep_quality',
        'notes',
        'date'
    ];

    protected $casts = [
        'date' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}