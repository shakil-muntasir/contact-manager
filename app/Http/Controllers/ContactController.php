<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Contact::class);

        return request()->user()->contacts;
    }

    public function store()
    {
        $this->authorize('create', Contact::class);

        $contact = request()->user()->contacts()->create($this->validateData());

        return $contact;
    }

    public function show(Contact $contact)
    {
        $this->authorize('view', $contact);

        return $contact;
    }

    public function update(Contact $contact)
    {
        $this->authorize('update', $contact);

        return $contact->update($this->validateData());
    }

    public function destroy(Contact $contact)
    {
        $this->authorize('delete', $contact);

        return $contact->delete();

        return response(null, Response::HTTP_OK);
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
