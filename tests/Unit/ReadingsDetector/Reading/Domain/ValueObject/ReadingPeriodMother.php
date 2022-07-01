<?php

namespace Tests\Unit\ReadingsDetector\Reading\Domain\ValueObject;

use Src\ReadingsDetector\Reading\Domain\ValueObject\ReadingPeriod;
use Tests\Utils\Stubs\Shared\Domain\ValueObject\StringMother;

final class ReadingPeriodMother
{

    public static function create(string $period): ReadingPeriod
    {
        return new ReadingPeriod($period);
    }

    public static function random(): ReadingPeriod
    {
        return self::create(StringMother::random());
    }
}
