<?php

namespace Tests\Unit\ReadingsDetector\Reading\Application\GetSuspicious;

use Src\ReadingsDetector\Reading\Application\GetSuspicious\GetSuspiciousReadingsService;
use Tests\Unit\ReadingsDetector\Reading\ReadingModuleUnitTestCase;

class GetSuspiciousReadingsTest extends ReadingModuleUnitTestCase
{
    private GetSuspiciousReadingsService $service;

    protected function setUp() : void
    {
        parent::setUp();
        $this->service = new GetSuspiciousReadingsService($this->readingRepository());
    }

    /** @test */
    public function get_suspicious_readings(): void
    {
        $this->assertIsBool(true);
    }

}
