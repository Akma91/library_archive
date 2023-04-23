<?php

namespace App\Models;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookRecommendationComposer extends Model
{
    use HasFactory;

    private const RECOMMENDATION_POOL_SIZE = 10;
    private const RECOMMENDATION_CRITERIA = ['author', 'genre'];

    private int $customerId;
    private Model $criterionToRecommendToUser;

    function __construct($customerId) {
        $this->customerId = $customerId;
    }

    public function process(Book $book)
    {
        foreach(self::RECOMMENDATION_CRITERIA as $criterion){
            $this->criterionToRecommendToUser = $book->$criterion;
            $bookByCriterion = $this->getRandomBookToRecommendBasedOnCriterion();
            $this->storeRecommendationsForCustomer($bookByCriterion);
        }

        $this->deleteOutdatedRecommendations();
    }

    private function getRandomBookToRecommendBasedOnCriterion()
    {
        $className = $this->getCurrentCriterionClassName();

        return Book::where($className . '_id', $this->criterionToRecommendToUser->id)
        ->get()
        ->random(1)[0];
    }

    private function storeRecommendationsForCustomer($bookByCriterion)
    {
        $className = $this->getCurrentCriterionClassName();

        if(!CustomerBookRecommendation::where('user_id',$this->customerId)->where('book_id',$bookByCriterion->id)->exists()
        ){
            CustomerBookRecommendation::create([
                'user_id' => $this->customerId,
                'book_id' => $bookByCriterion->id,
                'criterion' => $className
            ]);
        }
    }

    private function getCurrentCriterionClassName() 
    {
        $classNameArray = explode("\\", $this->criterionToRecommendToUser::class);

        return strtolower(end($classNameArray));
    }

    private function deleteOutdatedRecommendations() 
    {
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
}
