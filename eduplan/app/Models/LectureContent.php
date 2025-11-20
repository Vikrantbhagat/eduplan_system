<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LectureContent extends Model
{
    protected $fillable = ['lecture_id', 'title', 'type', 'url', 'duration'];


public function lecture()
{
    return $this->belongsTo(Lecture::class);
}

}

