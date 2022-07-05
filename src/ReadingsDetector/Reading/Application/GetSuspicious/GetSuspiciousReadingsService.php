<?php

namespace Src\ReadingsDetector\Reading\Application\GetSuspicious;

use Src\ReadingsDetector\Reading\Domain\Collection\AnnualAverageByClientCollection;
use Src\ReadingsDetector\Reading\Domain\Collection\ReadingCollection;
use Src\ReadingsDetector\Reading\Domain\Contract\ReadingRepositoryInterface;
use Src\ReadingsDetector\Reading\Domain\Entity\Reading;
use Src\ReadingsDetector\Reading\Domain\Exception\ClientAnnualAverageNotFoundException;

final class GetSuspiciousReadingsService
{

    public function __construct(private ReadingRepositoryInterface $repository){ }

    /** * @throws ClientAnnualAverageNotFoundException */
    public function __invoke() : SuspiciousReadingsResponse
    {
        $allReadings           = $this->repository->getAll();
        $annualAveragesByClient = $this->repository->getAnnualAveragesByClient();
        return $this->getResponse($allReadings, $annualAveragesByClient);
    }

    /** * @throws ClientAnnualAverageNotFoundException */
    private function getResponse(ReadingCollection $collection,
        AnnualAverageByClientCollection $annualAveragesByClient) : SuspiciousReadingsResponse
    {
        $result = new SuspiciousReadingsResponse();
        /** @var Reading $reading */
        foreach($collection as $reading){
            $average = $annualAveragesByClient->getByClientId($reading->clientId());
            if($reading->isSuspicious($average)){
                $result->add($reading, $average);
            }
        }
        return $result;
    }

}
