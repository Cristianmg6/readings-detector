<?php

namespace Src\ReadingsDetector\Reading\Domain\ValueObject;

final class ReadingAnnualMedian
{
    public function __construct(private int $median){ }

    public function value() : int
    {
        return $this->median;
    }

    public function minMarginByPercentage(int $percentage): int
    {
        return round($this->median * ((100 - $percentage) / 100));
    }

    public function maxMarginByPercentage(int $percentage): int
    {
        return round($this->median * ((100 + $percentage) / 100));
    }

}
