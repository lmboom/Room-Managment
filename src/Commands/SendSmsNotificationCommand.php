<?php

namespace RoomManagment\Cli\Commands;

use RoomManagment\Cli\Interfaces\ISender;

class SendSmsNotificationCommand extends Command implements ICommand, ISender
{
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