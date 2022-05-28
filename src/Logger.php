<?php

namespace Novaday\Debugher;

use GuzzleHttp\Client;


class Logger{

    public $username, $channel, $content, $fileName, $line, $traceString, $message, $name, $ip;

    private static function getHttpHeaders(){
        return   [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ];
    }

    public function fromUser($user)
    {
        $this->username = optional($user)->username;
        $this->name = optional($user)->name;

        return $this;
    }

    public function fromIp($userIp)
    {
        $this->ip = $userIp;

        return $this;
    }

    public function to($channel)
    {
        $this->channel = $channel;

        return $this;
    }

    public function sawInFile($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function inLine($line)
    {
        $this->line = $line;

        return $this;
    }

    public function message($message)
    {
        $this->message = $message;

        return $this;
    }

    public function trace($traceString)
    {
        $this->traceString = $traceString;

        return $this;
    }

    public function send(){
        $client = new Client(self::getHttpHeaders());
        $body['text'] = $this->getMessage();
        $client->post( config()->get('debugher.end_point'),  ['form_params'=> $body]);
    }

    private function getMessage(){
        $this->content = '**AppName : ' . config()->get('app.name') . ' / User : ' . ($this->name ?? $this->ip) . ' , ' . $this->username . ' / Time : '.now()->format('Y-m-d H:i:s').'**';
        $this->content .= '```';
        $this->content .= 'File : '.$this->fileName . ' , Line : ' . $this->line .' ';
        $this->content .= 'Message : '.$this->message;
        $this->content .= $this->traceString;
        $this->content .= '```';
        return $this->content;
    }

}
