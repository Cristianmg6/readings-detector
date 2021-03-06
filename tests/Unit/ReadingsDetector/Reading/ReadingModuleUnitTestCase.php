<?php

namespace Tests\Unit\ReadingsDetector\Reading;

use Mockery\MockInterface;
use Src\ReadingsDetector\Reading\Domain\Collection\AnnualAverageByClientCollection;
use Src\ReadingsDetector\Reading\Domain\Collection\ReadingCollection;
use Src\ReadingsDetector\Reading\Domain\Contract\ReadingRepositoryInterface;
use Tests\TestCase;

class ReadingModuleUnitTestCase extends TestCase
{
    private ReadingRepositoryInterface|MockInterface $repository;

    protected function setUp() : void
    {
        parent::setUp();
        $this->repository = $this->mock(ReadingRepositoryInterface::class);
    }

    protected function readingRepository() : ReadingRepositoryInterface|MockInterface
    {
        return $this->repository;
    }

    protected function shouldGetAllReadings(ReadingCollection $collection) : void
    {
        $this->readingRepository()
            ->shouldReceive('getAll')
            ->andReturn($collection);
    }

    protected function shouldGetAnnualAveragesByClient(AnnualAverageByClientCollection $annualAverageCollection)
    {
        $this->readingRepository()
            ->shouldReceive('getAnnualAveragesByClient')
            ->andReturn($annualAverageCollection);
    }

}
