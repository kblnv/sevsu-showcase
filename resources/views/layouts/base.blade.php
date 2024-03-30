<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>СевГУ Витрина - @yield("title")</title>
    @vite(["resources/css/app.css", "resources/js/app.js"])
  </head>

  <body hx-headers='{"X-CSRF-TOKEN": "{{ csrf_token() }}"}'>
    <x-header />

    <main class="container mx-auto mt-6 max-h-full min-h-screen px-6">
      @yield("content")
    </main>

    <x-footer />
  </body>
</html>
