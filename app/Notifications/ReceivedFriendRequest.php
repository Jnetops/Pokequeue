<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Auth;

class ReceivedFriendRequest extends Notification
{
    use Queueable;

    protected $addFriend;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($addFriend)
    {
        $this->addFriend = $addFriend;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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

        $friendArray = [
            'friend' => ['user' => Auth::user()->trainer_name,
                          'statement' => ' Has requested to be friends',
                          'request_id' => $this->addFriend->id
                        ]
        ];
        return $friendArray;
    }
}
