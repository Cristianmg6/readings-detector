<?php

namespace Src\ReadingsDetector\Reading\Application\GetSuspicious;

use Src\ReadingsDetector\Reading\Application\GetAll\GetAllReadingsService;
use Src\ReadingsDetector\Reading\Domain\Collection\ReadingCollection;
use Src\ReadingsDetector\Reading\Domain\Contract\ReadingRepositoryInterface;
use Src\ReadingsDetector\Reading\Domain\Entity\Reading;
use Src\ReadingsDetector\Reading\Domain\Service\CalculateAnnualMedianReadingService;
use Src\ReadingsDetector\Reading\Domain\ValueObject\ReadingAnnualMedian;

final class GetSuspiciousReadingsService
{
    private const SUSPICIOUS_PERCENTAGE_MARGIN = 50;

    private GetAllReadingsService $getAllReadingsService;
    private CalculateAnnualMedianReadingService $calculateAnnualMedianReadingService;

    public function __construct(private ReadingRepositoryInterface $repository){
        $this->getAllReadingsService = new GetAllReadingsService($this->repository);
        $this->calculateAnnualMedianReadingService = new CalculateAnnualMedianReadingService();
    }

    public function __invoke(): ReadingCollection
    {
        $allReadings = $this->getAllReadingsService->__invoke();
        return $this->filterByMedian($allReadings);
    }

    private function filterByMedian(ReadingCollection $collection): ReadingCollection
    {
        $result = new ReadingCollection();
        $annualMedian = $this->calculateAnnualMedianReadingService->__invoke($collection);

        /** @var Reading $reading */
        foreach($collection as $reading)
        {
            if($this->checkIsSuspicious($reading, $annualMedian)){
                $result->addReading($reading);
            }
        }

        return $result;
    }

    private function checkIsSuspicious(Reading $reading, ReadingAnnualMedian $annualMedian): bool
    {
        return
            $reading->count()->value() > $annualMedian->maxMarginByPercentage(self::SUSPICIOUS_PERCENTAGE_MARGIN) ||
            $reading->count()->value() < $annualMedian->minMarginByPercentage(self::SUSPICIOUS_PERCENTAGE_MARGIN);
    }
}
