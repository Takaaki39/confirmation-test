<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactsRequest;
use App\Models\Contact;
use App\Models\Category;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('index', compact('categories'));
    }

    private function getGender($id){
        switch($id)
        {
            case 1:
                return "男性";
            case 2:
                return "女性";
            default:
                return "その他";
        }
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
            'last_name'     => $value['last_name'],
            'first_name'    => $value['first_name'],
            'gender'        => $value['gender'],
            'gender_name'   => $this->getGender($value['gender']),
            'email'         => $value['email'],
            'tel'           => $tel,
            'address'       => $value['address'],
            'building'      => $value['building'],
            'category'      => Category::find($value['category_id']),
            'detail'        => $value['detail']
        ];
        /*
        $content = [
            'last_name'     => '山田',
            'first_name'    => '太郎',
            'gender'        => 1,
            'gender_name'   => $this->getGender(2),
            'email'         => 'test@example.com',
            'tel'           => '08012345678',
            'address'       => '東京都渋谷区千駄ヶ谷1-2-3',
            'building'      => '千駄ヶ谷マンション101',
            'category'      => Category::find(1),
            'detail'        => '届いた商品が注文した商品ではありませんでした。商品の取り換えをお願いします。届いた商品が注文した商品ではありませんでした。商品の取り換えをお願いします。',
        ];
        */
        return view('contact/confirm', compact('content'));
    }

    public function store(Request $request)
    {
        // DBに保存
        $content = $request->only([
            'last_name',
            'first_name',
            'gender',
            'email',
            'tel',
            'address',
            'building',
            'category_id',
            'detail',
        ]);
        Contact::create($content);
        
        return view('contact/thanks');
    }
}
