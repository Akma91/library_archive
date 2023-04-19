<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerBookRecommendation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','book_id','criterion'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
