<?php

namespace M\Parkautomat\Service;

use M\Parkautomat\Entities\Ticket;
use Ramsey\Uuid\Uuid;

final class TicketFactory
{
    public function generate(): Ticket
    {
        $ticket = new Ticket();
        $ticket->setTicketId(Uuid::uuid4());
        return $ticket;
    }
}
