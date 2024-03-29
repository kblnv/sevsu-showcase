<header>
  <nav class="bg-sevsu-white shadow" x-data="{ isOpen: false }" x-ref="nav">
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
            class="text-gray-500 hover:text-gray-600 focus:outline-none focus:text-gray-600"
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

      <ul class="hidden lg:flex">
        <li
          class="mx-4 py-2 {{ Route::is("tasks") ? "border-b-2 border-sevsu-blue" : "" }}"
        >
          <a
            class="transition-colors duration-300 transform hover:text-sevsu-blue"
            href="{{ route("tasks") }}"
          >
            Банк задач
          </a>
        </li>
        <li
          class="mx-4 py-2 {{ Route::is("teams") ? "border-b-2 border-sevsu-blue" : "" }}"
        >
          <a
            class="transition-colors duration-300 transform hover:text-sevsu-blue"
            href="{{ route("teams") }}"
          >
            Команды
          </a>
        </li>
        <li
          class="mx-4 py-2 {{ Route::is("my-teams") ? "border-b-2 border-sevsu-blue" : "" }}"
        >
          <a
            class="transition-colors duration-300 transform hover:text-sevsu-blue"
            href="{{ route("my-teams") }}"
          >
            Мои команды
          </a>
        </li>
      </ul>

      <div
        class="hidden lg:block"
        x-data="{ isActive: false }"
        x-ref="dropdown"
      >
        <div class="inline-flex items-center overflow-hidden bg-sevsu-white">
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
          class="w-56 rounded-md border border-gray-100 bg-sevsu-white shadow-md"
          x-anchor.offset.12.bottom-end="$refs.dropdown"
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

      <div
        class="w-full shadow lg:hidden bg-sevsu-white"
        x-anchor.no-style="$refs.nav"
        x-bind:style="{ position: 'absolute', top: $anchor.y+'px', left: '0px' }"
        x-cloak
        x-show="isOpen"
        x-collapse
        @click.away="isOpen = false"
        @keydown.escape.window="isOpen = false"
      >
        <div class="container mx-auto px-6 py-4">
          <ul>
            <li
              class="{{ Route::is("tasks") ? "border-b-2 border-sevsu-blue" : "" }}"
            >
              <a
                class="transition-colors duration-300 transform hover:text-sevsu-blue"
                href="{{ route("tasks") }}"
              >
                Банк задач
              </a>
            </li>
            <li
              class="mt-4 {{ Route::is("teams") ? "border-b-2 border-sevsu-blue" : "" }}"
            >
              <a
                class="transition-colors duration-300 transform hover:text-sevsu-blue"
                href="{{ route("teams") }}"
              >
                Команды
              </a>
            </li>
            <li
              class="mt-4 {{ Route::is("my-teams") ? "border-b-2 border-sevsu-blue" : "" }}"
            >
              <a
                class="transition-colors duration-300 transform hover:text-sevsu-blue"
                href="{{ route("my-teams") }}"
              >
                Мои команды
              </a>
            </li>

            <li class="mt-4">
              <a
                class="transition-colors duration-300 transform hover:text-sevsu-blue"
                href="#"
              >
                Выйти
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
</header>
