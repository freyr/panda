<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Infrastructure;

use Freyr\Panda\QA\Identity\Id;
use Freyr\Panda\QA\Scheduling\Core\Order\Item;
use Freyr\Panda\QA\Scheduling\Core\Order\ItemState;
use Freyr\Panda\QA\Scheduling\Core\Order\NewOrder;
use Freyr\Panda\QA\Scheduling\Core\Order\OrderId;
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
            $item = new Item(Id::new(), $target, $job->priority, ItemState::CREATED);
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

        return;
    }
}