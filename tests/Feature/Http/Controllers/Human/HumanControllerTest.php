<?php

namespace Tests\Feature\Http\Controllers\Human;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HumanControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testThatHumanCanBeAdded()
    {
        $this->withoutExceptionHandling();
        
        $attribute = [
            'name'       => $this->faker->name,
            'age'        => rand(10, 60),
            'address'    => $this->faker->address,
            'is_painful' => rand(0, 1) === 1,
            'purine'     => rand(100, 1000),
        ];

        $this->post('api/human', $attribute);

        $this->assertDatabaseHas('humans', $attribute);
    }
}
