<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Application;

use Freyr\Panda\QA\Scheduling\Core\Id;
use Freyr\Panda\QA\Scheduling\Core\Identity;
use Freyr\Panda\QA\Scheduling\Core\NewOrder;
use Freyr\Panda\QA\Scheduling\Core\Policy;
use Freyr\Panda\QA\Scheduling\Core\Target;
use Freyr\Panda\QA\Scheduling\Core\TargetPolicy;

class NewOrderForm implements NewOrder
{
    public function __construct(
        private string $policy,
        private string $target,
        private $packetId,
        private $priority,
    )
    {

    }
    private Identity $identityFactory;

    public function ownerId(): Identity
    {
        return $this->identity;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }

    public function getOverrideTargetPolicy(): TargetPolicy
    {
        return new TargetPolicy(
            Policy::from($this->policy),
            Target::from($this->target),
        );
    }

    public function getPacketId(): Identity
    {
        return Id::fromString($this->packetId);
    }
}