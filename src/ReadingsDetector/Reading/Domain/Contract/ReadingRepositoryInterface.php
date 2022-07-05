<?php

namespace Src\ReadingsDetector\Reading\Domain\Contract;

use Src\ReadingsDetector\Reading\Domain\Collection\AnnualAverageByClientCollection;
use Src\ReadingsDetector\Reading\Domain\Collection\ReadingCollection;

interface ReadingRepositoryInterface
{
    public function getAll(): ReadingCollection;
    public function getAnnualAveragesByClient(): AnnualAverageByClientCollection;
}
