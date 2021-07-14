<?php

namespace Tests\Feature\Http\Controllers\Auth;

use App\User;
use Spatie\Permission\Models\Role;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function login_displays_the_login_form()
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    /** @test */
    public function login_display_validation_erros()
    {
        $response = $this->post(route('login'), []);
        $response->assertStatus(302);
        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function login_authenticates_and_redirects_user()
    {
        $user = factory(User::class)->create();
        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertRedirect(route('home'));
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function register_creates_and_authenticates_a_user()
    {
        Role::create(['name' => 'beneficiaries']);
        $data = [
            "document_type" => "CÉDULA DE CIUDADANÍA",
            "document" => "549846566",
            "expedition_place" => "Un lugar",
            "name" => "Test",
            "last_name" => "Register",
            "sex" => "FEMENINO",
            "birth_date" => "2021-05-30",
            "place_of_birth" => "otro lugar",
            "address" => "una dirección",
            "neighborhood" => "un barrio",
            "phone" => "5786755",
            "cellphone" => "5674567456",
            "email" => "test-register@mail.com",
            "occupation" => "una ocupación",
            "ethnic_group" => "NO PERTENECE A NINGUNO DE LOS ANTERIORES",
            "other_ethnic_group" => null,
            "stratum" => "4",
            "password" => "UnaContrasena25*",
            "password_confirmation" => "UnaContrasena25*",
        ];

        $response = $this->post(route('register'), $data);

        $this->assertDatabaseHas('users', [
            'name' => 'TEST REGISTER',
            'email' => 'test-register@mail.com'
        ]);
        $response->assertRedirect(route('home'));
    }
}
