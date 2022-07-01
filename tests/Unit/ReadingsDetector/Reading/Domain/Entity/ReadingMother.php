<?php

namespace Tests\Unit\ReadingsDetector\Reading\Domain\Entity;

use Src\ReadingsDetector\Reading\Domain\Entity\Reading;
use Tests\Unit\ReadingsDetector\Reading\Domain\ValueObject\ClientIdMother;
use Tests\Unit\ReadingsDetector\Reading\Domain\ValueObject\ReadingCountMother;
use Tests\Unit\ReadingsDetector\Reading\Domain\ValueObject\ReadingPeriodMother;

final class ReadingMother
{
    public static function random(): Reading
    {
        return new Reading(
            ClientIdMother::random(),
            ReadingPeriodMother::random(),
            ReadingCountMother::random()
        );
    }
}
