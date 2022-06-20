<?php

namespace App\Notifications;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ReportComment extends Notification
{
    use Queueable;

    protected $comment;
    protected $user;
    protected $commentUser;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Comment $comment, User $user, User $commentUser)
    {
        $this->comment = $comment;
        $this->user = $user;
        $this->commentUser = $commentUser;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // return ['mail'];
        return ['database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'post_id' => $this->comment->post_id,
            'comment_id' => $this->comment->id,
            'content' => $this->comment->content,
            'user_id' => $this->comment->user_id,
            'comment_user_name' => $this->commentUser->name,
            'comment_user_avatar' => $this->commentUser->avatar,
            'user_name' => $this->user->name,
            'avatar' => $this->user->avatar,
        ];
    }
}
