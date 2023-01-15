<?php

namespace RoomManagment\Cli\Utils;

use RoomManagment\Cli\Exceptions\InvalidArgumentException;

readonly class Input
{
    private array $params;

    public function __construct(public array $argv)
    {
        //remove filename;
        unset($argv[0]);

        $this->params = $argv;
    }

    public function getCommandParams(): array
    {
        //remove alias
        $params = $this->params;
        unset($params[1]);

        return $params;
    }

    public function getAlias(): string
    {
        $params = $this->params;
        if (!isset($params[1]) && !is_string($params[1])){
            throw new InvalidArgumentException('Alias is missed.');
        }

        return $params[1];
    }

    public function argumentsCount(): int
    {
        return count($this->params);
    }
}