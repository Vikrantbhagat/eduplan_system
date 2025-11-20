<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id', // important!
        'title',
        'description',
        'duration',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

public function contents()
{
    return $this->hasMany(LectureContent::class);
}

}
