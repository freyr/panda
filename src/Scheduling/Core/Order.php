<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Core;

class Order
{
    public function __construct(
        public readonly Identity $id,
        private int $priority,
    )
    {

    }
    public static function new(
        NewOrder $newOrder,
        Packet $packet,
    ): Order
    {
        $order = new self(
            Id::new(),
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
}