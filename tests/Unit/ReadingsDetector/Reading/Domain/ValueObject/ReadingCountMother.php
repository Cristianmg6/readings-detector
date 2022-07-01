<?php

namespace Tests\Unit\ReadingsDetector\Reading\Domain\ValueObject;

use Src\ReadingsDetector\Reading\Domain\ValueObject\ReadingCount;
use Tests\Utils\Stubs\Shared\Domain\ValueObject\IntegerMother;

final class ReadingCountMother
{

    public static function create(string $period): ReadingCount
    {
        return new ReadingCount($period);
    }

    public static function randomWithInterval(int $intervalMin, int $intervalMax): ReadingCount
    {
        return self::create(IntegerMother::between($intervalMin, $intervalMax));
    }

    public static function randomLessThan(int $count): ReadingCount
    {
        return self::create(IntegerMother::lessThan($count));
    }

    public static function randomMoreThan(int $count): ReadingCount
    {
        return self::create(IntegerMother::moreThan($count));
    }
}
