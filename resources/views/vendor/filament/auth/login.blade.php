<head>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>


<div class="flex min-h-screen items-center justify-center bg-gray-100">
    <div class="w-full max-w-sm rounded-lg bg-white p-6 shadow-lg">
        <div class="mb-6 text-center">
            <img src="{{ asset('path/to/your/logo.png') }}" alt="Logo" class="mx-auto mb-4">
        </div>
        <form method="POST" action="{{ route('filament.auth.login') }}">
            @csrf
            <!-- Add your form fields here -->
            <button type="submit" class="w-full rounded-lg bg-blue-500 py-2 text-white">Login</button>
        </form>
    </div>
</div>
