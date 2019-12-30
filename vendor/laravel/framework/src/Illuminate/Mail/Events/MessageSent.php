<?php

namespace Illuminate\Mail\Events;

use Swift_Message;

class MessageSent
{
    /**
     * The Swift message instance.
     *
     * @var Swift_Message
     */
    public $message;

    /**
     * Create a new event instance.
     *
     * @param  Swift_Message  $message
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;
    }
}
