<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Contact;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /** @test **/
    public function an_unauthenticated_user_should_be_redirected_to_login_page()
    {
        $response = $this->post('/api/contacts', $this->data());

        $response->assertRedirect('/login');
        $this->assertGuest();
        $this->assertCount(0, Contact::all());
    }

    /** @test **/
    public function an_authenticated_user_can_create_a_contact()
    {
        Sanctum::actingAs($this->user);

        $response = $this->post('/api/contacts', array_merge($this->data(), ['note' => 'Some Notes']));

        $response->assertCreated();

        $this->assertCount(1, Contact::all());
        $this->assertEquals($this->user->id, Contact::first()->user->id);
        $this->assertEquals("Test Name", Contact::first()->name);
        $this->assertEquals("test@email.com", Contact::first()->email);
        $this->assertEquals("123-123-1234", Contact::first()->cellphone);
        $this->assertEquals("01-31-1997", Contact::first()->birthdate->format('m-d-Y'));
        $this->assertEquals("Some Notes", Contact::first()->note);
    }

    /** @test **/
    public function some_fields_are_required()
    {
        Sanctum::actingAs($this->user);

        collect(['name', 'email', 'cellphone', 'birthdate'])->each(function ($field) {
            $response = $this->post('/api/contacts', array_merge($this->data(), [$field => '']));

            $response->assertSessionHasErrors($field);

            $this->assertCount(0, Contact::all());
        });
    }

    /** @test **/
    public function some_fields_can_be_null()
    {
        Sanctum::actingAs($this->user);

        collect(['note'])->each(function ($field) {
            $response = $this->post('/api/contacts', array_merge($this->data(), [$field => '']));

            $response->assertCreated();

            $this->assertCount(1, Contact::all());
        });
    }

    /** @test **/
    public function email_should_be_properly_formatted()
    {
        Sanctum::actingAs($this->user);

        $response = $this->post('/api/contacts', array_merge($this->data(), ['email' => 'NOT AN EMAIL']));

        $response->assertSessionHasErrors('email');

        $this->assertCount(0, Contact::all());
    }

    /** @test **/
    public function birthdate_is_a_proper_date()
    {
        Sanctum::actingAs($this->user);

        $this->post('/api/contacts', $this->data());

        $this->assertInstanceOf(Carbon::class, Contact::first()->birthdate);
        $this->assertEquals('01-31-1997', Contact::first()->birthdate->format('m-d-Y'));
    }

    /** @test **/
    public function only_the_user_can_retrieve_all_of_their_contacts()
    {
        Sanctum::actingAs($this->user);

        $anotherUser = User::factory()->create();

        Contact::factory()->create(['user_id' => $this->user->id]);
        Contact::factory()->count(2)->create(['user_id' => $anotherUser->id]);

        $response = $this->get('/api/contacts');

        $response->assertOk()
            ->assertJson([
                'data' => [
                    [
                        'data' => [
                            'id' => $this->user->id,
                        ]
                    ]
                ]
            ]);
    }

    /** @test **/
    public function a_specific_contact_can_be_retrieved()
    {
        Sanctum::actingAs($this->user);

        $contact = Contact::factory()->create(['user_id' => $this->user->id]);

        $response = $this->get('/api/contacts/' . $contact->id);

        $response->assertOk();
        $response->assertJson([
            'data' => [
                'type' => 'contacts',
                'id' => $contact->id,
                'attributes' => [
                    'user' => $this->user->name,
                    'name' => $contact->name,
                    'email' => $contact->email,
                    'cellphone' => $contact->cellphone,
                    'birthdate' => $contact->birthdate->format('jS F, Y'),
                    'note' => $contact->note,
                    'updated_at' => $contact->updated_at->diffForHumans()
                ],
            ],
            'links' => [
                'self' => $contact->path()
            ]
        ]);
    }

    /** @test **/
    public function only_the_user_can_retrieve_their_single_contact()
    {
        Sanctum::actingAs($this->user);
        $anotherUser = User::factory()->create();

        $contact = Contact::factory()->create(['user_id' => $anotherUser->id]);

        $response = $this->get('/api/contacts/' . $contact->id);

        $response->assertForbidden();
    }

    /** @test **/
    public function a_contact_can_be_updated()
    {
        Sanctum::actingAs($this->user);

        $contact = Contact::factory()->create(['user_id' => $this->user->id]);

        $this->patch('/api/contacts/' . $contact->id, $this->data());

        $contact = $contact->fresh();

        $this->assertEquals($this->user->id, $contact->user->id);
        $this->assertEquals('Test Name', $contact->name);
        $this->assertEquals("test@email.com", $contact->email);
        $this->assertEquals("123-123-1234", $contact->cellphone);
        $this->assertEquals("01-31-1997", $contact->birthdate->format('m-d-Y'));
        $this->assertEquals("", $contact->note);
    }

    /** @test **/
    public function only_the_user_can_update_their_contact()
    {
        Sanctum::actingAs($this->user);
        $anotherUser = User::factory()->create();

        $contact = Contact::factory()->create(['user_id' => $anotherUser->id]);

        $response = $this->patch('/api/contacts/' . $contact->id, $this->data());

        $response->assertForbidden();
    }

    /** @test **/
    public function a_contact_can_be_deleted()
    {
        Sanctum::actingAs($this->user);

        $contact = Contact::factory()->create(['user_id' => $this->user->id]);

        $this->delete('/api/contacts/' . $contact->id);

        $this->assertCount(0, Contact::all());
    }

    /** @test **/
    public function only_the_user_can_delete_their_contact()
    {
        Sanctum::actingAs($this->user);
        $anotherUser = User::factory()->create();

        $contact = Contact::factory()->create(['user_id' => $anotherUser->id]);

        $response =  $this->delete('/api/contacts/' . $contact->id);

        $response->assertForbidden();
    }

    private function data()
    {
        return [
            'name' => 'Test Name',
            'email' => 'test@email.com',
            'cellphone' => '123-123-1234',
            'birthdate' => '31-01-1997',
            'note' => ''
        ];
    }
}
