<?php

namespace Src\ReadingsDetector\Reading\Application\GetSuspicious;

use Src\ReadingsDetector\Reading\Domain\Entity\Reading;
use Src\ReadingsDetector\Reading\Domain\ValueObject\ReadingAnnualAverage;

final class SuspiciousReadingsResponse
{

    public function __construct(private array $values = array()){ }

    public function add(Reading $reading, ReadingAnnualAverage $average)
    {
        $this->values[] = [
            "clientId"   => $reading->clientId()->value(),
            "month"      => $reading->period()->value(),
            "suspicious" => $reading->count()->value(),
            "average"    => $average->value()
        ];
    }

    public function values() : array
    {
        return $this->values;
    }

}
