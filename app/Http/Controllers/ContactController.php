<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller
{
    public function index()
    {
        return Contact::all();
    }

    public function store()
    {
        return Contact::create($this->validateData());
    }

    public function show(Contact $contact)
    {
        return $contact;
    }

    public function update(Contact $contact)
    {
        $contact->update($this->validateData());

        return $contact;
    }

    public function destroy(Contact $contact)
    {
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
