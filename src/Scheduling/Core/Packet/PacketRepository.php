<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Core\Packet;

use Freyr\Panda\QA\Scheduling\Application\Identity;

interface PacketRepository
{
    public function getById(Identity $packetId): Packet;
}