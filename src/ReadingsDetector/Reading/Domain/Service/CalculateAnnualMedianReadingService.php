<?php

namespace Src\ReadingsDetector\Reading\Domain\Service;

use Src\ReadingsDetector\Reading\Domain\Collection\ReadingCollection;
use Src\ReadingsDetector\Reading\Domain\Entity\Reading;
use Src\ReadingsDetector\Reading\Domain\ValueObject\ReadingAnnualMedian;

final class CalculateAnnualMedianReadingService
{
    public function __invoke(ReadingCollection $collection) : ReadingAnnualMedian
    {
        $sum = 0;

        /** @var Reading $reading */
        foreach($collection as $reading){
            $sum += $reading->count()->value();
        }

        $median = $sum / $collection->count();
        return new ReadingAnnualMedian($median);
    }
}
