<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function confirm(Request $request)
    {
        return view('contact/confirm');
    }

    public function store(Request $request)
    {
        return view('contact/thanks');
    }
}
