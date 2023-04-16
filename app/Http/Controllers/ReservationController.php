<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function store()
    {
        if((int)request()->user_id !== auth()->user()->id){
            return back()
                    ->withInput()
                    ->with('error', 'Pokušaj neautorizirane rezervacije!');
        }

        $reservationFormValues = request()->validate([
            'reserved_to' => 'required|date',
            'book_id' => 'required|integer',
            'user_id' => 'required|integer',
        ]);

        Reservation::create($reservationFormValues);

        $book = Book::find(request()->book_id);
        $book->reserved_to = request()->reserved_to;
        $book->save();

        return back()
                ->withInput()
                ->with(['success' => 'Uspješno ste rezervirali posudbu!']);
    }
}
