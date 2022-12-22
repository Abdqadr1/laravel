<?php

namespace Tests\Unit;

use App\Http\Service\EmployeeService;
use Tests\TestCase;


class RateLimitTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_rate_limit()
    {
        for ($i = 0; $i < 6; $i++) {
            EmployeeService::testRateLimit();
        }
        $this->assertTrue(true);
    }
}
