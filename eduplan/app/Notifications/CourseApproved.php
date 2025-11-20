<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Course;

class CourseApproved extends Notification
{
    use Queueable;

    protected $course;

    /**
     * Create a new notification instance.
     *
     * @param \App\Models\Course $course
     */
    public function __construct(Course $course)
    {
        $this->course = $course;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail']; // You can add 'database' if you want to store notifications in DB
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Your course has been approved!')
                    ->line('Your course "' . $this->course->title . '" has been approved and published.')
                    ->line('You can now view it on the platform.');
    }

    /**
     * Get the array representation of the notification (for database notifications).
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'course_id' => $this->course->id,
            'title' => $this->course->title,
            'status' => 'approved',
        ];
    }
}
