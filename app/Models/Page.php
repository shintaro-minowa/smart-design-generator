<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    // テーブル名の指定（オプション）
    protected $table = 'pages';

    // 代入可能な属性の指定
    protected $fillable = [
        'title',
        // ページのタイトル
        'user_id',
        // ユーザーID
        // 必要に応じて他のカラムを追加
    ];

    // Contentモデルとの1対1の関係を定義
    public function content()
    {
        return $this->hasOne(Content::class);
    }
}
