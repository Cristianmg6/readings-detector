<?php

namespace Src\ReadingsDetector\Reading\Domain\ValueObject;

final class ReadingAnnualAverage
{
    public function __construct(private int $average){ }

    public function value() : int
    {
        return $this->average;
    }

    public function minMarginByPercentage(int $percentage): int
    {
        return round($this->average * ((100 - $percentage) / 100));
    }

    public function maxMarginByPercentage(int $percentage): int
    {
        return round($this->average * ((100 + $percentage) / 100));
    }

}
