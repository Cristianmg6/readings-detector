<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use Src\ReadingsDetector\Reading\Application\GetSuspicious\GetSuspiciousReadingsService;
use Src\ReadingsDetector\Reading\Infrastructure\InMemoryReadingRepository;
use Throwable;

class SuspiciousDetectorCommand extends Command
{

    protected $signature = 'suspicious:detector {nameFile}';
    protected $description = 'Command description';


    public function handle(): void
    {
        $nameFile = $this->argument('nameFile');

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

    private function printResultsTable(array $results): void
    {
        $this->table(
            ['Client', 'Month', 'Suspicious', "Median"],
            $results
        );
    }
}
