<?php

namespace M\Parkautomat\Entities;

use DateTime;
use DateTimeImmutable;
use Ramsey\Uuid\Uuid;

class Checkout
{

    private int $hourRate = 1;

    private int $pricePaid = 0;

    public function __construct(private Ticket $ticket, private ?DateTimeImmutable $currentTime = null)
    {
        if ($this->currentTime === null) {
            $this->currentTime = new DateTimeImmutable();
        }

    }

    public function getPriceTotal(): int
    {
        $hours = $this->currentTime->diff($this->ticket->getEnterTime())->h;
        return $this->hourRate * $hours;
    }

    public function getPricePaid(): int
    {
        return $this->pricePaid;
    }

    public function getPriceDue(): int
    {
        return $this->getPriceTotal() - $this->getPricePaid();
    }

    /**
     * @param int $amount
     *
     * @return int - change money
     */
    public function pay(int $amount): int
    {
        $due = $this->getPriceDue();
        if ($due === 0) {
            //no need to pay
            return $amount;
        }

        //Wechselgeld
        $changeAmount = $amount - $due;

        $this->pricePaid += $due - $changeAmount;

        return $changeAmount;

    }

}
