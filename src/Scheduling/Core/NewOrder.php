<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Core;

interface NewOrder
{
    public function ownerId(): Identity;

    public function getPriority(): int;

    public function getOverrideTargetPolicy(): TargetPolicy;

    public function getPacketId(): Identity;


}