<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Infrastructure;

use Freyr\Panda\QA\Scheduling\Application\Identity;
use Freyr\Panda\QA\Scheduling\Core\Job;
use Freyr\Panda\QA\Scheduling\Core\Order\ItemState;
use Freyr\Panda\QA\Scheduling\Core\Packet\Packet;
use Freyr\Panda\QA\Scheduling\Core\Packet\PacketRepository;
use Freyr\Panda\QA\Scheduling\Core\Packet\PacketStatus;
use Freyr\Panda\QA\Scheduling\Core\Target\Policy;
use Freyr\Panda\QA\Scheduling\Core\Target\Target;
use Freyr\Panda\QA\Scheduling\Core\Target\TargetPolicy;
use Freyr\Panda\QA\Tests\Scheduling\Core\JobId;

class PacketInMemoryRepository implements PacketRepository
{
    public function __construct()
    {
    }

    public function getById(Identity $packetId): Packet
    {
        return new Packet($packetId, PacketStatus::ENABLED,
            [new Job(
                JobId::new(),
                new TargetPolicy(Policy::ANY, Target::CA),
                100,
                ItemState::CREATED
            )
        ]);
    }
}