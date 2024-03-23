<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>СевГУ Витрина - @yield("title")</title>
    @vite(["resources/css/app.css", "resources/js/app.js"])
  </head>

  <body hx-headers='{"X-CSRF-TOKEN": "{{ csrf_token() }}"}'>
    <header>
      <nav class="relative bg-sevsu-white shadow" x-data="{ isOpen: false }">
        <div
          class="container px-6 py-4 mx-auto md:flex md:justify-between md:items-center"
        >
          <div class="flex items-center justify-between">
            <a href="{{ route("tasks") }}">
              <img
                class="w-[200px] h-[54px]"
                src="{{ asset("images/logo/sevsu-logo-main.svg") }}"
                alt="Логотип СевГУ"
              />
            </a>

            <!-- Mobile menu button -->
            <div class="flex md:hidden">
              <button
                class="text-gray-500 dark:text-gray-200 hover:text-gray-600 dark:hover:text-gray-400 focus:outline-none focus:text-gray-600 dark:focus:text-gray-400"
                type="button"
                aria-label="toggle menu"
                x-cloak
                @click="isOpen = !isOpen"
              >
                <svg
                  class="w-6 h-6"
                  x-show="!isOpen"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  stroke-width="2"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M4 8h16M4 16h16"
                  />
                </svg>

                <svg
                  class="w-6 h-6"
                  x-show="isOpen"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  stroke-width="2"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M6 18L18 6M6 6l12 12"
                  />
                </svg>
              </button>
            </div>
          </div>

          <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
          <div
            class="absolute inset-x-0 z-20 w-full px-6 py-4 transition-all duration-300 ease-in-out bg-sevsu-white md:mt-0 md:p-0 md:top-0 md:relative md:bg-transparent md:w-auto md:opacity-100 md:translate-x-0 md:flex md:items-center"
            x-cloak
            :class="[isOpen ? 'translate-x-0 opacity-100' : 'opacity-0 -translate-x-full']"
          >
            <div class="flex flex-col md:flex-row md:mx-6">
              <a
                class="my-2 text-black transition-colors duration-300 transform hover:text-sevsu-blue md:mx-4 md:my-0"
                href="{{ route("tasks") }}"
              >
                Банк задач
              </a>
              <a
                class="my-2 text-black transition-colors duration-300 transform hover:text-sevsu-blue md:mx-4 md:my-0"
                href="{{ route("teams") }}"
              >
                Команды
              </a>
              <a
                class="my-2 text-black transition-colors duration-300 transform hover:text-sevsu-blue md:mx-4 md:my-0"
                href="{{ route("my-teams") }}"
              >
                Мои команды
              </a>

              <a
                class="my-2 text-black transition-colors duration-300 transform hover:text-sevsu-blue md:hidden"
                href="{{ route("my-teams") }}"
              >
                Выйти
              </a>
            </div>
          </div>

          <button
            class="hidden md:flex gap-2 items-center text-black"
            href="#"
          >
            Кабалинов Максим Владимирович

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
            </svg>
        </button>
        </div>
      </nav>
    </header>

    <main class="container mx-auto mt-6 px-6">
      @yield("content")
    </main>
  </body>
</html>
