<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'user_id', 'code', 'user_ip'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($page) {
            $page->code = Str::random(16);
        });
    }

    public function content()
    {
        return $this->hasOne(Content::class);
    }
}
