<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Core\Order;

use Freyr\Panda\QA\Scheduling\Application\Identity;
use Freyr\Panda\QA\Scheduling\Core\Packet\Packet;
use Freyr\Panda\QA\Identity\Id;
use Freyr\Panda\QA\Scheduling\Core\Packet\PacketStatus;
use RuntimeException;

class Order
{
    /**
     * @var Item[]
     */
    private array $items;

    public function __construct(
        public readonly OrderId $id,
        private int $priority,
    )
    {

    }

    public static function new(
        NewOrder $newOrder,
        Packet $packet,
    ): Order
    {
        if($packet->status === PacketStatus::DISABLED) {
            throw new RuntimeException();
        }

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
        $this->items[(string) $item->id] = $item;
    }
}