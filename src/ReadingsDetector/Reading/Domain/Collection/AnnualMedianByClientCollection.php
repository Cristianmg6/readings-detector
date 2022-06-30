<?php

namespace Src\ReadingsDetector\Reading\Domain\Collection;

use Src\ReadingsDetector\Reading\Domain\Exception\ClientAnnualMedianNotFoundException;
use Src\ReadingsDetector\Reading\Domain\ValueObject\ReadingAnnualMedian;
use Src\ReadingsDetector\Shared\Domain\ValueObject\ClientId;

final class AnnualMedianByClientCollection
{

    public function __construct(private array $items = array()){ }

    public function add(ClientId $clientId, ReadingAnnualMedian $median): void
    {
        $this->items[$clientId->value()] = $median;
    }

    /** * @throws ClientAnnualMedianNotFoundException */
    public function getByClientId(ClientId $clientId): ReadingAnnualMedian
    {
        if(!isset($this->items[$clientId->value()])){
            throw ClientAnnualMedianNotFoundException::ofClientId($clientId);
        }
        return $this->items[$clientId->value()];
    }
}
