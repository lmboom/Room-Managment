<?php

namespace RoomManagment\Cli\Commands;

interface ICommand
{
    public function handle(): mixed;

    public function setParam(string $param);

    public function getAlias();
}