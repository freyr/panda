<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Core\Packet;

use Freyr\Panda\QA\Scheduling\Core\Job;

class Packet
{
    public PacketStatus $status;

    /**
     * @return Job[]
     */
    public function getJobs(): array
    {

    }
}