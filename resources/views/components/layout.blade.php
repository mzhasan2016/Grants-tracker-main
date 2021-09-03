<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <link href="https://rsms.me/inter/inter.css" rel="stylesheet">
        <livewire:styles />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <title>{{ $title ?? '' }} - {{ config('app.name', 'Laravel') }}</title>
    </head>
    <body class="font-sans antialiased bg-gray-50 text-gray-900">
        {{ $slot }}

        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="https://unpkg.com/tippy.js@6"></script>
        <livewire:scripts />
        <script src="{{ asset('js/app.js') }}" defer></script>
        @stack('scripts')
    </body>
</html>
