<?php

namespace RoomManagment\Cli;

use Exception;
use RoomManagment\Utils\Input;
use RoomManagment\Utils\Output;
use RoomManagment\Cli\Interfaces\ICommand;

final class Application
{
    const EXIT_CODE = 0;
    /**
     * @param ICommand[] $commands
     */
    private        $commands;
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

    public function addCommand(ICommand $command): void
    {
        //save commands by them alias.
        $this->commands[$command->getAlias()] = $command;
    }

    public function handle(Input $input): Output
    {
        if ($input->argumentsCount() < 2) {
            throw new Exception('Not enough arguments');
        }
        $command = $this->getCommandByAlias($input[1]);
        $output  = $command->handle($input->getParams());

        return new Output($output);
    }

    public function getCommandByAlias($alias): ICommand
    {
        if (!key_exists($alias, $this->commands)) {
            throw new Exception('Command not found');
        }
        return $this->commands[$alias];
    }

    public function showHelp()
    {

    }
}