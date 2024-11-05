<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Core\Packet;

use Freyr\Panda\QA\Scheduling\Application\Identity;
use Freyr\Panda\QA\Scheduling\Core\Job;

class Packet
{
    public function __construct(
        public readonly Identity $id,
        public readonly PacketStatus $status,
        private readonly array $jobs,
    )
    {

    }
    /**
     * @return Job[]
     */
    public function getJobs(): array
    {
        return $this->jobs;
    }
}