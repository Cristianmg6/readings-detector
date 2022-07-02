<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use League\Csv\Exception as CsvException;
use Src\ReadingsDetector\Reading\Application\GetSuspicious\GetSuspiciousReadingsService;
use Src\ReadingsDetector\Reading\Domain\Contract\ReadingRepositoryInterface;
use Src\ReadingsDetector\Reading\Infrastructure\Repository\CsvFileReadingRepository;
use Src\ReadingsDetector\Reading\Infrastructure\Repository\InMemoryReadingRepository;
use Throwable;

class SuspiciousDetectorCommand extends Command
{
    private const NAME_FILE_ARGUMENT_NAME = 'nameFile';
    private const RESULT_TABLE_HEADERS    = ['Client', 'Month', 'Suspicious', "Median"];
    private const PATH_TO_DATA_FILES      = 'storage/data/';

    protected $signature   = 'suspicious:detector {'.self::NAME_FILE_ARGUMENT_NAME.'?}';
    protected $description = 'Detect suspicious readings and print a table with the results.';

    public function handle() : void
    {
        $nameFile = $this->argument(self::NAME_FILE_ARGUMENT_NAME);
        try{
            $repository = $this->getRepositoryImplementationByFileArgument($nameFile);
            $service    = new GetSuspiciousReadingsService($repository);
            $result     = $service->__invoke();
            $this->printResultsTable($result->values());
        }catch(CsvException $e){
            $this->info("CSV File Error: ".$e->getMessage());
        }catch(Throwable $e){
            $this->info($e->getMessage());
        }
    }

    /** * @throws CsvException */
    private function getRepositoryImplementationByFileArgument(?string $nameFile) : ReadingRepositoryInterface
    {
        if(null === $nameFile){
            return new InMemoryReadingRepository();
        }else{
            return new CsvFileReadingRepository(self::PATH_TO_DATA_FILES.$nameFile);
        }
    }

    private function printResultsTable(array $rows) : void
    {
        $this->table(
            self::RESULT_TABLE_HEADERS,
            $rows
        );
    }
}
