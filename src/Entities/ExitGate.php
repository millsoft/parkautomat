<?php

namespace M\Parkautomat\Entities;

use DateTime;
use DateTimeImmutable;
use Ramsey\Uuid\Uuid;

class ExitGate
{
    public function openGate(Ticket $ticket): Ticket
    {
        //TODO: check if paid

        return $ticket;

    }

}
