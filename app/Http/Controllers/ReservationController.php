<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookRecommendationComposer;
use App\Models\Reservation;
use App\Rules\DateNotReserved;
use App\Rules\BookNotReserved;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function store()
    {
        $reservationFormValues = request()->validate([
            'reserved_from' => 'required|date',
            'reserved_to' => ['required', 'date', new DateNotReserved],
            'book_id' => ['required', 'integer', new BookNotReserved],
        ]);

        $reservationFormValues['user_id'] = auth()->user()->id;

        Reservation::create($reservationFormValues);

        $book = Book::find($reservationFormValues['book_id']);
        $this->updateBookReservedTime($book, $reservationFormValues['reserved_to']);
        $this->processBookForCustomerRecommendations($reservationFormValues['user_id'], $book);

        return back()
                ->withInput()
                ->with(['success' => 'Uspješno ste rezervirali posudbu!']);
    }

    private function updateBookReservedTime(Book $book, string $reservedTo)
    {
        $book->reserved_to = $reservedTo;
        $book->save();
    }

    private function processBookForCustomerRecommendations(string $userId, Book $book)
    {
        $bookRecommendationComposer = new BookRecommendationComposer($userId);
        $bookRecommendationComposer->process($book);
    }
}
