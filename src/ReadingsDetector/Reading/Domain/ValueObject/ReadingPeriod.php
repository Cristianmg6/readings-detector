<?php

namespace Src\ReadingsDetector\Reading\Domain\ValueObject;

final class ReadingPeriod
{
    public function __construct(private string $period){ }

    public function value() : string
    {
        return $this->period;
    }

}
