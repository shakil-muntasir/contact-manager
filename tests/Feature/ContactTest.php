<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function a_contact_can_be_created()
    {
        $response = $this->post('/api/contacts', array_merge($this->data(), ['note' => 'Some Notes']));

        $response->assertCreated();

        $this->assertCount(1, Contact::all());
        $this->assertEquals("Test Name", Contact::first()->name);
        $this->assertEquals("test@email.com", Contact::first()->email);
        $this->assertEquals("123-123-1234", Contact::first()->cellphone);
        $this->assertEquals("01-31-1997", Contact::first()->birthdate->format('m-d-Y'));
        $this->assertEquals("Some Notes", Contact::first()->note);
    }

    /** @test **/
    public function some_fields_are_required()
    {
        collect(['name', 'email', 'cellphone', 'birthdate'])->each(function ($field) {
            $response = $this->post('/api/contacts', array_merge($this->data(), [$field => '']));

            $response->assertSessionHasErrors($field);

            $this->assertCount(0, Contact::all());
        });
    }

    /** @test **/
    public function some_fields_can_be_null()
    {
        collect(['note'])->each(function ($field) {
            $response = $this->post('/api/contacts', array_merge($this->data(), [$field => '']));

            $response->assertCreated();

            $this->assertCount(1, Contact::all());
        });
    }

    /** @test **/
    public function email_should_be_properly_formatted()
    {
        $response = $this->post('/api/contacts', array_merge($this->data(), ['email' => 'NOT AN EMAIL']));

        $response->assertSessionHasErrors('email');

        $this->assertCount(0, Contact::all());
    }

    /** @test **/
    public function birthdate_is_a_proper_date()
    {
        $this->post('/api/contacts', $this->data());

        $this->assertInstanceOf(Carbon::class, Contact::first()->birthdate);
        $this->assertEquals('01-31-1997', Contact::first()->birthdate->format('m-d-Y'));
    }

    /** @test **/
    public function all_contacts_can_be_retrieved()
    {
        Contact::factory()->count(3)->create();

        $response = $this->get('/api/contacts');

        $response->assertOk();
        $response->assertJsonCount(3);
    }

    /** @test **/
    public function a_specific_contact_can_be_retrieved()
    {
        $contact = Contact::factory()->create();

        $response = $this->get('/api/contacts/' . $contact->id);

        $response->assertOk();
        $response->assertJson([
            'name' => $contact->name,
            'email' => $contact->email,
            'cellphone' => $contact->cellphone,
            'birthdate' => $contact->birthdate->toJson(),
            'note' => $contact->note,
        ]);
    }

    /** @test **/
    public function a_contact_can_be_updated()
    {
        $contact = Contact::factory()->create();

        $this->patch('/api/contacts/' . $contact->id, $this->data());

        $contact = $contact->fresh();

        $this->assertEquals('Test Name', $contact->name);
        $this->assertEquals("test@email.com", $contact->email);
        $this->assertEquals("123-123-1234", $contact->cellphone);
        $this->assertEquals("01-31-1997", $contact->birthdate->format('m-d-Y'));
        $this->assertEquals("", $contact->note);
    }

    /** @test **/
    public function a_contact_can_be_deleted()
    {
        $contact = Contact::factory()->create();

        $this->delete('/api/contacts/' . $contact->id);

        $this->assertCount(0, Contact::all());
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
