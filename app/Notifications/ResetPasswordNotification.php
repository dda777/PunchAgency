<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    private string $resetPasswordUrl;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $resetPasswordUrl)
    {
        $this->resetPasswordUrl = $resetPasswordUrl;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('Для відновлення пароля перейдіть за посиланням:')
                    ->action('Відновити пароль', $this->resetPasswordUrl)
                    ->line('Якщо ви не надсилали запит на відновлення пароля, проігноруйте це повідомлення.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
