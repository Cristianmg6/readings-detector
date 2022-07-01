<?php

namespace Tests\Utils\Stubs\Shared\Domain\ValueObject;

final class FloatMother
{
    public static function create(float $float): float
    {
        return $float;
    }

    public static function random($decimals = null): float
    {
        return MotherCreator::random()->randomFloat($decimals);
    }
}
