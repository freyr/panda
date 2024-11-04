<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Core\Packet;

enum PacketStatus: string
{
    case ENABLED = 'enabled';
    case DISABLED = 'disabled';
}