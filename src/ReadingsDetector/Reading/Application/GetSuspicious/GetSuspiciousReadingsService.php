<?php

namespace Src\ReadingsDetector\Reading\Application\GetSuspicious;

use Src\ReadingsDetector\Reading\Domain\Collection\AnnualMedianByClientCollection;
use Src\ReadingsDetector\Reading\Domain\Collection\ReadingCollection;
use Src\ReadingsDetector\Reading\Domain\Contract\ReadingRepositoryInterface;
use Src\ReadingsDetector\Reading\Domain\Entity\Reading;
use Src\ReadingsDetector\Reading\Domain\Exception\ClientAnnualMedianNotFoundException;

final class GetSuspiciousReadingsService
{

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
            if($reading->isSuspicious($median)){
                $result->add($reading, $median);
            }
        }
        return $result;
    }

}
