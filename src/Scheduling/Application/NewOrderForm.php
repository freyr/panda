<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Application;

use Freyr\Panda\QA\Scheduling\Core\Order\NewOrder;
use Freyr\Panda\QA\Scheduling\Core\Order\OrderId;
use Freyr\Panda\QA\Scheduling\Core\OwnerId;
use Freyr\Panda\QA\Scheduling\Core\Target\Policy;
use Freyr\Panda\QA\Scheduling\Core\Target\Target;
use Freyr\Panda\QA\Scheduling\Core\Target\TargetPolicy;
use Freyr\Panda\QA\Identity\Id;

readonly class NewOrderForm implements NewOrder
{
    private TargetPolicy $targetPolicy;
    public function __construct(
        private string $policy,
        private string $target,
        private Identity $packetId,
        private int $priority,
        private Identity $ownerId,
        private OrderId $newOrderId,
    )
    {
        $this->targetPolicy = new TargetPolicy(
            Policy::tryFrom($this->policy) ?? Policy::ANY,
            Target::tryFrom($this->target) ?? Target::US,
        );
    }
    private Identity $identityFactory;

    public function ownerId(): OwnerId
    {
        return OwnerId::fromString((string) $this->ownerId);
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
        return Id::fromString((string) $this->packetId);
    }

    public function getOrderId(): OrderId
    {
        return $this->newOrderId;
    }
}