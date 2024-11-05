<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Tests\Scheduling\Core\Order;

use Freyr\Panda\QA\Identity\Id;
use Freyr\Panda\QA\Scheduling\Application\NewOrderForm;
use Freyr\Panda\QA\Scheduling\Core\CreateOrder;
use Freyr\Panda\QA\Scheduling\Core\Job;
use Freyr\Panda\QA\Scheduling\Core\Order\ItemState;
use Freyr\Panda\QA\Scheduling\Core\Order\NewOrder;
use Freyr\Panda\QA\Scheduling\Core\Order\Order;
use Freyr\Panda\QA\Scheduling\Core\Order\OrderId;
use Freyr\Panda\QA\Scheduling\Core\Packet\Packet;
use Freyr\Panda\QA\Scheduling\Core\Packet\PacketStatus;
use Freyr\Panda\QA\Scheduling\Core\Runner\ItemRunner;
use Freyr\Panda\QA\Scheduling\Core\Target\Policy;
use Freyr\Panda\QA\Scheduling\Core\Target\Target;
use Freyr\Panda\QA\Scheduling\Core\Target\TargetPolicy;
use Freyr\Panda\QA\Tests\Scheduling\Core\JobId;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

class OrderTest extends TestCase
{
    #[Test]
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
                    JobId::new(),
                    new TargetPolicy(Policy::ANY, Target::CA),
                    100,
                    ItemState::CREATED
                )
            ]
        );

        Order::new($command, $packet);
    }

    #[Test]
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
                    JobId::new(),
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

        $command = $this->getMockBuilder(NewOrder::class)
            ->enableAutoReturnValueGeneration()
            ->disableOriginalConstructor()
            ->getMock();
    }

    #[Test]
    public function shouldExecuteOrderWithRunnerMock()
    {
        $packet = new Packet(
            Id::new(), PacketStatus::ENABLED,
            [
                new Job(JobId::new(), new TargetPolicy(Policy::ANY, Target::CA), 100, ItemState::CREATED),
                new Job(JobId::new(), new TargetPolicy(Policy::ANY, Target::CA), 100, ItemState::CREATED),
                new Job(JobId::new(), new TargetPolicy(Policy::ANY, Target::CA), 100, ItemState::CREATED),
                new Job(JobId::new(), new TargetPolicy(Policy::ANY, Target::CA), 100, ItemState::CREATED),
                new Job(JobId::new(), new TargetPolicy(Policy::ANY, Target::CA), 100, ItemState::CREATED),
                new Job(JobId::new(), new TargetPolicy(Policy::ANY, Target::CA), 100, ItemState::CREATED),
                new Job(JobId::new(), new TargetPolicy(Policy::ANY, Target::CA), 100, ItemState::CREATED),
                new Job(JobId::new(), new TargetPolicy(Policy::ANY, Target::CA), 100, ItemState::CREATED),
                new Job(JobId::new(), new TargetPolicy(Policy::ANY, Target::CA), 100, ItemState::CREATED),
                new Job(JobId::new(), new TargetPolicy(Policy::ANY, Target::CA), 100, ItemState::CREATED),
                new Job(JobId::new(), new TargetPolicy(Policy::ANY, Target::CA), 100, ItemState::CREATED),
            ]
        );

        $newOrderId = OrderId::new();
        $command = new NewOrderForm('any', 'us', Id::new(), 100, Id::new(), $newOrderId);

        $order = Order::new($command, $packet);
        self::assertEquals($newOrderId, $order->id);
        self::assertCount(11, $order->getItems());

        $order->execute($runner);

        // mock the runner, ensure that runner method is called

        // check number of Items that was actually executed (sent)

        // check if those Items "know" that they were executed


    }
}