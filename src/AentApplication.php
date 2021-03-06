<?php


namespace TheAentMachine;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Exception\CommandNotFoundException;
use TheAentMachine\Command\VoidCommand;
use TheAentMachine\Command\ReplyCommand;
use TheAentMachine\Helper\ReplyAggregator;

/**
 * aents should start a AentApplication instead of a default Symfony console "Application"
 */
final class AentApplication extends Application
{
    private $voidCommand;

    public function __construct()
    {
        parent::__construct();
        $this->voidCommand = new VoidCommand();
        $this->add($this->voidCommand);
        $this->add(new ReplyCommand(new ReplyAggregator()));
    }

    /**
     * Overrides the Symfony "find" method to return a default command if no command is found.
     */
    public function find($name)
    {
        try {
            if (!$this->has($name)) {
                return $this->voidCommand;
            }
            return parent::find($name);
        } catch (CommandNotFoundException $e) {
            return $this->voidCommand;
        }
    }
}
