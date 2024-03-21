<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
  <head lang="ru">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>СевГУ Витрина - @yield("title")</title>
    @vite(["resources/css/app.css", "resources/js/app.js"])
  </head>

  <body hx-headers='{"X-CSRF-TOKEN": "{{ csrf_token() }}"}'>
    @yield("content")
  </body>
</html>
