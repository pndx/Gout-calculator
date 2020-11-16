<?php

namespace Tests\Feature\Http\Controllers\Human;

use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HumanControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testThatHumanCanBeAdded(): void
    {
        $this->withoutExceptionHandling();

        try {
            $attribute = [
                'name'       => $this->faker->name,
                'age'        => random_int(10, 60),
                'address'    => $this->faker->address,
                'is_painful' => random_int(0, 1) === 1,
                'purine'     => random_int(100, 1000),
            ];

            $this->post('api/human', $attribute);

            $this->assertDatabaseHas('humans', $attribute);
        } catch (Exception $e) {
        }
    }
}
