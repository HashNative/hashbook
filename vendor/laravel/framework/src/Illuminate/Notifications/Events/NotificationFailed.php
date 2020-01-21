<?php

namespace Illuminate\Notifications\Events;

use Illuminate\Notifications\Notification;

class NotificationFailed
{
    /**
     * The notifiable entity who received the notification.
     *
     * @var mixed
     */
    public $notifiable;

    /**
     * The notification instance.
     *
     * @var Notification
     */
    public $notification;

    /**
     * The channel name.
     *
     * @var string
     */
    public $channel;

    /**
     * The data needed to process this failure.
     *
     * @var array
     */
    public $data = [];

    /**
     * Create a new event instance.
     *
     * @param  mixed  $notifiable
     * @param  Notification  $notification
     * @param  string  $channel
     * @param  array  $data
     * @return void
     */
    public function __construct($notifiable, $notification, $channel, $data = [])
    {
        $this->data = $data;
        $this->channel = $channel;
        $this->notifiable = $notifiable;
        $this->notification = $notification;
    }
}
