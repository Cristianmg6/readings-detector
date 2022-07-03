<?php

namespace Src\ReadingsDetector\Reading\Infrastructure\FileRepository;

use Src\ReadingsDetector\Reading\Domain\Collection\AnnualMedianByClientCollection;
use Src\ReadingsDetector\Reading\Domain\Collection\ReadingCollection;
use Src\ReadingsDetector\Reading\Domain\Contract\ReadingRepositoryInterface;
use Src\ReadingsDetector\Reading\Domain\Entity\Reading;
use Src\ReadingsDetector\Reading\Domain\Exception\FileException;
use Src\ReadingsDetector\Reading\Domain\ValueObject\ClientId;
use Src\ReadingsDetector\Reading\Domain\ValueObject\ReadingAnnualMedian;
use Src\ReadingsDetector\Reading\Domain\ValueObject\ReadingCount;
use Src\ReadingsDetector\Reading\Domain\ValueObject\ReadingPeriod;

class FileReadingRepository implements ReadingRepositoryInterface
{
    private array $values;
    private ReadingFileManager $fileManager;

    /** * @throws FileException */
    public function __construct(private string $filePath){
        $this->fileManager = new ReadingFileManager($this->filePath);
        $this->loadValuesFromFilePath($this->filePath);
    }

    private function getArrayValues() : array
    {
        return $this->values;
    }

    /** * @throws FileException */
    private function loadValuesFromFilePath(string $filePath) : void
    {
        $this->values = $this->fileManager->fromFileToArray();
        if(!is_array($this->values)) throw FileException::failedToArrayConversion($filePath);
    }

    public function getAll() : ReadingCollection
    {
        $collection = new ReadingCollection();

        foreach($this->getArrayValues() as $readingArray)
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

        foreach($this->getArrayValues() as $readingArray){
            if(!isset($sumReadingsClientsArray[$readingArray['client']])) $sumReadingsClientsArray[$readingArray['client']] = 0;
            $sumReadingsClientsArray[$readingArray['client']] += (int) $readingArray['reading'];
        }

        foreach($sumReadingsClientsArray as $clientId => $clientReadingsSum){
            $collection->addAnnualMedianByClientId(
                new ClientId($clientId),
                new ReadingAnnualMedian($clientReadingsSum / 12)
            );
        }

        return $collection;
    }
}
