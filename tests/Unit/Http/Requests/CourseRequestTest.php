<?php

namespace Tests\Unit\Http\Requests;

use App\Http\Requests\CourseRequest;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CourseRequestTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    /**
     * @var array|string[]
     */
    private $rules;
    private $validator;

    public function setUp(): void
    {
        parent::setUp();
        $this->rules = (new CourseRequest())->rules();
        $this->validator = $this->app['validator'];
    }

    /** @test */
    public function validate_name_course()
    {
        $this->assertFalse($this->validateField('name', ''));
        $this->assertFalse($this->validateField('name', 'na'));
        $this->assertFalse($this->validateField('name', $this->faker->text()));
        $this->assertTrue($this->validateField('name', 'Herramientas ofimáticas'));
    }

    /** @test */
    public function validate_description_course()
    {
        $this->assertFalse($this->validateField('description', 'de'));
        $this->assertFalse($this->validateField('description', $this->faker->text(300)));
        $this->assertTrue($this->validateField('description', $this->faker->text(100)));
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
