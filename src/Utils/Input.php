<?php

namespace RoomManagment\Cli\Utils;

readonly class Input
{
    private array $params;

    public function __construct(public array $argv)
    {
        //remove filename;
        unset($argv[0]);

        $this->params = $argv;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function argumentsCount(): int
    {
        return count($this->params);
    }
}