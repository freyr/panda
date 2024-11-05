<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Core\Order;

use Freyr\Panda\QA\Identity\Id;
use Freyr\Panda\QA\Scheduling\Core\Packet\Packet;
use Freyr\Panda\QA\Scheduling\Core\Packet\PacketStatus;
use Freyr\Panda\QA\Scheduling\Core\Runner\ItemRunner;
use RuntimeException;

class Order
{
    /**
     * @var Item[]
     */
    private array $items;

    public function __construct(
        public readonly OrderId $id,
        public readonly int $priority,
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
            $newOrder->getOrderId(),
            $newOrder->getPriority()
        );
        foreach ($packet->getJobs() as $job) {
            $target = $job->targetPolicy->matchWith($newOrder->getOverrideTargetPolicy());
            $item = new Item(Id::new(), $job->id, $target, $job->priority, ItemState::CREATED);
            $order->addItem($item);
        }
        return $order;
    }

    private function addItem(Item $item): void
    {
        $this->items[(string) $item->id] = $item;
    }

    public function execute(ItemRunner $runner): void
    {
        $max = 0;
        $items = $this->items;
        usort($items, function (Item $a, Item $b) {
            return $a->priority <=> $b->priority;
        });
        foreach ($items as $item) {
            if ($item->canBeExecuted()) {
                $runner->run($item->serialise());
                $item->execute();
                $max++;
            }
            if ($max === 8) {
                return;
            }
        }
    }

    public function getItems(): array
    {
        return $this->items;
    }
}