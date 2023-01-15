<?php

namespace RoomManagment\Cli\Utils;

class Output
{
    public function __construct(private $message){}

    /**
     * @return mixed
     */
    public function getMessage(): mixed
    {
        return $this->message;
    }


}