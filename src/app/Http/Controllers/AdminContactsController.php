<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminContactsController extends Controller
{
    public function index()
    {
        $contacts = Contact::paginate(7);
        $categories = Category::all();
        return view('admin/index', compact(['contacts','categories']));
    }

    public function search(Request $request)
    {
        $contacts = Contact::with('category')
        ->NameSearch($request->input)
        ->GenderSearch($request->gender)
        ->CategorySearch($request->category_id)
        ->DateSearch($request->search_date)
        ->paginate(7)
        ->appends([
            'input'         => $request->input,
            'gender'        => $request->gender,
            'category_id'   => $request->category_id,
            'search_date'   => $request->search_date,
        ]);

        $categories = Category::all();
        return view('admin/index', compact(['contacts','categories']));
    }

    public function delete(Request $request)
    {
        Contact::find($request->id)->delete();
        return redirect('/admin');
    }

    public function export(Request $request)
    {
        dd($request);
        $allContacts = Contact::with('category')
            ->NameSearch($request->input('input'))
            ->GenderSearch($request->input('gender'))
            ->CategorySearch($request->input('category_id'))
            ->DateSearch($request->input('search_date'))
            ->get();

        $filename = 'contacts_' . now()->format('Ymd_His') . '.csv';

        $headers = [
            "Content-type"        => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename={$filename}",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function() use ($allContacts) {
            $handle = fopen('php://output', 'w');

            // 文字化け防止 (Excel想定なら BOM を付与)
            fputs($handle, "\xEF\xBB\xBF");

            // ヘッダー行
            fputcsv($handle, ['ID', '姓', '名', '性別', 'メールアドレス', '電話番号', '住所', '建物名', 'カテゴリ', '詳細', '作成日']);

            // データ行
            foreach ($allContacts as $contact) {
                fputcsv($handle, [
                    $contact->id,
                    $contact->last_name,
                    $contact->first_name,
                    $contact->genderLabel(),
                    $contact->email,
                    $contact->tel,
                    $contact->address,
                    $contact->building,
                    optional($contact->category)->content,
                    $contact->detail,
                    $contact->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
