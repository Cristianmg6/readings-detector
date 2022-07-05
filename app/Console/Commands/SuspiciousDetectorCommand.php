<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Src\ReadingsDetector\Reading\Application\GetSuspicious\GetSuspiciousReadingsService;
use Src\ReadingsDetector\Reading\Domain\Exception\FileException;
use Src\ReadingsDetector\Reading\Infrastructure\FileRepository\FileReadingRepository;
use Throwable;

class SuspiciousDetectorCommand extends Command
{
    private const NAME_FILE_ARGUMENT_NAME = 'nameFile';
    private const RESULT_TABLE_HEADERS    = ['Client', 'Month', 'Suspicious', "Average"];
    private const PATH_TO_DATA_FILES      = 'storage/data/';

    protected $signature   = 'suspicious:detector {'.self::NAME_FILE_ARGUMENT_NAME.'}';
    protected $description = 'Detect suspicious readings and print a table with the results.';

    public function handle() : void
    {
        $nameFile = $this->argument(self::NAME_FILE_ARGUMENT_NAME);
        try{
            $repository = new FileReadingRepository(self::PATH_TO_DATA_FILES.$nameFile);
            $service    = new GetSuspiciousReadingsService($repository);
            $result     = $service->__invoke();
            $this->printResultsTable($result->values());
        }catch(FileException $e){
            $this->info($e->getMessage());
        }catch(Throwable $e){
            $this->info($e->getMessage());
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
