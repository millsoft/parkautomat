<?php

namespace M\Parkautomat\Entities;

use DateTime;
use DateTimeImmutable;
use M\Parkautomat\Service\TicketFactory;
use M\Parkautomat\Service\TicketRegistry;
use Ramsey\Uuid\Uuid;

class EnterGate
{
    public function openGate(): Ticket
    {
        $ticketFactory = new TicketFactory();
        $ticket = $ticketFactory->generate();
        $ticket->setEnterTime(new DateTimeImmutable());

        $ticketRegistry = TicketRegistry::getInstance();
        $ticketRegistry->set($ticket);
        return $ticket;

    }

}
