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
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => __('messages.notifications.feedback_received', [
                'title' => $this->submission->assignment->translate('title'),
            ]),
            'submission_id' => $this->submission->id,
            'lesson_id' => $this->submission->assignment->lesson_id,
        ];
    }
}
