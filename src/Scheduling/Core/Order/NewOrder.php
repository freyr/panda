<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Core\Order;

use Freyr\Panda\QA\Scheduling\Application\Identity;
use Freyr\Panda\QA\Scheduling\Core\OwnerId;
use Freyr\Panda\QA\Scheduling\Core\Target\TargetPolicy;

interface NewOrder
{
    public function ownerId(): OwnerId;

    public function getPriority(): int;

    public function getOverrideTargetPolicy(): TargetPolicy;

    public function getPacketId(): Identity;

    public function getNewOrderId(): OrderId;
}