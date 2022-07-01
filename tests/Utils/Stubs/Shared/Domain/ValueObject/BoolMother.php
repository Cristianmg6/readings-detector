<?php

namespace Tests\Utils\Stubs\Shared\Domain\ValueObject;

final class BoolMother
{
    public static function create(bool $value): bool
    {
        return $value;
    }

    public static function random(): bool
    {
        return MotherCreator::random()->boolean;
    }
}
