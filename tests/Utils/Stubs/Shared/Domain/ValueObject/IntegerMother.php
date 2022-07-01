<?php

namespace Tests\Utils\Stubs\Shared\Domain\ValueObject;

use const PHP_INT_MAX;

final class IntegerMother
{
    public static function random(): int
    {
        return MotherCreator::random()->numberBetween();
    }

    public static function between(int $min, int $max = PHP_INT_MAX): int
    {
        return MotherCreator::random()->numberBetween($min, $max);
    }

    public static function lessThan(int $max): int
    {
        return self::between(1, $max);
    }

    public static function moreThan(int $min): int
    {
        return self::between($min);
    }
}
