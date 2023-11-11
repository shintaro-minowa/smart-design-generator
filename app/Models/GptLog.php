<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GptLog extends Model
{
    protected $fillable = ['request', 'response'];
}
