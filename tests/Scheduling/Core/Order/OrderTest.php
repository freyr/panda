<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Tests\Scheduling\Core\Order;

use Freyr\Panda\QA\Identity\Id;
use Freyr\Panda\QA\Scheduling\Application\NewOrderForm;
use Freyr\Panda\QA\Scheduling\Core\Job;
use Freyr\Panda\QA\Scheduling\Core\Order\ItemState;
use Freyr\Panda\QA\Scheduling\Core\Order\Order;
use Freyr\Panda\QA\Scheduling\Core\Order\OrderId;
use Freyr\Panda\QA\Scheduling\Core\Packet\Packet;
use Freyr\Panda\QA\Scheduling\Core\Packet\PacketStatus;
use Freyr\Panda\QA\Scheduling\Core\Target\Policy;
use Freyr\Panda\QA\Scheduling\Core\Target\Target;
use Freyr\Panda\QA\Scheduling\Core\Target\TargetPolicy;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class OrderTest extends TestCase
{
    /**
     * @test
     */
    public function shouldThrowExceptionOnBadState()
    {
        self::expectException(\RuntimeException::class);
        $command = new NewOrderForm(
            'preferred',
            'us',
            Id::new(),
            100,
            Id::new(),
            OrderId::new(),
        );
        $packet = new Packet(
            Id::new(),
            PacketStatus::DISABLED,
            [
                new Job(
                    new TargetPolicy(Policy::ANY, Target::CA),
                    100,
                    ItemState::CREATED
                )
            ]
        );

        Order::new($command, $packet);
    }

    /**
     * @test
     */
    public function shouldCreateOrder()
    {
        $command = new NewOrderForm(
            'preferred',
            'us',
            Id::new(),
            100,
            Id::new(),
            OrderId::new(),
        );
        $packet = new Packet(
            Id::new(), PacketStatus::ENABLED,
            [
                new Job(
                    new TargetPolicy(Policy::ANY, Target::CA),
                    100,
                    ItemState::CREATED
                )
            ]
        );

        $order = Order::new($command, $packet);

//        $reflection = new ReflectionClass($order);
//        $property = $reflection->getProperty('items');
//        $property->setAccessible(true);
//        $items = $property->getValue($order);
//        self::assertCount(1, $items);

//        $getter = fn() => $this->items;
//        $items = $getter->call($order);

        self::assertCount(1, $order->getItems());
    }
}