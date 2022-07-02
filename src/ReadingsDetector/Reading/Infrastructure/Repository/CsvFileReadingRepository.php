<?php

namespace Src\ReadingsDetector\Reading\Infrastructure\Repository;

use League\Csv\Exception as CsvException;
use Src\ReadingsDetector\Reading\Domain\Collection\AnnualMedianByClientCollection;
use Src\ReadingsDetector\Reading\Domain\Collection\ReadingCollection;
use Src\ReadingsDetector\Reading\Domain\Contract\ReadingRepositoryInterface;
use League\Csv\Reader;
use Src\ReadingsDetector\Reading\Domain\Entity\Reading;
use Src\ReadingsDetector\Reading\Domain\ValueObject\ClientId;
use Src\ReadingsDetector\Reading\Domain\ValueObject\ReadingAnnualMedian;
use Src\ReadingsDetector\Reading\Domain\ValueObject\ReadingCount;
use Src\ReadingsDetector\Reading\Domain\ValueObject\ReadingPeriod;

class CsvFileReadingRepository implements ReadingRepositoryInterface
{

    private array $values;

    /** * @throws CsvException */
    public function __construct(string $filePath){
        $this->values = $this->loadFromCsvFile($filePath);
    }

    public function getAll() : ReadingCollection
    {
        $collection = new ReadingCollection();

        foreach($this->values as $readingArray)
        {
            $collection->addReading(
                new Reading(
                    new ClientId($readingArray['client']),
                    new ReadingPeriod($readingArray['period']),
                    new ReadingCount($readingArray['reading'])
                )
            );
        }

        return $collection;
    }

    public function getAnnualMediansByClient() : AnnualMedianByClientCollection
    {
        $collection = new AnnualMedianByClientCollection();
        $sumReadingsClientsArray = array();

        foreach($this->values as $readingArray){
            if(!isset($sumReadingsClientsArray[$readingArray['client']])) $sumReadingsClientsArray[$readingArray['client']] = 0;
            $sumReadingsClientsArray[$readingArray['client']] += (int) $readingArray['reading'];
        }

        foreach($sumReadingsClientsArray as $clientId => $clientReadingsSum){
            $collection->add(
                new ClientId($clientId),
                new ReadingAnnualMedian($clientReadingsSum / 12)
            );
        }

        return $collection;
    }

    /** * @throws CsvException */
    private function loadFromCsvFile(string $filePath) : array
    {
        $reader = Reader::createFromPath($filePath, 'r');
        $reader->setHeaderOffset(0);
        return iterator_to_array($reader, true);
    }
}
