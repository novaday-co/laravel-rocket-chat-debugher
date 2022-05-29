<?php

namespace Novaday\Debugher;

use Novaday\Debugher\Events\LogPushed;


class Logger{

    private $username, $fileName, $line, $traceString, $message, $name, $ip;
    public $channel, $content;

    public static function getHttpHeaders(){
        return   [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ];
    }

    // auth()->user
    public function fromUser($user)
    {
        $this->username = optional($user)->username;
        $this->name = optional($user)->name;

        return $this;
    }

    public function withIp($userIp)
    {
        $this->ip = $userIp;

        return $this;
    }

    public function withException($exception)
    {
        $this->fileName = optional($exception)->getFile();
        $this->line = optional($exception)->getLine();
        $this->message = optional($exception)->getMessage();
        $this->traceString = optional($exception)->getTraceAsString();

        return $this;
    }

    public function send(){
        event(new LogPushed($this->getMessage()));
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
