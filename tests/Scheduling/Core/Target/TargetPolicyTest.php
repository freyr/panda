<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Tests\Scheduling\Core\Target;

use Freyr\Panda\QA\Scheduling\Core\Target\Policy;
use Freyr\Panda\QA\Scheduling\Core\Target\Target;
use Freyr\Panda\QA\Scheduling\Core\Target\TargetPolicy;
use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class TargetPolicyTest extends TestCase
{

    public static function possibleCombinationOfPolicies(): Generator
    {
        yield [
            'initial' => new TargetPolicy(Policy::ANY, Target::CA),
            'override' => new TargetPolicy(Policy::ANY, Target::PL),
            'expectedTarget' => Target::PL,
        ];

        yield [
            new TargetPolicy(Policy::ANY, Target::CA),
            new TargetPolicy(Policy::ANY, Target::PL),
            Target::PL
        ];

        yield [
            new TargetPolicy(Policy::ANY, Target::CA),
            new TargetPolicy(Policy::ANY, Target::PL),
            Target::PL
        ];

        yield [
            new TargetPolicy(Policy::ANY, Target::CA),
            new TargetPolicy(Policy::ANY, Target::PL),
            Target::PL
        ];

        yield [
            new TargetPolicy(Policy::ANY, Target::CA),
            new TargetPolicy(Policy::ANY, Target::PL),
            Target::PL
        ];

        yield [
            new TargetPolicy(Policy::ANY, Target::CA),
            new TargetPolicy(Policy::ANY, Target::PL),
            Target::PL
        ];

        yield [
            new TargetPolicy(Policy::ANY, Target::CA),
            new TargetPolicy(Policy::ANY, null),
            Target::US
        ];
    }

    #[Test]
    #[DataProvider('possibleCombinationOfPolicies')]
    public function shouldSelectCorrectTargetBasedOnSourceAndOverridePolicies(
        TargetPolicy $initial,
        TargetPolicy $override,
        Target $expectedTarget
    ): void {
        $actualTarget = $initial->matchWith($override);
        self::assertEquals($expectedTarget, $actualTarget);
    }
}