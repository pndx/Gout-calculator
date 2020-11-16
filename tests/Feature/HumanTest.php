<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HumanTest extends TestCase
{
    use RefreshDatabase;

    public function testThatAHumanCanBeAdded()
    {
        $human = Human::factory()->create();
        
    }
}
