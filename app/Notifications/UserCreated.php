<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserCreated extends Notification
{
    use Queueable;

    private string $password;
    private string $name;

    /**
     * Create a new notification instance.
     *
     * This constructor initializes the UserCreated notification with the
     * user's name and generated password.
     *
     * @param string $name The name of the user.
     * @param string $password The generated password for the user.
     */
    public function __construct(string $name, string $password)
    {
        // Assign the generated password to the private property
        $this->password = $password;

        // Assign the user's name to the private property
        $this->name = $name;
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
                    ->line('Dear ' . $this->name)
                    ->line('We have generated a new password for your account. Please find the details below:')
                    ->line('New Password: ' . $this->password)
                    ->line('Important: For security reasons, we recommend that you change this password as soon as possible. You can do this by logging in to your account and going to the "Profile" section.')
                    ->line('Thank you for using our application!');
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
