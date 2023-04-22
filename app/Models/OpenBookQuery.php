<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpenBookQuery extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'book_id', 'query_text'];
}
