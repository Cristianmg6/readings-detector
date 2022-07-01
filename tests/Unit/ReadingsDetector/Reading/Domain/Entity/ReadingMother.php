<?php

namespace Tests\Unit\ReadingsDetector\Reading\Domain\Entity;

use Src\ReadingsDetector\Reading\Domain\Entity\Reading;
use Src\ReadingsDetector\Reading\Domain\ValueObject\ClientId;
use Tests\Unit\ReadingsDetector\Reading\Domain\ValueObject\ReadingCountMother;
use Tests\Unit\ReadingsDetector\Reading\Domain\ValueObject\ReadingPeriodMother;

final class ReadingMother
{
    public static function randomWithClientAndCountInterval(ClientId $clientId, int $intervalMin, int $intervalMax): Reading
    {
        return new Reading(
            $clientId,
            ReadingPeriodMother::random(),
            ReadingCountMother::randomWithInterval($intervalMin, $intervalMax)
        );
    }
}
