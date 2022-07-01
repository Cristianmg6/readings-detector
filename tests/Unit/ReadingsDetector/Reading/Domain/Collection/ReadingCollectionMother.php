<?php


namespace Tests\Unit\ReadingsDetector\Reading\Domain\Collection;

use Src\ReadingsDetector\Reading\Domain\Collection\ReadingCollection;
use Src\ReadingsDetector\Reading\Domain\ValueObject\ClientId;
use Tests\Unit\ReadingsDetector\Reading\Domain\Entity\ReadingMother;

final class ReadingCollectionMother
{
    public static function withClientAndInterval(int $count, ClientId $clientId, int $intervalMin, int $intervalMax): ReadingCollection
    {
        $collection = new ReadingCollection();
        for($i = 0; $i < $count; $i++){
            $collection->addReading(ReadingMother::randomWithClientAndCountInterval($clientId, $intervalMin, $intervalMax));
        }
        return $collection;
    }
}
