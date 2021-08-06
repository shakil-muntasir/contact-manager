<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller
{
    public function index()
    {
        return request()->user()->contacts;
    }

    public function store()
    {
        $contact = request()->user()->contacts()->create($this->validateData());

        return $contact;
    }

    public function show(Contact $contact)
    {
        if (request()->user()->is($contact->user)) {
            return $contact;
        }

        return response(null, Response::HTTP_FORBIDDEN);
    }

    public function update(Contact $contact)
    {
        if (request()->user()->is($contact->user)) {
            $contact->update($this->validateData());

            return $contact;
        }

        return response(null, Response::HTTP_FORBIDDEN);
    }

    public function destroy(Contact $contact)
    {
        if (request()->user()->is($contact->user)) {
            $contact->delete();

            return response(null, Response::HTTP_OK);
        }

        return response(null, Response::HTTP_FORBIDDEN);
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
