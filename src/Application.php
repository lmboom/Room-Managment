<?php

namespace RoomManagment\Cli;

use RoomManagment\Cli\Commands\ICommand;

final class Application
{
    const EXIT_CODE = 0;
    /**
     * @param ICommand[] $commands
     */
    private $commands;
    private string $version = '0.0.1';
    private        $onExit;

    public function __construct(readonly string $name, callable $onExit = null)
    {
        $this->setOnExitHandler($onExit);
    }

    public function setOnExitHandler(callable $onExit = null): void
    {
        if (!is_null($onExit) && is_callable($onExit)) {
            $this->onExit = $onExit;
        } else {
            $this->onExit = static fn (int $exitCode = self::EXIT_CODE) => exit($exitCode);
        }
    }

    public function name(): string
    {
        return $this->name;
    }

    public function version(): string
    {
        return $this->version;
    }

    public function run()
    {

    }

    public function addCommand(ICommand $command): void
    {
        //save commands by them alias.
        $this->commands[$command->getAlias()] = $command;
    }

    public function handle(string $alias, array $input): Output
    {
        $command = $this->getCommandByAlias($alias);
        $output  = $command->handle();

        return new Output($output);
    }

    public function getCommandByAlias($alias): ICommand
    {
        return $this->commands[$alias];
    }

}