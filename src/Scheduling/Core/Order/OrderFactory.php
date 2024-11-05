<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Core\Order;

use Freyr\Panda\QA\Scheduling\Core\Packet\PacketRepository;

readonly class OrderFactory
{
    public function __construct(
        private PacketRepository $packetRepository,
    )
    {
    }

    public function new(NewOrder $newOrder): Order
    {
        $packet = $this->packetRepository->getById($newOrder->getPacketId());
        return Order::new($newOrder, $packet);
    }
}