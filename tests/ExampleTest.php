<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Tests;

use Freyr\Panda\QA\Scheduling\Application\NewOrderForm;
use Freyr\Panda\QA\Scheduling\Core\CreateOrder;
use Freyr\Panda\QA\Scheduling\Core\Order\OrderFactory;
use Freyr\Panda\QA\Scheduling\Infrastructure\OrderInMemoryRepository;
use Freyr\Panda\QA\Scheduling\Infrastructure\PacketInMemoryRepository;
use Freyr\Panda\QA\SharedKernel\Id;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    public function test_example(): void
    {
        $orderRepository = new OrderInMemoryRepository();
        $packetRepository = new PacketInMemoryRepository();
        $handler = new CreateOrder(
            $orderRepository,
            new OrderFactory(
                $packetRepository
            )
        );
        $command = new NewOrderForm(
            'preferred',
            'us',
            Id::new(),
            100,
            Id::new(),
            Id::new(),
        );
        $handler($command);

        self::assertTrue(true);
    }
}