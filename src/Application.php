<?php

namespace RoomManagment\Cli;

final class Application
{
    const EXIT_CODE = 0;

    private string $version = '0.0.1';
    private        $onExit;

    public function __construct(readonly string $name, callable $onExit = null)
    {
        $this->setOnExitHandler($onExit);
    }

    public function name(): string
    {
        return $this->name;
    }

    public function version(): string
    {
        return $this->version;
    }

    public function setOnExitHandler(callable $onExit = null): void
    {
        if (!is_null($onExit) && is_callable($onExit)) {
            $this->onExit = $onExit;
        } else {
            $this->onExit = static fn (int $exitCode = self::EXIT_CODE) => exit($exitCode);
        }
    }

    public function run()
    {

    }

}