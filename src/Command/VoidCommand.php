<?php


namespace TheAentMachine\Command;

/**
 * A command that does nothing
 */
final class VoidCommand extends AbstractEventCommand
{
    protected function configure()
    {
        parent::configure();
        $this->setHidden(true);
    }

    protected function getEventName(): string
    {
        return 'void';
    }

    protected function executeEvent(?string $payload): ?string
    {
        // Let's do nothing.
        $this->log->debug('Event cannot be handled. Ignoring.');
        return null;
    }
}
