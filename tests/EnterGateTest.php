<?php
declare(strict_types=1);

use M\Parkautomat\Entities\EnterGate;
use M\Parkautomat\Entities\Ticket;
use M\Parkautomat\Service\TicketFactory;
use M\Parkautomat\Service\TicketRegistry;
use PHPUnit\Framework\MockObject\Rule\InvokedCount;
use PHPUnit\Framework\TestCase;

/**
 * @covers \M\Parkautomat\Entities\EnterGate
 */
class EnterGateTest extends TestCase
{

    public function testEnterGate()
    {
        $enterGate = new EnterGate();
        $ticket = $enterGate->openGate();

        $this->assertNotNull($ticket->getEnterTime());

        $ticketRegistry = TicketRegistry::getInstance();
        $ticket2 = $ticketRegistry->get($ticket->getTicketId());

        $this->assertSame($ticket, $ticket2);

    }

    public function testMocking()
    {
        $enterGate = $this->createMock(EnterGate::class);
        $ticketBuilder = new TicketFactory();
        $testTicket = $ticketBuilder->generate();
        $testTicket->setEnterTime(new DateTimeImmutable());

        $enterGate->expects(new InvokedCount(1))
            ->method('openGate')->willReturn($testTicket);

        $ticket = $enterGate->openGate();
        $this->assertNotNull($ticket->getEnterTime());

    }


}
