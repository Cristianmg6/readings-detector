<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use Src\ReadingsDetector\Reading\Application\GetSuspicious\GetSuspiciousReadingsService;
use Src\ReadingsDetector\Reading\Infrastructure\InMemoryReadingRepository;
use Throwable;

class SuspiciousDetectorCommand extends Command
{
    private const NAME_FILE_ARGUMENT_NAME = 'nameFile';
    private const RESULT_TABLE_HEADERS = ['Client', 'Month', 'Suspicious', "Median"];

    protected $signature = 'suspicious:detector {'. self::NAME_FILE_ARGUMENT_NAME .'}';
    protected $description = 'Detect suspicious readings and print a table with the results.';


    public function handle(): void
    {
        $nameFile = $this->argument(self::NAME_FILE_ARGUMENT_NAME);

        $this->info('File name input: ' . $nameFile);

        try{
            $inMemoryReadingRepository = new InMemoryReadingRepository();
            $service = new GetSuspiciousReadingsService($inMemoryReadingRepository);
            $result = $service->__invoke();
            $this->printResultsTable($result->values());
        }catch(Throwable $e){
            $this->info($e->getMessage());
        }

    }

    private function printResultsTable(array $rows): void
    {
        $this->table(
            self::RESULT_TABLE_HEADERS,
            $rows
        );
    }
}
