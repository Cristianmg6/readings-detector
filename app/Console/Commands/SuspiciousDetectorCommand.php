<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SuspiciousDetectorCommand extends Command
{

    protected $signature = 'suspicious:detector {nameFile}';
    protected $description = 'Command description';


    public function handle(): void
    {
        $nameFile = $this->argument('nameFile');

        $this->info('File name input: ' . $nameFile);
    }
}
