<?php
 
namespace App\Http\View\Composers;
 
use App\Models\CustomerBookRecommendation;
use Illuminate\View\View;
 
class RecommendationViewComposer
{
    public function compose(View $view)
    {
        if(
            !auth()->user() ||
            CustomerBookRecommendation::with('book')->where('user_id', auth()->user()->id)->get()->count() < 5
        ){
            $view->with(
                ['customerBookRecommendations' => []]
            );
            return;
        }

        $customerBookRecommendations = CustomerBookRecommendation::with('book')
            ->where('user_id', auth()->user()->id)->get()->random(5);

        $view->with(
            ['customerBookRecommendations' => $customerBookRecommendations]
        );
    }
}