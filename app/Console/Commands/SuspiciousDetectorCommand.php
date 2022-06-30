<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Src\ReadingsDetector\Reading\Application\GetSuspicious\GetSuspiciousReadingsService;
use Src\ReadingsDetector\Reading\Infrastructure\InMemoryReadingRepository;

class SuspiciousDetectorCommand extends Command
{

    protected $signature = 'suspicious:detector {nameFile}';
    protected $description = 'Command description';


    public function handle(): void
    {
        $nameFile = $this->argument('nameFile');

        $this->info('File name input: ' . $nameFile);

        $inMemoryReadingRepository = new InMemoryReadingRepository();
        $service = new GetSuspiciousReadingsService($inMemoryReadingRepository);
        $service->__invoke();
    }
}
