<?php

namespace Src\ReadingsDetector\Reading\Application\GetSuspicious;

use Src\ReadingsDetector\Reading\Domain\Collection\AnnualMedianByClientCollection;
use Src\ReadingsDetector\Reading\Domain\Collection\ReadingCollection;
use Src\ReadingsDetector\Reading\Domain\Contract\ReadingRepositoryInterface;
use Src\ReadingsDetector\Reading\Domain\Entity\Reading;
use Src\ReadingsDetector\Reading\Domain\Exception\ClientAnnualMedianNotFoundException;
use Src\ReadingsDetector\Reading\Domain\ValueObject\ReadingAnnualMedian;

final class GetSuspiciousReadingsService
{
    private const SUSPICIOUS_PERCENTAGE_MARGIN = 50;

    public function __construct(private ReadingRepositoryInterface $repository){ }

    /** * @throws ClientAnnualMedianNotFoundException */
    public function __invoke() : SuspiciousReadingsResponse
    {
        $allReadings           = $this->repository->getAll();
        $annualMediansByClient = $this->repository->getAnnualMediansByClient();
        return $this->getResponse($allReadings, $annualMediansByClient);
    }

    /** * @throws ClientAnnualMedianNotFoundException */
    private function getResponse(ReadingCollection $collection,
        AnnualMedianByClientCollection $annualMediansByClient) : SuspiciousReadingsResponse
    {
        $result = new SuspiciousReadingsResponse();
        /** @var Reading $reading */
        foreach($collection as $reading){
            $median = $annualMediansByClient->getByClientId($reading->clientId());
            if($this->checkIsSuspicious($reading, $median)){
                $result->add($reading, $median);
            }
        }
        return $result;
    }

    private function checkIsSuspicious(Reading $reading, ReadingAnnualMedian $annualMedian) : bool
    {
        return
            $reading->count()->value() > $annualMedian->maxMarginByPercentage(self::SUSPICIOUS_PERCENTAGE_MARGIN) ||
            $reading->count()->value() < $annualMedian->minMarginByPercentage(self::SUSPICIOUS_PERCENTAGE_MARGIN);
    }
}
