@if (session()->has('success'))
    <div class='successMessage'>
        <h3>{{ session('success') }}</h3>
    </div>
@endif

@if (session()->has('error'))
    <div class='errorMessage'>
        <h3>{{ session('error') }}</h3>
    </div>
@endif