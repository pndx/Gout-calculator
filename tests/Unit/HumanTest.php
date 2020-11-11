<?php

namespace Tests\Unit;

use App\Http\Controllers\HumanController;
use App\Models\Human;
use PHPUnit\Framework\TestCase;

class HumanTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    // public function human_can_eat()
    // {
    // 	$stub = $this->createMock(HumanController::class);

    // 	$stub->method('eat')->willReturn(true);

    // 	$this->assertEquals(true, $stub->eat());
    // }

    // public function can_get_human_list()
    // {
    // 	$human = factory(Human::class)->make();
    // 	$mock = $this->createMock(HumanController::class);
    // 	$mock->shouldReceive('index')->andReturn($human);
    	
    // }
}
