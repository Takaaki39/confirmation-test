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

    public function export()
    {
        $fileName = 'contacts_' . date('Ymd_His') . '.csv';
        $headers = [
            'Content-type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename={$fileName}",
            'Pragma'              => 'no-cache',
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Expires'             => '0',
        ];
        $columns = [
            'id',
            'first_name', 
            'last_name', 
            'gender', 
            'email', 
            'tel', 
            'address',
            'building',
            'category_id',
            'detail',
            'created_at',
            'updated_at'
        ];

        $callback = function() use ($columns) {
            // BOM を先頭に付けると Excel（Windows）で文字化けしにくくなる
            echo "\xEF\xBB\xBF";

            $output = fopen('php://output', 'w');
            // ヘッダー行
            fputcsv($output, $columns);

            // チャンクで取り出してメモリ消費を抑える
            Contact::chunk(1000, function($contacts) use ($output, $columns) {
                foreach ($contacts as $contact) {
                    $row = [];
                    foreach ($columns as $col) {
                        // created_at 等を文字列化
                        $value = data_get($contact, $col);
                        if ($value instanceof \Illuminate\Support\Carbon) {
                            $value = $value->toDateTimeString();
                        }
                        $row[] = $value;
                    }
                    fputcsv($output, $row);
                }
            });

            fclose($output);
        };
        return new StreamedResponse($callback, 200, $headers);
    }
}
