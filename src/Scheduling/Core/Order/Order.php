<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Core\Order;

use Freyr\Panda\QA\Scheduling\Core\Packet\Packet;
use Freyr\Panda\QA\SharedKernel\Id;
use Freyr\Panda\QA\SharedKernel\Identity;

class Order
{
    /**
     * @var Item[]
     */
    private array $items;

    public function __construct(
        public readonly Identity $id,
        private int $priority,
    )
    {

    }

    public function rescheduleSingleItem(ItemId $identity): void
    {
        $item = $this->items[(string) $identity];
        if (!$item->reschedule()) {
            throw new CannotRescheduleItem($identity);
        }
    }

    public static function new(
        NewOrder $newOrder,
        Packet $packet,
    ): Order
    {
        $order = new self(
            $newOrder->getNewOrderId(),
            $newOrder->getPriority()
        );
        foreach ($packet->getJobs() as $job) {
            $target = $job->targetPolicy->matchWith($newOrder->getOverrideTargetPolicy());
            $item = new Item(Id::new(), $target, );
            $order->addItem($item);
        }
        return $order;
    }

    private function addItem(Item $item): void
    {
        $this->items[$item->id->toString()] = $item;
    }

    protected function popRecordedEvents(): array
    {
        $events = $this->events;
        $this->events = [];
        return $events;
    }
}