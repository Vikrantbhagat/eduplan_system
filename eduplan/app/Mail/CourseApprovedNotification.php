<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Course;

class CourseApprovedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $course;

    public function __construct(Course $course)
    {
        $this->course = $course;
    }

    public function build()
    {
        return $this->subject('Your course is approved: ' . $this->course->title)
                    ->markdown('emails.course_approved')
                    ->with(['course' => $this->course]);
    }
}
