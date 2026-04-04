<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'age',
        'phone',
        'address',
        'specialization',
        'working_hours',
        'children_count',
        'relationship_to_child',
        'registration_date',
        'guardian_id',
        'gender',
        'birth_date',
        'level_name',
        'classroom_name',
        'allergies',
        'chronic_diseases',
        'medications',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'age' => 'integer',
            'children_count' => 'integer',
            'registration_date' => 'date',
            'birth_date' => 'date',
        ];
    }

    public function guardian(): BelongsTo
    {
        return $this->belongsTo(User::class, 'guardian_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(User::class, 'guardian_id');
    }

    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class);
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    public function behavioralNotes(): HasMany
    {
        return $this->hasMany(BehavioralNote::class);
    }

    public function levels(): HasMany
    {
        return $this->hasMany(Level::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'guardian_id');
    }

    public function teacherReports(): HasMany
    {
        return $this->hasMany(TeacherReport::class, 'teacher_id');
    }

    public function dashboardRoute(): string
    {
        return match ($this->role) {
            'admin' => 'admin.admindashboard',
            'teacher' => 'teacher.teacherdashboard',
            'guardian' => 'parent.parentdashboard',
            'child' => 'child.home',
            'doctor', 'specialist' => 'dashboard',
            default => 'dashboard',
        };
    }
}
