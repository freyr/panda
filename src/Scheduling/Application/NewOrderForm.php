<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Application;

use Freyr\Panda\QA\Scheduling\Core\Identity;
use Freyr\Panda\QA\Scheduling\Core\NewOrder;
use Freyr\Panda\QA\Scheduling\Core\TargetPolicy;

class NewOrderForm implements NewOrder
{


    public function __construct(
        private string $targetPolicyValue,
        private $packetId,
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
        return
    }

    public function getOverrideTargetPolicy(): TargetPolicy
    {
        return new TargetPolicy();
    }

    public function getPacketId(): Identity
    {
        return Id::fromString($this->packetId);
    }
}