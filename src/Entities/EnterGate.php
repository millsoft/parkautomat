<?php

namespace M\Parkautomat\Entities;

use DateTime;
use DateTimeImmutable;
use Ramsey\Uuid\Uuid;

class EnterGate
{
    public function openGate(): Ticket
    {
        $ticket = new Ticket();
        $ticket->setTicketId(Uuid::uuid4());
        $ticket->setEnterTime(new DateTimeImmutable());
        return $ticket;

    }

}
