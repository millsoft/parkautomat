<?php
declare(strict_types=1);

use M\Parkautomat\Entities\EnterGate;
use M\Parkautomat\Service\TicketRegistry;
use PHPUnit\Framework\TestCase;

/**
 * @covers \M\Parkautomat\Entities\EnterGate
 */
class EnterGateTest extends TestCase
{

    /**
     * @covers \M\Parkautomat\Entities\EnterGate
     */
    public function testEnterGate()
    {
        $enterGate = new EnterGate();
        $ticket = $enterGate->openGate();

        $this->assertNotNull($ticket->getEnterTime());

        $ticketRegistry = TicketRegistry::getInstance();
        $ticket2 = $ticketRegistry->get($ticket->getTicketId());

        $this->assertSame($ticket, $ticket2);

    }


}
