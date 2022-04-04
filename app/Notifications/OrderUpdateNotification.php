<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Carbon\Carbon;
use App\Models\Order;
use Auth;
class OrderUpdateNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        //
        $this->order = $order;
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
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    /**
     * Get the toDatabase representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return toDatabase
     */
    public function toDatabase($notifiable)
    {
        return [
            'data'=>[
                'order_id' => $this->order->id,
                'status'=>$this->order->status,
                'updated_by' => Auth::id(),
            ],
        ];
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}


// {"data":{"id":1,"order_number":"ORD-6246e21e853cd","user_id":1,"status":"processing","grand_total":20,"item_count":2,"is_paid":0,"payment_method":"cash_on_delivery","notes":null,"created_at":"2022-04-01T11:29:34.000000Z","updated_at":"2022-04-04T07:21:55.000000Z"},"updated_by":24}