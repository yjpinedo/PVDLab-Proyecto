<?php

namespace Tests\Unit\Http\Requests;

use App\Http\Requests\CategoryRequest;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryRequestTest extends TestCase
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
        $this->rules = (new CategoryRequest())->rules();
        $this->validator = $this->app['validator'];
    }

    /** @test */
    public function validate_name_category()
    {
        $this->assertFalse($this->validateField('name', ''));
        $this->assertFalse($this->validateField('name', 'na'));
        $this->assertFalse($this->validateField('name', $this->faker->text()));
        $this->assertTrue($this->validateField('name', 'Monitores'));
    }

    /** @test */
    public function validate_description_category()
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
