@props(['customerBookRecommendations'])

<div class="recommendedBooksOuter">
    <div class="recommendedBooks">
        @foreach ($customerBookRecommendations as $customerBookRecommendation)
            <a class="recommendationBookCard" href="/books/{{ $customerBookRecommendation->book->slug }}">
                <div>
                    <div class="recommendationImagePlaceholder"></div>
                    <h4>{{ $customerBookRecommendation->book->title }}</h4>
                    <p>{{ $customerBookRecommendation->book->author->name }}</p>
                </div>
            </a>
        @endforeach
    </div>
</div>