<?php

namespace RoomManagment\Cli\Commands;

use RoomManagment\Cli\Interfaces\ISender;

class SendSmsNotificationCommand implements ICommand, ISender
{
    private array $params = [];
    public function __construct(private readonly ISender $notificationSender){}

    public function handle(): bool
    {
        // TODO: Implement handle() method.
    }

    public function setParam(string $param)
    {
        //using value as key to avoid duplicating
        $this->params[$param] = $param;
    }

    public function send(): bool
    {
        $this->notificationSender->send();
    }
}