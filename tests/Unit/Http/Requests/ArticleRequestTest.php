<?php

namespace Tests\Unit\Http\Requests;

use App\Http\Requests\ArticleRequest;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleRequestTest extends TestCase
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
        $this->rules = (new ArticleRequest())->rules();
        $this->validator = $this->app['validator'];
    }

    /** @test */
    public function validate_name_article()
    {
        $this->assertFalse($this->validateField('name', ''));
        $this->assertFalse($this->validateField('name', 'A'));
        $this->assertFalse($this->validateField('name', $this->faker->text(60)));
        $this->assertTrue($this->validateField('name', 'Artículo'));
    }

    /** @test */
    public function validate_brand_article()
    {
        $this->assertFalse($this->validateField('brand', ''));
        $this->assertFalse($this->validateField('brand', 'Ma'));
        $this->assertFalse($this->validateField('brand', $this->faker->text(60)));
        $this->assertTrue($this->validateField('brand', 'Marca'));
    }

    /** @test */
    public function validate_pattern_article()
    {
        $this->assertFalse($this->validateField('pattern', ''));
        $this->assertFalse($this->validateField('pattern', 'Mo'));
        $this->assertFalse($this->validateField('pattern', $this->faker->text(100)));
        $this->assertTrue($this->validateField('pattern', $this->faker->text(40)));
    }

    /** @test */
    public function validate_description_article()
    {
        $this->assertFalse($this->validateField('description', 'de'));
        $this->assertFalse($this->validateField('description', $this->faker->text(600)));
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
