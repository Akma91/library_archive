<?php
 
namespace App\Http\View\Composers;
 
use App\Models\Book;
use App\Models\CustomerBookRecommendation;
use Illuminate\View\View;
 
class RecommendationViewComposer
{
    private const RECOMMENDATIONS_TO_SHOW = 5;

    public function compose(View $view)
    {
        if(!auth()->user()) {
            $view->with(
                ['customerBookRecommendations' => []]
            );
            return;
        }

        if(CustomerBookRecommendation::with('book')->where('user_id', auth()->user()->id)->get()->count() < self::RECOMMENDATIONS_TO_SHOW) {
            $view->with(
                ['customerBookRecommendations' => $this->getCompensatedRecommendations()]
            );
        } else {
            $view->with(
                ['customerBookRecommendations' => $this->getAllBooksFromRecommendations()]
            );
        }
    }

    private function getCompensatedRecommendations()
    {
        $customerBooksToShowIds = CustomerBookRecommendation::with('book')
        ->where('user_id', auth()->user()->id)
        ->get()->pluck('book_id')
        ->toArray();

        $booksToShowAsRecommendation = Book::whereIn('id', $customerBooksToShowIds)->get();

        $numOfBooksToShowAsRecommendation = self::RECOMMENDATIONS_TO_SHOW - count($customerBooksToShowIds);
        $booksToFillMissingRecommendations = Book::inRandomOrder()->limit($numOfBooksToShowAsRecommendation)->get();

        return $booksToShowAsRecommendation->concat($booksToFillMissingRecommendations)->shuffle();
    }

    private function getAllBooksFromRecommendations()
    {
        $customerBooksToShowIds = CustomerBookRecommendation::with('book')
        ->where('user_id', auth()->user()->id)
        ->get()->random(self::RECOMMENDATIONS_TO_SHOW)->pluck('book_id')
        ->toArray();

        return Book::whereIn('id', $customerBooksToShowIds)->get();
    }
}