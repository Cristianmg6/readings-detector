<?php

namespace Src\ReadingsDetector\Reading\Domain\ValueObject;

final class ReadingCount
{
    public function __construct(private int $count){ }

    public function value() : int
    {
        return $this->count;
    }

}
