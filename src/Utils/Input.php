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

        $query_string = implode('&', $argv);
        parse_str($query_string, $params);
        $this->params = $params;
    }

    public function getCommandParams(): array
    {
        //remove alias
        $params = $this->params;
        unset($params['alias']);

        return $params;
    }

    public function getAlias(): string
    {
        $params = $this->params;
        if (!isset($params['alias']) && !is_string($params['alias'])){
            throw new InvalidArgumentException('Alias is missed.');
        }

        return $params['alias'];
    }

    public function argumentsCount(): int
    {
        return count($this->params);
    }
}