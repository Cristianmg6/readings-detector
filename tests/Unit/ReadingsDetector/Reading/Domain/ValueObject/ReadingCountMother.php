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

    public static function random(): ReadingCount
    {
        return self::create(IntegerMother::random());
    }
}
