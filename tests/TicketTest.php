<?php
declare(strict_types=1);

use M\Parkautomat\Entities\Checkout;
use M\Parkautomat\Entities\EnterGate;
use M\Parkautomat\Entities\ExitGate;
use M\Parkautomat\Entities\Ticket;
use PHPUnit\Framework\TestCase;

class TicketTest extends TestCase
{

    public function testNewTicket()
    {
        $ticket = new Ticket();
        $this->assertNull($ticket->getExitTime());
        $this->assertNull($ticket->getPayTime());
        $this->assertNull($ticket->getTicketId());
        $this->assertNull($ticket->getEnterTime());
    }

    public function testTicketAfterEnterGate()
    {
        $enterGate = new EnterGate();
        $ticket = $enterGate->openGate();
        $this->assertNull($ticket->getExitTime());
        $this->assertNull($ticket->getPayTime());
        $this->assertNotNull($ticket->getTicketId());
        $this->assertNotNull($ticket->getEnterTime());
    }

    public function testExitGateUnpaid()
    {
        $enterGate = new EnterGate();
        $ticket = $enterGate->openGate();

        $exitGate = new ExitGate();
        $returnedTicket = $exitGate->openGate($ticket);

        $this->assertNull($returnedTicket->getExitTime());

    }

    public function testPriceFreshTicket()
    {
        $enterGate = new EnterGate();
        $ticket = $enterGate->openGate();
        $checkout = new Checkout($ticket);
        $this->assertEquals(0, $checkout->getPriceTotal());
    }

    public function testPriceOlderTicket()
    {
        $enterGate = new EnterGate();
        $ticket = $enterGate->openGate();
        $checkout = new Checkout($ticket, new DateTimeImmutable("now +3 hour"));
        $this->assertEquals(3, $checkout->getPriceTotal());
    }

    public static function payPriceProvider(): array
    {
        return [
            [3, 10, 7],
            [1, 1, 0],
            [5, 3, -2],
        ];
    }

    /**
     * @param int $hours
     * @param int $payAmount
     * @param int $changeAmount
     *
     * @return void
     * @dataProvider payPriceProvider
     */
    public function testPayTicketTooMuch(int $hours, int $payAmount, int $changeAmount)
    {
        $enterGate = new EnterGate();
        $ticket = $enterGate->openGate();
        $checkout = new Checkout($ticket, new DateTimeImmutable("now +{$hours} hour"));
        $change = $checkout->pay($payAmount);
        $this->assertEquals($changeAmount, $change);
    }


}
