<header class="h-[68px]">
    <nav
        class="h-full bg-sevsu-white shadow"
        x-data="{ isOpen: false }"
        x-ref="nav"
    >
        <div class="container mx-auto h-full px-6 lg:flex lg:justify-between">
            <div class="flex h-full items-center justify-between">
                <a href="{{ route("tasks.index") }}" wire:navigate>
                    <img
                        class="h-[50px] w-[186px]"
                        src="{{ asset("images/logo/sevsu-logo-main.svg") }}"
                        alt="Логотип СевГУ"
                    />
                </a>

                <div class="flex lg:hidden">
                    <button
                        class="text-gray-500 hover:text-gray-600 focus:text-gray-600 focus:outline-none"
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

            <ul class="hidden space-x-8 lg:flex">
                <li
                    class="{{ Route::is("tasks*") ? "after:content-[''] after:h-[2px] after:absolute after:inset-x-0 after:bottom-0 after:bg-sevsu-blue" : "" }} relative flex items-center"
                >
                    <a
                        class="transform transition-colors duration-300 hover:text-sevsu-blue"
                        href="{{ route("tasks.index") }}"
                        wire:navigate
                    >
                        Банк задач
                    </a>
                </li>
                <li
                    class="{{ Route::is("teams*") ? "after:content-[''] after:h-[2px] after:absolute after:inset-x-0 after:bottom-0 after:bg-sevsu-blue" : "" }} relative flex items-center"
                >
                    <a
                        class="transform transition-colors duration-300 hover:text-sevsu-blue"
                        href="{{ route("teams.index") }}"
                        wire:navigate
                    >
                        Команды
                    </a>
                </li>
                <li
                    class="{{ Route::is("my-teams*") ? "after:content-[''] after:h-[2px] after:absolute after:inset-x-0 after:bottom-0 after:bg-sevsu-blue" : "" }} relative flex items-center"
                >
                    <a
                        class="transform transition-colors duration-300 hover:text-sevsu-blue"
                        href="{{ route("my-teams.index") }}"
                        wire:navigate
                    >
                        Мои команды
                    </a>
                </li>
            </ul>

            <div
                class="hidden lg:flex lg:items-center"
                x-data="{ isActive: false }"
            >
                <div
                    class="inline-flex items-center overflow-hidden bg-sevsu-white"
                    x-ref="dropdown"
                >
                    <button
                        class="hidden items-center gap-2 text-black lg:flex"
                        type="button"
                        @click="isActive = !isActive"
                    >
                        {{ auth()->user()->second_name }}
                        {{ auth()->user()->first_name }}
                        {{ auth()->user()->last_name }}

                        <x-arrow.down />
                    </button>
                </div>

                <div
                    class="w-56 rounded-md border border-gray-100 bg-sevsu-white shadow-md"
                    x-anchor.offset.6.bottom-end="$refs.dropdown"
                    x-cloak
                    x-transition
                    x-show="isActive"
                    @click.away="isActive = false"
                >
                    <div class="p-2">
                        <a
                            class="flex w-full items-center gap-2 rounded-lg px-4 py-2 text-sm text-red-700 hover:bg-red-50"
                            href="{{ route("logout", "keycloak") }}"
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
                class="w-full bg-sevsu-white shadow lg:hidden"
                :style="{ position: 'absolute', top: $anchor.y+'px', left: '0px' }"
                x-cloak
                x-collapse
                x-show="isOpen"
                x-anchor.no-style="$refs.nav"
                @click.away="isOpen = false"
            >
                <div class="container mx-auto px-6 py-4">
                    <ul class="space-y-4">
                        <li
                            class="{{ Route::is("tasks.index") ? "border-b-2 border-sevsu-blue" : "" }} relative"
                        >
                            <a
                                class="transform transition-colors duration-300 hover:text-sevsu-blue"
                                href="{{ route("tasks.index") }}"
                                wire:navigate
                            >
                                Банк задач
                            </a>
                        </li>
                        <li
                            class="{{ Route::is("teams.index") ? "border-b-2 border-sevsu-blue" : "" }} relative"
                        >
                            <a
                                class="transform transition-colors duration-300 hover:text-sevsu-blue"
                                href="{{ route("teams.index") }}"
                                wire:navigate
                            >
                                Команды
                            </a>
                        </li>
                        <li
                            class="{{ Route::is("my-teams.index") ? "border-b-2 border-sevsu-blue" : "" }} relative"
                        >
                            <a
                                class="transform transition-colors duration-300 hover:text-sevsu-blue"
                                href="{{ route("my-teams.index") }}"
                                wire:navigate
                            >
                                Мои команды
                            </a>
                        </li>

                        <li>
                            <a
                                class="transform transition-colors duration-300 hover:text-sevsu-blue"
                                href="{{ route("logout", "keycloak") }}"
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
