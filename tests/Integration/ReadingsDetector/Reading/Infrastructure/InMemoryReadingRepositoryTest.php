<?php

namespace Tests\Integration\ReadingsDetector\Reading\Infrastructure;

use Src\ReadingsDetector\Reading\Domain\Collection\AnnualMedianByClientCollection;
use Src\ReadingsDetector\Reading\Domain\Collection\ReadingCollection;
use Src\ReadingsDetector\Reading\Infrastructure\InMemoryReadingRepository;
use Tests\TestCase;

final class InMemoryReadingRepositoryTest extends TestCase
{
    private InMemoryReadingRepository $repository;

    public function setUp() : void
    {
        parent::setUp();
        $this->repository = new InMemoryReadingRepository();
    }

    /** @test */
    public function get_all(): void
    {
        $result = $this->repository->getAll();
        $this->assertInstanceOf(ReadingCollection::class, $result);
    }
    
    /** @test */
    public function get_annual_medians_by_client(): void
    {
        $result = $this->repository->getAnnualMediansByClient();
        $this->assertInstanceOf(AnnualMedianByClientCollection::class, $result);
    }
}
