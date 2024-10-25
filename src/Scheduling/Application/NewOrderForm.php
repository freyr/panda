<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Application;

use Freyr\Panda\QA\Scheduling\Core\Order\NewOrder;
use Freyr\Panda\QA\Scheduling\Core\Target\Policy;
use Freyr\Panda\QA\Scheduling\Core\Target\Target;
use Freyr\Panda\QA\Scheduling\Core\Target\TargetPolicy;
use Freyr\Panda\QA\SharedKernel\Id;
use Freyr\Panda\QA\SharedKernel\Identity;

readonly class NewOrderForm implements NewOrder
{
    private TargetPolicy $targetPolicy;
    public function __construct(
        private string $policy,
        private string $target,
        private Identity $packetId,
        private int $priority,
        private Identity $ownerId,
        private Identity $newOrderId,
    )
    {
        $this->targetPolicy = new TargetPolicy(
            Policy::from($this->policy),
            Target::from($this->target),
        );
    }
    private Identity $identityFactory;

    public function ownerId(): Identity
    {
        return Id::fromString($this->ownerId);
    }

    public function getPriority(): int
    {
        return $this->priority;
    }

    public function getOverrideTargetPolicy(): TargetPolicy
    {
        return $this->targetPolicy;
    }

    public function getPacketId(): Identity
    {
        return Id::fromString($this->packetId);
    }

    public function getNewOrderId(): Identity
    {
        $this->newOrderId;
    }
}