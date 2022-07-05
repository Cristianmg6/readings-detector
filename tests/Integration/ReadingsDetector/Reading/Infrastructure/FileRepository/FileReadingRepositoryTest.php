<?php

namespace Tests\Integration\ReadingsDetector\Reading\Infrastructure\FileRepository;

use Src\ReadingsDetector\Reading\Domain\Collection\AnnualAverageByClientCollection;
use Src\ReadingsDetector\Reading\Domain\Collection\ReadingCollection;
use Src\ReadingsDetector\Reading\Domain\Exception\FileException;
use Src\ReadingsDetector\Reading\Infrastructure\FileRepository\FileReadingRepository;
use Tests\TestCase;

final class FileReadingRepositoryTest extends TestCase
{

    public function setUp() : void
    {
        parent::setUp();
    }

    /**
     * @dataProvider dataPathsProvider
     * @param string $filePath
     * @test
     */
    public function get_all(string $filePath) : void
    {
        $repository = new FileReadingRepository($filePath);
        $result = $repository->getAll();
        $this->assertInstanceOf(ReadingCollection::class, $result);
    }

    /**
     * @dataProvider dataPathsProvider
     * @param string $filePath
     * @test
     */
    public function get_annual_averages_by_client(string $filePath) : void
    {
        $repository = new FileReadingRepository($filePath);
        $result = $repository->getAnnualAveragesByClient();
        $this->assertInstanceOf(AnnualAverageByClientCollection::class, $result);
    }

    /** @test */
    public function file_not_found(): void
    {
        $this->expectException(FileException::class);
        new FileReadingRepository('undefined');
    }

    /** @test */
    public function invalid_file_extension(): void
    {
        $this->expectException(FileException::class);
        new FileReadingRepository('storage/test/data/readings.cs');
    }

    /** @test */
    public function invalid_header_by_empty_file(): void
    {
        $this->expectException(FileException::class);
        new FileReadingRepository('storage/test/data/readings-empty.csv');
    }

    /** @test */
    public function empty_file_with_headers(): void
    {
        $this->expectException(FileException::class);
        new FileReadingRepository('storage/test/data/readings-only-headers.csv');
    }

    public function dataPathsProvider() : array
    {
        return [
            ['storage/test/data/readings.csv'],
            ['storage/test/data/readings.xml']
        ];
    }
}
