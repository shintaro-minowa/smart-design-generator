<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $table = 'contents';

    protected $fillable = [
        'html_content',
        'css_content',
        'js_content',
        'page_id',
        // 他のカラムを追加
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
