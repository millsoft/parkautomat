<?php
declare(strict_types=1);

use M\Parkautomat\Entities\Ticket;
use M\Parkautomat\Service\TicketFactory;
use M\Parkautomat\Service\TicketRegistry;
use PHPUnit\Framework\TestCase;

/**
 * @covers \M\Parkautomat\Service\TicketRegistry
 */
class TicketRegistryTest extends TestCase
{

    protected function setUp(): void
    {
        $registry = TicketRegistry::getInstance();
        $registry->reset();
    }

    public function testAddTicketToRegistry()
    {
        $ticketFactory = new TicketFactory();
        $ticket = $ticketFactory->generate();
        $id = $ticket->getTicketId();

        $registry = new TicketRegistry();
        $registry->set($ticket);

        $ticket2 = $registry->get($id);

        $this->assertInstanceOf(Ticket::class, $ticket2);
        $this->assertSame($id, $ticket2->getTicketId());
    }

    public function testNotFoundTicket()
    {
        $registry = new TicketRegistry();
        $ticket = $registry->get('abc');
        $this->assertNull($ticket);
    }

    public function testDeleteTicket()
    {
        $ticketFactory = new TicketFactory();
        $ticket = $ticketFactory->generate();

        $ticketRegistry = TicketRegistry::getInstance();
        $ticketRegistry->set($ticket);

        $ticketRegistry->remove($ticket->getTicketId());

        $ticket2 = $ticketRegistry->get($ticket->getTicketId());
        $this->assertNull($ticket2);

    }

    public function testTicketWithoutId()
    {
        $ticketRegistry = TicketRegistry::getInstance();
        $ticket = new Ticket();

        $this->expectExceptionMessage("Ticket has no id");
        $ticketRegistry->set($ticket);

    }

    public function testCount()
    {
        $ticketRegistry = TicketRegistry::getInstance();
        $this->assertEquals(0, $ticketRegistry->count());

        $ticketFactory = new TicketFactory();

        $ticketRegistry->set($ticketFactory->generate());
        $this->assertEquals(1, $ticketRegistry->count());

        $ticket = $ticketFactory->generate();
        $ticketRegistry->set($ticket);
        $this->assertEquals(2, $ticketRegistry->count());

        $ticketRegistry->remove($ticket->getTicketId());
        $this->assertEquals(1, $ticketRegistry->count());

    }

    public function testSingletonInstance()
    {
        $ticketRegistry1 = TicketRegistry::getInstance();
        $ticketRegistry2 = TicketRegistry::getInstance();
        $ticketFactory = new TicketFactory();

        $ticket = $ticketFactory->generate();
        $ticketRegistry1->set($ticket);

        $ticket2 = $ticketRegistry2->get($ticket->getTicketId());

        $this->assertSame($ticket, $ticket2);


    }


}
