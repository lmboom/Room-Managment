<?php

namespace RoomManagment\Cli\Commands;

class Command
{
    private array $params = [];

    public function __construct(readonly protected string $alias)
    {
    }

    public function getAlias(): string
    {
        return $this->alias;
    }
}