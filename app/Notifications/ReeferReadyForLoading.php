<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class ReeferReadyForLoading extends Notification
{
    use Queueable;

    protected $reefer;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($reefer)
    {
        $this->reefer = $reefer;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'];
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
                    ->line("The reefer hasn't been unplugged in more than 2 hours before its estimated load time.")
                    ->action('View Reefer', url('/load/'.$this->reefer->id))
                    ->line('Please take the necessary actions.');
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
            'reefer_id' => $this->reefer->id,
            'message' => "The reefer hasn't been unplugged in more than 2 hours before its estimated load time.",
        ];
    }

    /**
     * Get the broadcast representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return BroadcastMessage
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'reefer_id' => $this->reefer->id,
            'message' => 'The reefer has been unplugged less than 2 hours before its estimated load time.',
        ]);
    }
}
