@props(['customerBookRecommendations'])

<div class="recommendedBooksOuter">
    <div class="recommendedBooks">
        @foreach ($customerBookRecommendations as $customerBookRecommendation)
            <a class="recommendationBookCard" href="/books/{{ $customerBookRecommendation->slug }}">
                <div>
                    <div class="recommendationImagePlaceholder"></div>
                    <h4>{{ $customerBookRecommendation->title }}</h4>
                    <p>{{ $customerBookRecommendation->author->name }}</p>
                </div>
            </a>
        @endforeach
    </div>
</div>