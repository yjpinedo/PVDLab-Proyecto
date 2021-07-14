<?php

namespace Tests\Unit\Http\Requests;

use App\Http\Requests\EmployeeRequest;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployeeRequestTest extends TestCase
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
        $this->rules = (new EmployeeRequest())->rules();
        $this->validator = $this->app['validator'];
    }

    /** @test */
    public function validate_document_type_employee()
    {
        $this->assertFalse($this->validateField('document_type', ''));
        $this->assertTrue($this->validateField('document_type', 'Documento'));
    }

    /** @test */
    public function validate_document_employee()
    {
        $this->assertFalse($this->validateField('document', ''));
        $this->assertFalse($this->validateField('document', 'Documento'));
        $this->assertFalse($this->validateField('document', $this->faker->numberBetween(0,2)));
        $this->assertFalse($this->validateField('document', 1234567897894));
        $this->assertTrue($this->validateField('document', 1065887969));
    }

    /** @test */
    public function validate_expedition_place_employee()
    {
        $this->assertFalse($this->validateField('expedition_place', ''));
        $this->assertFalse($this->validateField('expedition_place', 'Va'));
        $this->assertFalse($this->validateField('expedition_place', $this->faker->text(100)));
        $this->assertTrue($this->validateField('expedition_place', 'Valledupar'));
    }

    /** @test */
    public function validate_name_employee()
    {
        $this->assertFalse($this->validateField('name', ''));
        $this->assertFalse($this->validateField('name', 'Al'));
        $this->assertFalse($this->validateField('name', $this->faker->text(100)));
        $this->assertTrue($this->validateField('name', 'Alejandra'));
    }

    /** @test */
    public function validate_last_name_employee()
    {
        $this->assertFalse($this->validateField('last_name', ''));
        $this->assertFalse($this->validateField('last_name', 'Al'));
        $this->assertFalse($this->validateField('last_name', $this->faker->text(100)));
        $this->assertTrue($this->validateField('last_name', 'Alejandra'));
    }

    /** @test */
    public function validate_sex_employee()
    {
        $this->assertFalse($this->validateField('sex', ''));
        $this->assertFalse($this->validateField('sex', 'OPCION'));
        $this->assertTrue($this->validateField('sex', 'FEMENINO'));
    }

    /** @test */
    public function validate_birth_date_employee()
    {
        $this->assertFalse($this->validateField('birth_date', ''));
        $this->assertFalse($this->validateField('birth_date', 'OPCION'));
        $this->assertFalse($this->validateField('birth_date', '18-07-2025'));
        $this->assertTrue($this->validateField('birth_date', '18-07-2000'));
    }

    /** @test */
    public function validate_place_of_birth_employee()
    {
        $this->assertFalse($this->validateField('place_of_birth', ''));
        $this->assertFalse($this->validateField('place_of_birth', 'Va'));
        $this->assertFalse($this->validateField('place_of_birth', $this->faker->text(100)));
        $this->assertTrue($this->validateField('place_of_birth', 'Valledupar'));
    }

    /** @test */
    public function validate_address_employee()
    {
        $this->assertFalse($this->validateField('address', ''));
        $this->assertFalse($this->validateField('address', 'Va'));
        $this->assertFalse($this->validateField('address', $this->faker->text(100)));
        $this->assertTrue($this->validateField('address', 'Valledupar'));
    }

    /** @test */
    public function validate_neighborhood_employee()
    {
        $this->assertFalse($this->validateField('neighborhood', ''));
        $this->assertFalse($this->validateField('neighborhood', 'Va'));
        $this->assertFalse($this->validateField('neighborhood', $this->faker->text(100)));
        $this->assertTrue($this->validateField('neighborhood', 'Valledupar'));
    }

    /** @test */
    public function validate_cellphone_employee()
    {
        $this->assertFalse($this->validateField('cellphone', ''));
        $this->assertFalse($this->validateField('cellphone', 'Documento'));
        $this->assertFalse($this->validateField('cellphone', 12));
        $this->assertFalse($this->validateField('cellphone', 1234567897894));
        $this->assertTrue($this->validateField('cellphone', 3204897755));
    }

    /** @test */
    public function validate_phone_employee()
    {
        $this->assertFalse($this->validateField('phone', 'Documento'));
        $this->assertFalse($this->validateField('phone', 12));
        $this->assertFalse($this->validateField('phone', 1234567897894));
        $this->assertTrue($this->validateField('phone', 6598332));
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
