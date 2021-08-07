<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /** @test **/
    public function aunthenticated_user_info_can_be_fetched()
    {
        $this->withoutExceptionHandling();
        Sanctum::actingAs($this->user);

        $response = $this->get('/api/user');

        $response->assertOk();

        $response->assertJson([
            'data' => [
                'type' => 'users',
                'id' => $this->user->id,
                'attributes' => [
                    'name' => $this->user->name,
                    'email' => $this->user->email,
                    'created_at' => $this->user->created_at->diffForHumans(),
                ],
            ],
            'links' => [
                'self' => $this->user->path()
            ]
        ]);
    }
}
