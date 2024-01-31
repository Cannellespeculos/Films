<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactsController extends Controller
{
    public function create(): View
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'bail|required|email',
            'message' => 'bail|required|max:500'
        ]);
        $contact = new \App\Models\contacts;
        $contact->email = $request->email;
        $contact->message = $request->message;
        $contact->save();
        return "C'est bien enregistré !";
    }
}
