<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Submission;

class NewSubmissionNotification extends Notification
{
    use Queueable;

    protected $submission;

    public function __construct(Submission $submission)
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
            'submission_id' => $this->submission->id,
            'message' => __('messages.notifications.new_submission', [
                'title' => $this->submission->assignment->translate('title'),
                'name' => $this->submission->user->name,
            ]),
        ];
    }
}
