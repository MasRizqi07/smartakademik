<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;

class SchoolTimezoneTest extends TestCase
{
    protected function tearDown(): void
    {
        Carbon::setTestNow();
        parent::tearDown();
    }

    public function test_school_timezone_is_configured_to_asia_jakarta(): void
    {
        $this->assertSame('Asia/Jakarta', config('app.timezone'));

        Carbon::setTestNow(Carbon::parse('2026-10-12 23:30:00', 'UTC'));
        $this->assertSame('2026-10-13', today()->toDateString());

        Carbon::setTestNow();
    }
}
