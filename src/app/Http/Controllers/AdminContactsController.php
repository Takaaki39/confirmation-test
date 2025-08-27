<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\contact;

class AdminContactsController extends Controller
{
    public function index()
    {
        $contacts = contact::paginate(7);
        $categories = [
            '商品のお届けについて',
            '商品の交換について',
            '商品トラブル',
            'ショップへのお問い合わせ',
            'その他'
        ];
        return view('admin/index', compact(['contacts','categories']));
    }

}
