<?php

namespace Novaday\Debugher\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LogPushed
{
    use Dispatchable,  SerializesModels;

    public $message;

    public function __construct($message)
    {
        $this->message = $message;
    }
}
