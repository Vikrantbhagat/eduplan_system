<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUsMail;

class ContactController extends Controller
{
    public function showForm()
    {
        return view('pages.contact-us');
    }

    public function sendMail(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        $contactData = $request->only('name','email','phone','subject','message');

        // Send email to your target email address
        Mail::to('headoffice@example.com')->send(new ContactUsMail($contactData));

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}
