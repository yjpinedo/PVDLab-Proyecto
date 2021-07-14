<?php

namespace Tests\Unit\Http\Requests;

use App\Http\Requests\MemberRequest;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MemberRequestTest extends TestCase
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
        $this->rules = (new MemberRequest())->rules();
        $this->validator = $this->app['validator'];
    }

    /** @test */
    public function validate_document_type_member()
    {
        $this->assertFalse($this->validateField('document_type', ''));
        $this->assertTrue($this->validateField('document_type', 'Documento'));
    }

    /** @test */
    public function validate_document_member()
    {
        $this->assertFalse($this->validateField('document', ''));
        $this->assertFalse($this->validateField('document', 'Documento'));
        $this->assertFalse($this->validateField('document', $this->faker->numberBetween(0,2)));
        $this->assertFalse($this->validateField('document', 1234567897894));
        $this->assertTrue($this->validateField('document', 1065887969));
    }

    /** @test */
    public function validate_name_member()
    {
        $this->assertFalse($this->validateField('name', ''));
        $this->assertFalse($this->validateField('name', 'Al'));
        $this->assertFalse($this->validateField('name', $this->faker->text(100)));
        $this->assertTrue($this->validateField('name', 'Alejandra'));
    }

    /** @test */
    public function validate_last_name_member()
    {
        $this->assertFalse($this->validateField('last_name', ''));
        $this->assertFalse($this->validateField('last_name', 'Al'));
        $this->assertFalse($this->validateField('last_name', $this->faker->text(100)));
        $this->assertTrue($this->validateField('last_name', 'Alejandra'));
    }

    /** @test */
    public function validate_sex_member()
    {
        $this->assertFalse($this->validateField('sex', ''));
        $this->assertFalse($this->validateField('sex', 'OPCION'));
        $this->assertTrue($this->validateField('sex', 'FEMENINO'));
    }

    /** @test */
    public function validate_birth_date_member()
    {
        $this->assertFalse($this->validateField('birth_date', ''));
        $this->assertFalse($this->validateField('birth_date', 'OPCION'));
        $this->assertFalse($this->validateField('birth_date', '18-07-2025'));
        $this->assertTrue($this->validateField('birth_date', '18-07-2000'));
    }

    /** @test */
    public function validate_place_of_birth_member()
    {
        $this->assertFalse($this->validateField('place_of_birth', ''));
        $this->assertFalse($this->validateField('place_of_birth', 'Va'));
        $this->assertFalse($this->validateField('place_of_birth', $this->faker->text(100)));
        $this->assertTrue($this->validateField('place_of_birth', 'Valledupar'));
    }

    /** @test */
    public function validate_address_member()
    {
        $this->assertFalse($this->validateField('address', ''));
        $this->assertFalse($this->validateField('address', 'Va'));
        $this->assertFalse($this->validateField('address', $this->faker->text(100)));
        $this->assertTrue($this->validateField('address', 'Valledupar'));
    }

    /** @test */
    public function validate_neighborhood_member()
    {
        $this->assertFalse($this->validateField('neighborhood', ''));
        $this->assertFalse($this->validateField('neighborhood', 'Va'));
        $this->assertFalse($this->validateField('neighborhood', $this->faker->text(100)));
        $this->assertTrue($this->validateField('neighborhood', 'Valledupar'));
    }

    /** @test */
    public function validate_cellphone_member()
    {
        $this->assertFalse($this->validateField('cellphone', 'Documento'));
        $this->assertFalse($this->validateField('cellphone', 12));
        $this->assertFalse($this->validateField('cellphone', 1234567897894));
        $this->assertTrue($this->validateField('cellphone', 3204897755));
    }

    /** @test */
    public function validate_phone_member()
    {
        $this->assertFalse($this->validateField('phone', 'Documento'));
        $this->assertFalse($this->validateField('phone', 12));
        $this->assertFalse($this->validateField('phone', 1234567897894));
        $this->assertTrue($this->validateField('phone', 6598332));
    }

    /** @test */
    public function validate_occupation_member()
    {
        $this->assertFalse($this->validateField('occupation', 'Va'));
        $this->assertFalse($this->validateField('occupation', $this->faker->text(500)));
        $this->assertTrue($this->validateField('occupation', 'Fisioterapeuta'));
    }

    /** @test */
    public function validate_ethnic_group_member()
    {
        $this->assertFalse($this->validateField('ethnic_group', ''));
        $this->assertFalse($this->validateField('ethnic_group', 'OPCION'));
        $this->assertTrue($this->validateField('ethnic_group', 'NO PERTENECE A NINGUNO DE LOS ANTERIORES'));
    }

    /** @test */
    public function validate_other_ethnic_group_member()
    {
        $this->assertFalse($this->validateField('other_ethnic_group', $this->faker->text()));
        $this->assertTrue($this->validateField('other_ethnic_group', 'Grupo étnico'));
    }

    /** @test */
    public function validate_stratum_member()
    {
        $this->assertFalse($this->validateField('stratum', 'OPCION'));
        $this->assertTrue($this->validateField('stratum', '4'));
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
