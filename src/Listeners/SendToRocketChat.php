<?php

namespace Novaday\Debugher\Listeners;

use GuzzleHttp\Client;
use Illuminate\Contracts\Queue\ShouldQueue;
use Novaday\Debugher\Events\LogPushed;
use Novaday\Debugher\Logger;

class SendToRocketChat implements ShouldQueue{

    public function handle(LogPushed $event)
    {
        try {
            $client = new Client(Logger::getHttpHeaders());
            $body['text'] = $event->message;
            $client->post( config()->get('debugher.end_point'),  ['form_params'=> $body]);
        } catch (HttpException $exception) {
            \Log::error($exception->getMessage());
        }
    }

}
