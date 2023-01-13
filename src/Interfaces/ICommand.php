<?php

namespace RoomManagment\Cli\Commands;

interface ICommand
{
    public function handle(): bool;

    public function setParam(string $param);
}