<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Core\Target;

readonly class TargetPolicy
{
    public function __construct(private Policy $policy, private ?Target $target)
    {

    }

    public function matchWith(TargetPolicy $override): Target
    {
        return match ($this->policy) {
            Policy::ANY => $override->target ?? Target::US,
            Policy::STRICT => $this->target,
            Policy::PREFERRED => $override->target ?? $this->target ?? Target::US,
        };
    }
}