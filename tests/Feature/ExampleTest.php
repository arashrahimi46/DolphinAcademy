<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/dadsfdsfsdfsdfs');

        $response->dumpHeaders();

        $response->dumpSession();

        $response->dump();
        $response->assertStatus(200);
    }
    public function testMyFirstApp()
    {
        $this->assertTrue(true);
    }
}
