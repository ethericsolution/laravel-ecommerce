<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AbandonedCartNotification extends Notification
{
    use Queueable;


    protected $user;
    /**
     * Create a new notification instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
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
        $url = route('account.cart');

        $message =  (new MailMessage)
            ->subject('New Item Added in Your Cart')
            ->greeting('Hello ' . $this->user->name)
            ->line('🛒 You’ve Got 1 Awesome Item(s) in Your Cart!')
            ->line('🛍️ Complete Your Order')
            ->action('Click Here for View Cart', $url)
            ->line('You left some fabulous ' . count($this->user->cart->items) . ' items in your cart !')
            ->line('Thank you for using our application!');

        return $message;
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
