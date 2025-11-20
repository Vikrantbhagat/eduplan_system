<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class CourseSubmitted extends Notification
{
    use Queueable;

    protected $course;

    public function __construct($course)
    {
        $this->course = $course;
    }

    public function via($notifiable)
    {
        return ['database']; // stored in DB, not email
    }

    public function toArray($notifiable)
    {
        return [
            'course_id' => $this->course->id,
            'title' => $this->course->title,
            'instructor' => $this->course->instructor->name,
        ];
    }
}
