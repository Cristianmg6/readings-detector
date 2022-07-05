<?php

namespace Src\ReadingsDetector\Reading\Domain\Entity;

use Src\ReadingsDetector\Reading\Domain\ValueObject\ReadingAnnualAverage;
use Src\ReadingsDetector\Reading\Domain\ValueObject\ReadingCount;
use Src\ReadingsDetector\Reading\Domain\ValueObject\ReadingPeriod;
use Src\ReadingsDetector\Reading\Domain\ValueObject\ClientId;

final class Reading
{
    private const SUSPICIOUS_PERCENTAGE_MARGIN = 50;

    public function __construct(
        private ClientId $clientId,
        private ReadingPeriod $period,
        private ReadingCount $count
    ){ }


    public function clientId() : ClientId
    {
        return $this->clientId;
    }


    public function period() : ReadingPeriod
    {
        return $this->period;
    }


    public function count() : ReadingCount
    {
        return $this->count;
    }

    public function isSuspicious(ReadingAnnualAverage $annualAverage) : bool
    {
        return
            $this->count()->value() > $annualAverage->maxMarginByPercentage(self::SUSPICIOUS_PERCENTAGE_MARGIN) ||
            $this->count()->value() < $annualAverage->minMarginByPercentage(self::SUSPICIOUS_PERCENTAGE_MARGIN);
    }
}
