<div class="py-4 text-gray-500 dark:text-gray-400 flex flex-col h-screen bg-purple-900">
    <div class="flex-grow">
        <a href="{{ route('dashboard') }}" class="flex justify-center items-center">
            <img class="h-40 w-48 object-contain" src="{{ asset('img/signavox1.jpg') }}" alt="Logo">
        </a>

        <ul class="mt-6">
            <li class="relative px-6 py-3">
                <a class="inline-flex items-center w-full text-sm font-semibold  text-white transition-colors duration-150 hover:text-blue-300 dark:hover:text-blue-200"
                    href="{{ route('dashboard') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                        <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path fill="#ffffff"
                            d="M128 0c17.7 0 32 14.3 32 32V64H288V32c0-17.7 14.3-32 32-32s32 14.3 32 32V64h48c26.5 0 48 21.5 48 48v48H0V112C0 85.5 21.5 64 48 64H96V32c0-17.7 14.3-32 32-32zM0 192H448V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V192zM329 305c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-95 95-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L329 305z" />
                    </svg>
                    <span class="ml-4">Home</span>
                </a>
            </li>
        </ul>

        <ul>
            <ul>

                <!-- Agrega un separador aquí -->
                <hr class="my-2 border-t border-gray-600">
                <li class="relative px-6 py-3">
                    <span
                        class="inline-flex items-center w-full text-sm font-semibold text-white transition-colors duration-150 hover:text-blue-300 dark:hover:text-blue-200">
                        <!-- Texto del separador -->
                        <span class="ml-4">Señas</span>
                    </span>
                </li>

                <li class="relative px-6 py-3">
                    <a class="inline-flex items-center w-full text-sm font-semibold text-white transition-colors duration-150 hover:text-blue-300 dark:hover:text-blue-200"
                        href="users">
                        {{-- href="{{ route('traductor.index')}}"> --}}
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" fill="white">
                            <path
                                d="M149.1 64.8L138.7 96H64C28.7 96 0 124.7 0 160V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V160c0-35.3-28.7-64-64-64H373.3L362.9 64.8C356.4 45.2 338.1 32 317.4 32H194.6c-20.7 0-39 13.2-45.5 32.8zM256 192a96 96 0 1 1 0 192 96 96 0 1 1 0-192z" />
                        </svg>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17v1a1 1 0 001 1h4a1 1 0 001-1v-1"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 15s-2-4-6-4H9c-4 0-6 4-6 4"></path>
                        <path d="M3 21h18a2 2 0 002-2v-1H1v1a2 2 0 002 2z"></path>
                        </svg>
                        <span class="ml-4">Usuarios</span>
                    </a>
                </li>

            </ul>
        </ul>
    </div>

    <div class="mt-auto px-6 mb-6">
        <div class="flex flex-col mb-4">
            <div class="bg-white dark:bg-gray-800 rounded-lg p-2 shadow-md">
                <p class="text-xs font-medium text-gray-500 dark:text-gray-400">¡Hola!</p>
                <p class="text-sm font-semibold text-gray-800 dark:text-gray-200">{{ auth()->user()->name }}</p>
                <p class="text-sm font-semibold text-gray-800 dark:text-gray-200">{{ auth()->user()->email }}</p>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="block w-full px-4 py-2 text-sm font-medium leading-5 mb-2 text-white transition-colors duration-150 bg-cyan-700 border border-transparent rounded-lg active:bg-blue-700 hover:bg-blue-700 focus:outline-none focus:shadow-outline-purple"
                style="margin-top: 10px;">
                Cerrar Sesión
            </button>
        </form>
    </div>
</div>
