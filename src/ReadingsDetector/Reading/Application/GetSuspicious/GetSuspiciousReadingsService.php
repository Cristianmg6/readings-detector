<?php

namespace Src\ReadingsDetector\Reading\Application\GetSuspicious;

use Src\ReadingsDetector\Reading\Domain\Collection\AnnualAverageByClientCollection;
use Src\ReadingsDetector\Reading\Domain\Collection\ReadingCollection;
use Src\ReadingsDetector\Reading\Domain\Contract\ReadingRepositoryInterface;
use Src\ReadingsDetector\Reading\Domain\Entity\Reading;
use Src\ReadingsDetector\Reading\Domain\Exception\ClientAnnualAverageNotFoundException;
use Src\ReadingsDetector\Reading\Domain\Exception\SuspiciousTypeException;
use Src\ReadingsDetector\Reading\Domain\ValueObject\SuspiciousType;

final class GetSuspiciousReadingsService
{

    public function __construct(private ReadingRepositoryInterface $repository, private string $type){ }

    /** * @throws ClientAnnualAverageNotFoundException
     * @throws SuspiciousTypeException
     */
    public function __invoke() : SuspiciousReadingsResponse
    {
        $suspiciousType = new SuspiciousType($this->type);
        $allReadings    = $this->repository->getAll();
        $values         = $this->getValuesBySuspiciousType($suspiciousType);
        return $this->getResponse($allReadings, $values, $suspiciousType);
    }

    private function getValuesBySuspiciousType(SuspiciousType $suspiciousType) : AnnualAverageByClientCollection
    {
        return match ($suspiciousType->value()) {
            'average' => $this->repository->getAnnualAveragesByClient(),
            'median' => null
        };
    }

    /** * @throws ClientAnnualAverageNotFoundException */
    private function getResponse(ReadingCollection $collection, AnnualAverageByClientCollection $annualAveragesByClient,
        SuspiciousType $suspiciousType) : SuspiciousReadingsResponse
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
