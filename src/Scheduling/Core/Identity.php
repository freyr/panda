<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Core;

interface Identity
{
    public function toBinary(): string;
    public function equals(Identity $identity): bool;
    public function __toString(): string;
}