<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Course;

class NewCourseNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $course;

    public function __construct(Course $course)
    {
        $this->course = $course;
    }

    public function build()
    {
        return $this->subject('New course submitted: ' . $this->course->title)
                    ->markdown('emails.new_course')
                    ->with(['course' => $this->course]);
    }
}
