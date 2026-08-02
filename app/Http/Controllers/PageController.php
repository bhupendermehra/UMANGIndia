<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function contactSubmit(\Illuminate\Http\Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'message' => 'required|string|max:2000',
        ]);

        \Illuminate\Support\Facades\Mail::raw(
            "Name: {$data['name']}\nEmail: {$data['email']}\n\n{$data['message']}",
            function ($m) use ($data) {
                $m->to('contact@umangindia.com')
                  ->from(config('mail.from.address'), config('mail.from.name'))
                  ->replyTo($data['email'], $data['name'])
                  ->subject('Contact Form: ' . $data['name']);
            }
        );

        return back()->with('contact_success', 'Thank you! Your message has been sent. We will reply within 48 hours.');
    }

    public function privacy()
    {
        return view('pages.privacy');
    }

    public function disclaimer()
    {
        return view('pages.disclaimer');
    }

    public function terms()
    {
        return view('pages.terms');
    }
}
