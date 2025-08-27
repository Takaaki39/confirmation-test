<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactsRequest;
use App\Models\Category;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('index', compact('categories'));
    }

    public function confirm(ContactsRequest $request)
    {
        $value = $request->only([
            'last_name',
            'first_name',
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
        $tel = $value['tel1'].$value['tel2'].$value['tel3'];
        $content = [
            'last_name' => $value['last_name'],
            'first_name' => $value['first_name'],
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
