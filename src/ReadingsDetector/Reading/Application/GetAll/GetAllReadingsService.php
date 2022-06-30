<?php

namespace Src\ReadingsDetector\Reading\Application\GetAll;

use Src\ReadingsDetector\Reading\Domain\Collection\ReadingCollection;
use Src\ReadingsDetector\Reading\Domain\Contract\ReadingRepositoryInterface;

final class GetAllReadingsService
{
    public function __construct(private ReadingRepositoryInterface $repository){ }

    public function __invoke(): ReadingCollection
    {
        return $this->repository->getAll();
    }
}
