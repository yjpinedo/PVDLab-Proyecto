<?php

namespace Tests\Unit\Http\Requests;

use App\Http\Requests\LessonRequest;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LessonRequestTest extends TestCase
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
        $this->rules = (new LessonRequest())->rules();
        $this->validator = $this->app['validator'];
    }

    /** @test */
    public function validate_date_lesson()
    {
        $this->assertFalse($this->validateField('date', ''));
        $this->assertFalse($this->validateField('date', 'OPCION'));
        $this->assertFalse($this->validateField('date', '18-07-2000'));
        $this->assertTrue($this->validateField('date', '18-07-2025'));
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
