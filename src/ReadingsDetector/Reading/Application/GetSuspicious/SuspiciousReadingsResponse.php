<?php

namespace Src\ReadingsDetector\Reading\Application\GetSuspicious;

use Src\ReadingsDetector\Reading\Domain\Entity\Reading;
use Src\ReadingsDetector\Reading\Domain\ValueObject\ReadingAnnualMedian;

final class SuspiciousReadingsResponse
{

    public function __construct(private array $values = array()) { }

    public function add(Reading $reading, ReadingAnnualMedian $median){
        $this->values[] = [
            "clientId"   => $reading->clientId()->value(),
            "month"      => $reading->period()->value(),
            "suspicious" => $reading->count()->value(),
            "median"     => $median->value()
        ];
    }

    public function values() : array
    {
        return $this->values;
    }

}
