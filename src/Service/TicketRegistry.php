<?php

namespace M\Parkautomat\Service;

use Exception;
use M\Parkautomat\Entities\Ticket;

final class TicketRegistry
{
    private static ?self $instance = null;

    /**
     * @var Ticket[]
     */
    private array $registry = [];

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @throws Exception
     */
    public function set(Ticket $ticket): void
    {
        if ($ticket->getTicketId() === null) {
            throw new Exception("Ticket has no id");
        }
        $this->registry[$ticket->getTicketId()] = $ticket;
    }

    public function get(string $id): ?Ticket
    {
        return $this->registry[$id] ?? null;
    }

    public function remove(string $id): void
    {
        unset($this->registry[$id]);
    }

    public function count(): int
    {
        return count($this->registry);
    }

    public function reset(): void
    {
        $this->registry = [];
    }


}
