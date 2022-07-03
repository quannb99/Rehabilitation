<?php

namespace App\Notifications;

use App\Models\Appointment;
use App\Models\Progress;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UpdateRecord extends Notification
{
    use Queueable;

    protected $user;
    protected $progress;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Progress $progress)
    {
        $this->progress = $progress;
        $this->user = $user;
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
            'user_name' => $this->user->name,
            'avatar' => $this->user->avatar,
            'created_at' => $this->progress->created_at,
            'record_id' => $this->progress->record_id,
        ];
    }
}
