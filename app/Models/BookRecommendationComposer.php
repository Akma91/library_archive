<?php

namespace App\Models;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookRecommendationComposer extends Model
{
    const RECOMMENDATION_POOL_SIZE = 10;

    use HasFactory;

    private int $customerId;
    private Genre $genreToRecommendToUser;
    private Author $authorToRecommendToUser;

    function __construct($customerId) {
        $this->customerId = $customerId;
    }

    public function process(Book $book)
    {
        $this->genreToRecommendToUser = $book->genre;
        $this->authorToRecommendToUser = $book->author;

        $bookByGenre = $this->getRandomBookToRecommendBasedOnGenre();
        $bookByAuthor = $this->getRandomBookToRecommendBasedOnAuthor();

        $this->storeRecommendationsForCustomer($bookByGenre, $bookByAuthor);
    }

    private function storeRecommendationsForCustomer($bookByGenre, $bookByAuthor)
    {
        if(!CustomerBookRecommendation::where('user_id',$this->customerId)->where('book_id',$bookByGenre->id)->exists()
        ){
            CustomerBookRecommendation::create([
                'user_id' => $this->customerId,
                'book_id' => $bookByGenre->id,
                'criterion' => 'genre'
            ]);
        }
    
        if(!CustomerBookRecommendation::where('user_id',$this->customerId)->where('book_id',$bookByAuthor->id)->exists()
        ){
            CustomerBookRecommendation::create([
                'user_id' => $this->customerId,
                'book_id' => $bookByAuthor->id,
                'criterion' => 'author'
            ]);
        }

        $customerBookRecommendation = CustomerBookRecommendation::where('user_id', '=', $this->customerId)
            ->orderBy('created_at','DESC')
            ->get()
            ->pluck('id')
            ->toArray();
        
        $idsOfTheRecordsToDelete = array_slice($customerBookRecommendation, self::RECOMMENDATION_POOL_SIZE);

        if (count($idsOfTheRecordsToDelete)) 
        {
            CustomerBookRecommendation::destroy($idsOfTheRecordsToDelete);
        }

    }

    private function getRandomBookToRecommendBasedOnGenre()
    {
        return Book::where('genre_id', '=', $this->genreToRecommendToUser->id)
        ->get()
        ->random(1)[0];
    }

    private function getRandomBookToRecommendBasedOnAuthor()
    {
        return Book::where('author_id', '=', $this->authorToRecommendToUser->id)
        ->get()
        ->random(1)[0];
    }
}
