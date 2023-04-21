<?php

namespace App\Rules;

use App\Models\Book;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\InvokableRule;

class DateNotReserved implements DataAwareRule, InvokableRule
{
    protected $data = [];

    public function __invoke(string $attribute, mixed $value, Closure $fail): void
    {
        if($this->data['reserved_from'] > $value){
            $fail('Datum -od ne može biti veći od datuma -do');
        }

        if (
            Book::where('id', $this->data['book_id'])
                ->where('reserved_to', '>=', $value)
                ->exists()
        ) {
            $fail('Knjiga je već rezervirana za odabrani datum');
        }
    }

    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }
}
