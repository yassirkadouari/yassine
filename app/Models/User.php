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
        'phone',
        'emergency_contact',
        'role',
        'is_approved',
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

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function isAdmin() { return $this->role === 'admin'; }
    public function isDoctor() { return $this->role === 'doctor'; }
    public function isStudent() { return $this->role === 'student'; }
}