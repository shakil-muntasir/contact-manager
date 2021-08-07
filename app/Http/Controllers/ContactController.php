<?php

namespace App\Http\Controllers;

use App\Http\Resources\Contact as ContactResource;
use App\Http\Resources\ContactCollection;
use App\Models\Contact;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Contact::class);

        $contacts = request()->user()->contacts()->latest()->get();

        return new ContactCollection($contacts);
    }

    public function store()
    {
        $this->authorize('create', Contact::class);

        $contact = request()->user()->contacts()->create($this->validateData());

        return new ContactResource($contact);
    }

    public function show(Contact $contact)
    {
        $this->authorize('view', $contact);

        return new ContactResource($contact);
    }

    public function update(Contact $contact)
    {
        $this->authorize('update', $contact);

        $contact->update($this->validateData());

        $contact = $contact->fresh();

        return new ContactResource($contact);
    }

    public function destroy(Contact $contact)
    {
        $this->authorize('delete', $contact);

        $contact->delete();

        return response([], Response::HTTP_OK);
    }

    private function validateData()
    {
        return request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'cellphone' => 'required',
            'birthdate' => 'required',
            'note' => '',
        ]);
    }
}
