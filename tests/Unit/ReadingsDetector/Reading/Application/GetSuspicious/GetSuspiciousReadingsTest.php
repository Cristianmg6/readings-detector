<?php

namespace Tests\Unit\ReadingsDetector\Reading\Application\GetSuspicious;

use Src\ReadingsDetector\Reading\Application\GetSuspicious\GetSuspiciousReadingsService;
use Src\ReadingsDetector\Reading\Application\GetSuspicious\SuspiciousReadingsResponse;
use Src\ReadingsDetector\Reading\Domain\Collection\AnnualAverageByClientCollection;
use Src\ReadingsDetector\Reading\Domain\Collection\ReadingCollection;
use Src\ReadingsDetector\Reading\Domain\Entity\Reading;
use Src\ReadingsDetector\Reading\Domain\Exception\ClientAnnualAverageNotFoundException;
use Src\ReadingsDetector\Reading\Domain\ValueObject\ClientId;
use Src\ReadingsDetector\Reading\Domain\ValueObject\ReadingAnnualAverage;
use Tests\Unit\ReadingsDetector\Reading\Domain\Collection\ReadingCollectionMother;
use Tests\Unit\ReadingsDetector\Reading\Domain\ValueObject\ClientIdMother;
use Tests\Unit\ReadingsDetector\Reading\Domain\ValueObject\ReadingCountMother;
use Tests\Unit\ReadingsDetector\Reading\Domain\ValueObject\ReadingPeriodMother;
use Tests\Unit\ReadingsDetector\Reading\ReadingModuleUnitTestCase;

class GetSuspiciousReadingsTest extends ReadingModuleUnitTestCase
{
    private const ANNUAL_AVERAGE    = 5500;
    private const COUNT_MIN_CORRECT = 5000;
    private const COUNT_MAX_CORRECT = 6000;
    private const SUSPICIOUS_PERCENTAGE_MARGIN = 50;

    private GetSuspiciousReadingsService $service;

    protected function setUp() : void
    {
        parent::setUp();
        $this->service = new GetSuspiciousReadingsService($this->readingRepository());
    }

    /** @test */
    public function get_suspicious_readings(): void
    {
        $clientId = ClientIdMother::random();

        $annualAverage = new ReadingAnnualAverage(self::ANNUAL_AVERAGE);
        $annualAverageCollection = $this->getAnnualAverageCollection($clientId, $annualAverage);

        $readingsCollection = $this->getRandomReadingsCollection($clientId);
        $incorrectReading1 = new Reading($clientId, ReadingPeriodMother::random(), ReadingCountMother::create($annualAverage->minMarginByPercentage(self::SUSPICIOUS_PERCENTAGE_MARGIN) - 1));
        $incorrectReading2 = new Reading($clientId, ReadingPeriodMother::random(), ReadingCountMother::create($annualAverage->maxMarginByPercentage(self::SUSPICIOUS_PERCENTAGE_MARGIN) + 1));
        $readingsCollection->add($incorrectReading1);
        $readingsCollection->add($incorrectReading2);

        $this->shouldGetAllReadings($readingsCollection);
        $this->shouldGetAnnualAveragesByClient($annualAverageCollection);

        $expectedResponse = $this->getSuspiciousReadingsResponse($annualAverage, $incorrectReading1, $incorrectReading2);
        $result = $this->service->__invoke();

        $this->assertEquals($expectedResponse->values(), $result->values());
    }

    /** @test */
    public function client_annual_average_not_found(): void
    {
        $this->expectException(ClientAnnualAverageNotFoundException::class);
        $clientId = ClientIdMother::random();

        $annualAverage = new ReadingAnnualAverage(self::ANNUAL_AVERAGE);
        $annualAverageCollection = $this->getAnnualAverageCollection($clientId, $annualAverage);
        $annualAverageCollection->getByClientId(ClientIdMother::random());
    }

    private function getRandomReadingsCollection(ClientId $clientId): ReadingCollection
    {
        return ReadingCollectionMother::withClientAndInterval(10, $clientId, self::COUNT_MIN_CORRECT, self::COUNT_MAX_CORRECT);
    }

    private function getAnnualAverageCollection(ClientId $clientId, ReadingAnnualAverage $average): AnnualAverageByClientCollection
    {
        $annualAverageCollection = new AnnualAverageByClientCollection();
        $annualAverageCollection->addAnnualAverageByClientId($clientId, $average);
        return $annualAverageCollection;
    }

    private function getSuspiciousReadingsResponse(ReadingAnnualAverage $annualAverage, ...$readings): SuspiciousReadingsResponse
    {
        $response = new SuspiciousReadingsResponse();
        /** @var Reading $reading */
        foreach($readings as $reading){
            $response->add($reading, $annualAverage);
        }
        return $response;
    }

}
