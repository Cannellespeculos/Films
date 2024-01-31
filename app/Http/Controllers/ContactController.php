<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function create(): View
    {
        return view('contact');
    }

    public function store(ContactRequest $request): view
    {
        Mail::to('administrateur@chezmoi.com')
            ->send(new Contact($request->except('_token')));
        return view('confirm');
    }
}
