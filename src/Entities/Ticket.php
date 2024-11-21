<?php

namespace M\Parkautomat\Entities;

use DateTime;
use DateTimeImmutable;

class Ticket
{
    private ?string $ticketId = null;
    private ?DateTimeImmutable $enterTime = null;
    private ?DateTime $payTime = null;
    private ?DateTimeImmutable $exitTime = null;
    private bool $isPaid = false;

    public function isPaid(): bool
    {
        return $this->isPaid;
    }

    public function setIsPaid(bool $isPaid): void
    {
        $this->isPaid = $isPaid;
    }

    public function getTicketId(): ?string
    {
        return $this->ticketId;
    }

    public function setTicketId(?string $ticketId): void
    {
        $this->ticketId = $ticketId;
    }

    public function getEnterTime(): ?DateTimeImmutable
    {
        return $this->enterTime;
    }

    public function setEnterTime(?DateTimeImmutable $enterTime): void
    {
        $this->enterTime = $enterTime;
    }

    public function getPayTime(): ?DateTime
    {
        return $this->payTime;
    }

    public function setPayTime(?DateTime $payTime): void
    {
        $this->payTime = $payTime;
    }

    public function getExitTime(): ?DateTimeImmutable
    {
        return $this->exitTime;
    }

    public function setExitTime(?DateTimeImmutable $exitTime): void
    {
        $this->exitTime = $exitTime;
    }


}
