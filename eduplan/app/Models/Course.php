<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

   protected $fillable = [
        'user_id','instructor_id','title','description','fees','image','video','video_description','status','published_at'
    ];



public function purchases() {
    return $this->hasMany(Purchase::class);
}

// public function instructor() {
//     return $this->belongsTo(User::class, 'instructor_id'); // assuming courses table has instructor_id
// }



public function reviews()
{
    return $this->hasMany(\App\Models\CourseReview::class);
}


 public function lectures()
{
    return $this->hasMany(Lecture::class);
}


    protected $casts = [
        'fees' => 'float', // ✅ Automatically cast to float
    ];

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }
// app/Models/Course.php

public function scopeApproved($query)
{
    return $query->where('status', 'approved');
}


public function scopeVisibleTo($query, $user)
{
    if ($user->role === 'instructor') {
        // Instructor can see their own courses, including rejected
        return $query->where('instructor_id', $user->id);
    }

    // Others see only approved
    return $query->where('status', 'approved');
}

// Course.php
public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

public function videos()
{
    return $this->hasMany(Video::class);
}


public function feedbacks()
{
    return $this->hasMany(Feedback::class);
}


}
