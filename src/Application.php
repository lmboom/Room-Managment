<?php

namespace RoomManagment\Cli;

use RoomManagment\Cli\Utils\Input;
use RoomManagment\Cli\Utils\Output;
use RoomManagment\Cli\Interfaces\ICommand;
use RoomManagment\Cli\Exceptions\InvalidArgumentException;

final class Application
{
    const EXIT_CODE = 0;
    /**
     * @param ICommand[] $commands
     */
    private array  $commands;
    private string $version = '1.0.0';
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

    /**
     * @throws \RoomManagment\Cli\Exceptions\InvalidArgumentException
     */
    public function handle(Input $input): Output
    {
        $command = $this->getCommandByAlias($input[1]);
        $output  = $command->handle($input->getParams());

        return new Output($output);
    }

    public function getCommandByAlias($alias): ICommand
    {
        if (!key_exists($alias, $this->commands)) {
            throw new InvalidArgumentException('Command with specified alias not found not found');
        }
        return $this->commands[$alias];
    }

    public function showHelpWithMessage(): void
    {

    }
}