<?php

namespace App\Rules;

use App\Models\Reservation;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\InvokableRule;

class BookNotReserved implements DataAwareRule, InvokableRule
{
    protected $data = [];

    public function __invoke(string $attribute, mixed $value, Closure $fail): void
    {
        $reservation = Reservation::where('user_id', auth()->user()->id)
        ->where('book_id', $value)
        ->first();

        if ($reservation?->count()) {
            $fail('Već ste rezervirali ovu knjigu od ' . 
                date('d.m.Y', strtotime($reservation->reserved_from)) . 
                ' do ' . 
                date('d.m.Y', strtotime($reservation->reserved_to)));
        }
    }

    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }
}
