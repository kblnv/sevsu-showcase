<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
        
        @if ($title != "")
            <title>СевГУ Витрина - {{ $title }}</title>
        @else
            <title>СевГУ Витрина</title>
        @endif

        @vite(["resources/css/app.css", "resources/js/app.js"])
    </head>

    <body>
        <x-header />

        <main class="container mx-auto max-h-full min-h-screen px-6 py-8">
            {{ $slot }}
        </main>

        <x-footer />

        @livewireScriptConfig

        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    </body>
</html>
