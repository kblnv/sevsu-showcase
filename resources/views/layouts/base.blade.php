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
          class="container px-6 py-4 mx-auto lg:flex lg:justify-between lg:items-center"
        >
          <div class="flex items-center justify-between">
            <a href="{{ route("tasks") }}">
              <img
                class="w-[186px] h-[50px]"
                src="{{ asset("images/logo/sevsu-logo-main.svg") }}"
                alt="Логотип СевГУ"
              />
            </a>

            <div class="flex lg:hidden">
              <button
                class="text-gray-500 dark:text-gray-200 hover:text-gray-600 dark:hover:text-gray-400 focus:outline-none focus:text-gray-600 dark:focus:text-gray-400"
                type="button"
                x-cloak
                @click="isOpen = !isOpen"
              >
                <svg
                  class="size-6"
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
                  class="size-6"
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

          <div
            class="absolute inset-x-0 z-20 w-full px-6 py-4 transition-all duration-300 ease-in-out bg-sevsu-white lg:mt-0 lg:p-0 lg:top-0 lg:relative lg:bg-transparent lg:w-auto lg:opacity-100 lg:translate-x-0 lg:flex lg:items-center"
            x-cloak
            :class="[isOpen ? 'translate-x-0 opacity-100' : 'opacity-0 -translate-x-full']"
          >
            <div class="flex flex-col lg:flex-row md:mx-6">
              <a
                class="my-2 text-black transition-colors duration-300 transform hover:text-sevsu-blue lg:mx-4 lg:my-0"
                href="{{ route("tasks") }}"
              >
                Банк задач
              </a>
              <a
                class="my-2 text-black transition-colors duration-300 transform hover:text-sevsu-blue lg:mx-4 lg:my-0"
                href="{{ route("teams") }}"
              >
                Команды
              </a>
              <a
                class="my-2 text-black transition-colors duration-300 transform hover:text-sevsu-blue lg:mx-4 lg:my-0"
                href="{{ route("my-teams") }}"
              >
                Мои команды
              </a>

              <a
                class="my-2 text-black transition-colors duration-300 transform hover:text-sevsu-blue lg:hidden"
                href="{{ route("my-teams") }}"
              >
                Выйти
              </a>
            </div>
          </div>

          <div class="hidden lg:block relative" x-data="{ isActive: false }">
            <div
              class="inline-flex items-center overflow-hidden bg-sevsu-white"
            >
              <button
                class="hidden lg:flex gap-2 items-center text-black"
                type="button"
                href="#"
                @click="isActive = !isActive"
              >
                Кабалинов Максим Владимирович

                <svg
                  class="size-4"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="m19.5 8.25-7.5 7.5-7.5-7.5"
                  />
                </svg>
              </button>
            </div>

            <div
              class="absolute end-0 z-10 mt-2 w-56 rounded-md border border-gray-100 bg-sevsu-white shadow-lg"
              x-cloak
              x-transition
              x-show="isActive"
              @click.away="isActive = false"
              @keydown.escape.window="isActive = false"
            >
              <div class="p-2">
                <a
                  class="flex w-full items-center gap-2 rounded-lg px-4 py-2 text-sm text-red-700 hover:bg-red-50"
                  href="#"
                >
                  <svg
                    class="size-4"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15"
                    />
                  </svg>

                  Выйти
                </a>
              </div>
            </div>
          </div>
        </div>
      </nav>
    </header>

    <main class="container mx-auto mt-6 px-6 min-h-screen max-h-full">
      @yield("content")
    </main>

    <footer class="bg-sevsu-light-gray mt-6 p-4 text-center">
      <h2>ФГАОУ ВО "Севастопольский государственный университет"</h2>
      <p>Техническая поддержка:</p>
      <a class="text-sevsu-blue" href="#">showcase_support@sevsu.ru</a>
    </footer>
  </body>
</html>
