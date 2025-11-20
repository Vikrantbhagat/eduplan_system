<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
        'role', // ✅ allow role to be mass assigned
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
        ];
    }

    /**
     * Relation: A user (instructor) can have many courses.
     */
    public function courses()
    {
        return $this->hasMany(Course::class, 'instructor_id');
    }


    // In User.php
public function cartItems()
{
    return $this->hasMany(Cart::class, 'student_id');
}


public function enrolledCourses()
{
    return $this->belongsToMany(Course::class, 'course_user', 'user_id', 'course_id')->withTimestamps();
}

    /**
     * Role checkers.
     * 
     * 
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }


    public function purchases() {
    return $this->hasMany(Purchase::class);
}


    public function isInstructor()
    {
        return $this->role === 'instructor';
    }

    public function isStudent()
    {
        return $this->role === 'student';
    }
}
