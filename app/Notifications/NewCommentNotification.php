<?php

namespace App\Notifications;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
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
        return ['database']; // уведомление сохраняется в БД
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Жаңа пікір ' . $this->comment->user->name,
            'comment_id' => $this->comment->id,
            'submission_id' => $this->comment->submission_id,
        ];
    }
}
