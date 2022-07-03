<?php

namespace Tests\Unit\ReadingsDetector\Reading\Application\GetSuspicious;

use Src\ReadingsDetector\Reading\Application\GetSuspicious\GetSuspiciousReadingsService;
use Src\ReadingsDetector\Reading\Application\GetSuspicious\SuspiciousReadingsResponse;
use Src\ReadingsDetector\Reading\Domain\Collection\AnnualMedianByClientCollection;
use Src\ReadingsDetector\Reading\Domain\Collection\ReadingCollection;
use Src\ReadingsDetector\Reading\Domain\Entity\Reading;
use Src\ReadingsDetector\Reading\Domain\Exception\ClientAnnualMedianNotFoundException;
use Src\ReadingsDetector\Reading\Domain\ValueObject\ClientId;
use Src\ReadingsDetector\Reading\Domain\ValueObject\ReadingAnnualMedian;
use Tests\Unit\ReadingsDetector\Reading\Domain\Collection\ReadingCollectionMother;
use Tests\Unit\ReadingsDetector\Reading\Domain\ValueObject\ClientIdMother;
use Tests\Unit\ReadingsDetector\Reading\Domain\ValueObject\ReadingCountMother;
use Tests\Unit\ReadingsDetector\Reading\Domain\ValueObject\ReadingPeriodMother;
use Tests\Unit\ReadingsDetector\Reading\ReadingModuleUnitTestCase;

class GetSuspiciousReadingsTest extends ReadingModuleUnitTestCase
{
    private const ANNUAL_MEDIAN = 5500;
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

        $annualMedian = new ReadingAnnualMedian(self::ANNUAL_MEDIAN);
        $annualMedianCollection = $this->getAnnualMedianCollection($clientId, $annualMedian);

        $readingsCollection = $this->getRandomReadingsCollection($clientId);
        $incorrectReading1 = new Reading($clientId, ReadingPeriodMother::random(), ReadingCountMother::create($annualMedian->minMarginByPercentage(self::SUSPICIOUS_PERCENTAGE_MARGIN) - 1));
        $incorrectReading2 = new Reading($clientId, ReadingPeriodMother::random(), ReadingCountMother::create($annualMedian->maxMarginByPercentage(self::SUSPICIOUS_PERCENTAGE_MARGIN) + 1));
        $readingsCollection->add($incorrectReading1);
        $readingsCollection->add($incorrectReading2);

        $this->shouldGetAllReadings($readingsCollection);
        $this->shouldGetAnnualMediansByClient($annualMedianCollection);

        $expectedResponse = $this->getSuspiciousReadingsResponse($annualMedian, $incorrectReading1, $incorrectReading2);
        $result = $this->service->__invoke();

        $this->assertEquals($expectedResponse->values(), $result->values());
    }

    /** @test */
    public function client_annual_median_not_found(): void
    {
        $this->expectException(ClientAnnualMedianNotFoundException::class);
        $clientId = ClientIdMother::random();

        $annualMedian = new ReadingAnnualMedian(self::ANNUAL_MEDIAN);
        $annualMedianCollection = $this->getAnnualMedianCollection($clientId, $annualMedian);
        $annualMedianCollection->getByClientId(ClientIdMother::random());
    }

    private function getRandomReadingsCollection(ClientId $clientId): ReadingCollection
    {
        return ReadingCollectionMother::withClientAndInterval(10, $clientId, self::COUNT_MIN_CORRECT, self::COUNT_MAX_CORRECT);
    }

    private function getAnnualMedianCollection(ClientId $clientId, ReadingAnnualMedian $median): AnnualMedianByClientCollection
    {
        $annualMedianCollection = new AnnualMedianByClientCollection();
        $annualMedianCollection->addAnnualMedianByClientId($clientId, $median);
        return $annualMedianCollection;
    }

    private function getSuspiciousReadingsResponse(ReadingAnnualMedian $annualMedian, ...$readings): SuspiciousReadingsResponse
    {
        $response = new SuspiciousReadingsResponse();
        /** @var Reading $reading */
        foreach($readings as $reading){
            $response->add($reading, $annualMedian);
        }
        return $response;
    }

}
