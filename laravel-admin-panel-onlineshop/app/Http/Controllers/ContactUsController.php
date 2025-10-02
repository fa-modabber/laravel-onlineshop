<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index()
    {
        $messages = ContactUs::all();
        return view('contacts.index', compact('messages'));
    }

    public function show(ContactUs $contact)
    {
        $message = $contact;
        return view('contacts.show', compact('message'));
    }

    public function destroy(ContactUs $contact)
    {
        $contact->delete();
        return redirect()->route('contact-us.index')->with('warning', 'پیام با موفقیت حذف شد');
    }
}
