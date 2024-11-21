<?php

namespace M\Parkautomat\Entities;

use DateTime;
use DateTimeImmutable;
use Ramsey\Uuid\Uuid;

class ExitGate
{
    public function openGate(Ticket $ticket): Ticket
    {
        if ($ticket->isPaid()) {
            $ticket->setExitTime(new DateTimeImmutable());
        }

        return $ticket;

    }

}
