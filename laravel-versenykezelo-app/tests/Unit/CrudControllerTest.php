<?php

namespace Tests\Unit;

use App\Models\Participant;
use App\Models\Round;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @method get(string $string)
 */
class CrudControllerTest extends TestCase
{
    use DatabaseTransactions;

    /** @test false url */
    public function it_redirects()
    {
        $response = $this->get('/nefunfuen');
        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    /** @test */
    public function it_registers_a_new_user()
    {
        $userData = [
            'nev' => 'test',
            'email' => 'test@email.com',
            'telefonszam' => '123456789',
            'lakcim' => '123 Main St',
            'szuletesi_ev' => 1990,
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->post('/register', $userData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', ['email' => 'john@example.com']);
    }

    /** @test */
    public function it_does_not_register_user_with_existing_email()
    {
        User::factory()->create(['email' => 'existing@example.com']);

        $userData = [
            'nev' => 'John Doe',
            'email' => 'existing@example.com',
            'telefonszam' => '123456789',
            'lakcim' => '123 Main St',
            'szuletesi_ev' => 1990,
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->post('/register', $userData);

        $response->assertStatus(400);
    }

    /** @test */
    public function it_authenticates_a_user()
    {
        $user = User::factory()->create(['email' => 'test@test.com', 'password' => bcrypt('password')]);

        $credentials = [
            'login_email' => 'test@test.com',
            'login_password' => 'password',
        ];

        $response = $this->post('/login', $credentials);

        $response->assertStatus(200);
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function it_does_not_authenticate_invalid_user()
    {
        $credentials = [
            'login_email' => 'nonexistent@example.com',
            'login_password' => 'password',
        ];

        $response = $this->post('/login', $credentials);

        $response->assertStatus(400);
        $this->assertGuest();
    }

    /** @test */
    public function it_logs_out_authenticated_user()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->post('/logout', ['logout' => 'logout']);

        $response->assertStatus(200);
        $this->assertGuest();
    }

    /** @test */
    public function it_does_not_log_out_unauthenticated_user()
    {
        $response = $this->post('/logout', ['logout' => 'logout']);

        $response->assertStatus(200);
        $this->assertGuest();
    }


}
