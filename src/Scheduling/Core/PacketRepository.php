<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Core;

interface PacketRepository
{
    public function getById(Identity $packetId): Packet;
}