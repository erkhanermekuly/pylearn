<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class SubmissionFeedbackNotification extends Notification
{
    use Queueable;

    protected $submission;

    public function __construct($submission)
    {
        $this->submission = $submission;
    }

    public function via($notifiable)
    {
        return ['database'];  // Можно добавить email и другие каналы, если надо
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "Жауап және баға келді: «{$this->submission->assignment->title}» тапсырмасына.",
            'submission_id' => $this->submission->id,
            'lesson_id' => $this->submission->assignment->lesson_id,  // берем id урока через связь

        ];
    }
}
