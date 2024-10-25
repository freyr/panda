<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Infrastructure;

use Freyr\Panda\QA\Scheduling\Core\Job;
use Freyr\Panda\QA\Scheduling\Core\Packet\Packet;
use Freyr\Panda\QA\Scheduling\Core\Packet\PacketRepository;
use Freyr\Panda\QA\SharedKernel\Identity;

class PacketInMemoryRepository implements PacketRepository
{
    public function __construct()
    {
    }

    public function getById(Identity $packetId): Packet
    {
        return new Packet($packetId, [new Job()]);
    }
}