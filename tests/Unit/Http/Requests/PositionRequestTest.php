<?php

namespace Tests\Unit\Http\Requests;

use App\Http\Requests\PositionRequest;
use Symfony\Component\HttpFoundation\Request;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PositionRequestTest extends TestCase
{
    use WithFaker;
    /**
     * @var array|string[]
     */
    private $rules;
    private $validator;

    public function setUp(): void
    {
        parent::setUp();
        $this->rules = (new PositionRequest())->rules();
        $this->validator = $this->app['validator'];
    }

    /** @test */
    public function validate_name_position()
    {
        $this->assertFalse($this->validateField('name', ''));
        $this->assertFalse($this->validateField('name', 'na'));
        $this->assertFalse($this->validateField('name', 'nanananananananananananananananananananananananananananananananananananananananana'));
        $this->assertTrue($this->validateField('name', 'Gerente'));
    }

    /** @test */
    public function validate_description_position()
    {
        $this->assertFalse($this->validateField('description', 'de'));
        $this->assertFalse($this->validateField('description', $this->faker->text(300)));
        $this->assertTrue($this->validateField('description', $this->faker->text()));
    }

    protected function getFieldValidator($field, $value)
    {
        return $this->validator->make(
            [$field => $value],
            [$field => $this->rules[$field]]
        );
    }

    protected function validateField($field, $value)
    {
        return $this->getFieldValidator($field, $value)->passes();
    }
}
