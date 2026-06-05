<?php

namespace App\Notifications;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewCommentNotification extends Notification
{
    use Queueable;

    protected $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => __('messages.notifications.new_comment', [
                'name' => $this->comment->user->name,
            ]),
            'comment_id' => $this->comment->id,
            'submission_id' => $this->comment->submission_id,
        ];
    }
}
