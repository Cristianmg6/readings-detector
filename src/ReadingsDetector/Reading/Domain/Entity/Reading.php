<?php

namespace Src\ReadingsDetector\Reading\Domain\Entity;

use Src\ReadingsDetector\Reading\Domain\ValueObject\ReadingCount;
use Src\ReadingsDetector\Reading\Domain\ValueObject\ReadingPeriod;
use Src\ReadingsDetector\Shared\Domain\ValueObject\ClientId;

final class Reading
{
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


}
