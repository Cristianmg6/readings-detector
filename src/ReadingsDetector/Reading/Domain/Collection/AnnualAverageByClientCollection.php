<?php

namespace Src\ReadingsDetector\Reading\Domain\Collection;

use Src\ReadingsDetector\Reading\Domain\Exception\ClientAnnualAverageNotFoundException;
use Src\ReadingsDetector\Reading\Domain\ValueObject\ReadingAnnualAverage;
use Src\ReadingsDetector\Reading\Domain\ValueObject\ClientId;

final class AnnualAverageByClientCollection
{

    public function __construct(private array $items = array()){ }

    public function addAnnualAverageByClientId(ClientId $clientId, ReadingAnnualAverage $average): void
    {
        $this->items[$clientId->value()] = $average;
    }

    /** * @throws ClientAnnualAverageNotFoundException */
    public function getByClientId(ClientId $clientId): ReadingAnnualAverage
    {
        $this->ensureClientIdExists($clientId);
        return $this->items[$clientId->value()];
    }

    /** * @throws ClientAnnualAverageNotFoundException */
    protected function ensureClientIdExists(ClientId $clientId) : void
    {
        if(!isset($this->items[$clientId->value()])){
            throw ClientAnnualAverageNotFoundException::ofClientId($clientId);
        }
    }
}
