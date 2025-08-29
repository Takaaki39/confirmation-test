<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'category_id',
        'detail'
    ];
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function genderLabel()
    {
        switch($this->gender)
        {
            case 1:
                return "男性";
            case 2:
                return "女性";
            default:
                return "その他";
        }
    }

    public function isJapaneseName($name)
    {
        // 漢字・ひらがな・カタカナのみを許可
        return preg_match('/^[\p{Hiragana}\p{Katakana}\p{Han}]+$/u', $name);
    }

    public function scopeLastNameSearch($query, $keyword)
    {
        if(!empty($keyword))
        {
            $query->where('last_name', 'like', '%'.$keyword.'%');
        }
    }

    public function scopeFirstNameSearch($query, $keyword)
    {
        if(!empty($keyword))
        {
            $query->where('first_name', 'like', '%'.$keyword.'%');
        }
    }

    public function scopeNameSearch($query, $keyword)
    {
        if(!empty($keyword))
        {
            $query->where(function ($q) use ($keyword) {
                        // フルネーム検索
                        $q->whereRaw("CONCAT(last_name, first_name) LIKE ?", ["%{$keyword}%"])
                        ->orWhereRaw("CONCAT(last_name, ' ', first_name) LIKE ?", ["%{$keyword}%"])
                        ->orWhereRaw("CONCAT(first_name, last_name) LIKE ?", ["%{$keyword}%"])
                        ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$keyword}%"])
                        ->orWhere('email', 'like', "%{$keyword}%");
            });
            return $query;
        }
    }

    public function scopeEmailSearch($query, $keyword)
    {
        if(!empty($keyword))
        {
            $query->where('email', 'like', '%'.$keyword.'%');
        }
    }

    public function scopeGenderSearch($query, $keyword)
    {
        if(!empty($keyword) && $keyword != "0")
        {
            $query->where('gender', $keyword);
        }
    }
    
    public function scopeCategorySearch($query, $keyword)
    {
        if(!empty($keyword) && $keyword != "0")
        {
            $query->where('category_id', $keyword);
        }
    }
    
    public function scopeDateSearch($query, $keyword)
    {
        if(!empty($keyword))
        {
            $date = Carbon::createFromFormat('Y-m-d', $keyword)->format('Y-m-d');
            $query->whereDate('created_at', $date);
        }
    }
}
