<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Identity;

use Freyr\Panda\QA\Scheduling\Application\Identity;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Id implements Identity
{
    protected function __construct(readonly private UuidInterface $uuid)
    {

    }
    public static function new(): static
    {
        return new self(Uuid::uuid7());
    }

    public static function fromString(string $id): static
    {
        return new self(Uuid::fromString($id));
    }
    public static function fromBinary(string $id): static
    {
        return new self(Uuid::fromBytes($id));
    }

    public function toBinary(): string
    {
        return $this->uuid->getBytes();
    }

    public function equals(Identity $identity): bool
    {
        return $this->uuid->equals($identity->uuid);
    }

    public function __toString(): string
    {
        return $this->uuid->toString();
    }
}