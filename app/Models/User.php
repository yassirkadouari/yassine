<?php
// app/Models/User.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'birth_date',
        'gender',
        'phone',
        'emergency_contact'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'birth_date' => 'date',
    ];

    public function moodTrackings()
    {
        return $this->hasMany(MoodTracking::class);
    }

    public function journalEntries()
    {
        return $this->hasMany(JournalEntry::class);
    }

    public function wellnessGoals()
    {
        return $this->hasMany(WellnessGoal::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function reminders()
    {
        return $this->hasMany(Reminder::class);
    }
    
    public function todayMood()
    {
        return $this->hasOne(MoodTracking::class)->whereDate('date', today());
    }
}