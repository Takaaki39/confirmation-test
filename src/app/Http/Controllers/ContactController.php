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
        $value = $request->only([
            'last_name','first_name',
            'gender',
            'email',
            'tel1',
            'tel2',
            'tel3',
            'address',
            'building',
            'category_id',
            'detail',
        ]);
        $name = $value['last_name'].$value['first_name'];
        $tel = $value['tel1'].$value['tel2'].$value['tel3'];
        $content = [
            'name' => $name,
            'gender' => $value['gender'],
            'email' => $value['email'],
            'tel' => $tel,
            'address' => $value['address'],
            'building' => $value['building'],
            'category_id' => $value['category_id'],
            'detail' => $value['detail']
        ];
        return view('contact/confirm', compact('content'));
    }

    public function store(Request $request)
    {
        // DBに保存
        
        return view('contact/thanks');
    }
}
