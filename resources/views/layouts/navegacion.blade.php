<div class="py-4 text-gray-500 dark:text-gray-400 flex flex-col h-screen bg-blue-900">
    <div class="flex-grow">
        <a href="{{ route('dashboard') }}" class="flex justify-center items-center">
            <img class="h-40 w-48 object-contain" src="{{ asset('img/LogoNovaTech1.jpg') }}" alt="Logo">
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
                        <span class="ml-4">Educacion</span>
                    </span>
                </li>

                @auth
                    @if (auth()->user()->hasRole(['director']))
                        <li class="relative px-6 py-3">
                            <a class="inline-flex items-center w-full text-sm font-semibold text-white transition-colors duration-150 hover:text-blue-300 dark:hover:text-blue-200"
                                href="users">
                                {{-- href="{{ route('traductor.index')}}"> --}}
                                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="20"
                                    viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                                    <path fill=white
                                        d="M144 0a80 80 0 1 1 0 160A80 80 0 1 1 144 0zM512 0a80 80 0 1 1 0 160A80 80 0 1 1 512 0zM0 298.7C0 239.8 47.8 192 106.7 192h42.7c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0H21.3C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7h42.7C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3H405.3zM224 224a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zM128 485.3C128 411.7 187.7 352 261.3 352H378.7C452.3 352 512 411.7 512 485.3c0 14.7-11.9 26.7-26.7 26.7H154.7c-14.7 0-26.7-11.9-26.7-26.7z" />
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
                    @endif
                @endauth

                @auth
                    @if (auth()->user()->hasRole(['director', 'consejero']))
                        <li class="relative px-6 py-3">
                            <a class="inline-flex items-center w-full text-sm font-semibold text-white transition-colors duration-150 hover:text-blue-300 dark:hover:text-blue-200"
                                href="{{ route('cuestionarios.index') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="18"
                                    viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                                    <path fill=white
                                        d="M0 64C0 28.7 28.7 0 64 0H224V128c0 17.7 14.3 32 32 32H384V299.6l-94.7 94.7c-8.2 8.2-14 18.5-16.8 29.7l-15 60.1c-2.3 9.4-1.8 19 1.4 27.8H64c-35.3 0-64-28.7-64-64V64zm384 64H256V0L384 128zM549.8 235.7l14.4 14.4c15.6 15.6 15.6 40.9 0 56.6l-29.4 29.4-71-71 29.4-29.4c15.6-15.6 40.9-15.6 56.6 0zM311.9 417L441.1 287.8l71 71L382.9 487.9c-4.1 4.1-9.2 7-14.9 8.4l-60.1 15c-5.5 1.4-11.2-.2-15.2-4.2s-5.6-9.7-4.2-15.2l15-60.1c1.4-5.6 4.3-10.8 8.4-14.9z" />
                                </svg>
                                <span class="ml-4">Cuestionario</span>
                            </a>
                        </li>
                    @endif
                @endauth



                @auth
                    @if (auth()->user()->hasRole(['director', 'consejero']))
                        <li class="relative px-6 py-3">
                            <a class="inline-flex items-center w-full text-sm font-semibold text-white transition-colors duration-150 hover:text-blue-300 dark:hover:text-blue-200"
                                {{-- href="#"> --}} href="{{ route('preguntas.index') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="10"
                                    viewBox="0 0 320 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                                    <path fill=white
                                        d="M80 160c0-35.3 28.7-64 64-64h32c35.3 0 64 28.7 64 64v3.6c0 21.8-11.1 42.1-29.4 53.8l-42.2 27.1c-25.2 16.2-40.4 44.1-40.4 74V320c0 17.7 14.3 32 32 32s32-14.3 32-32v-1.4c0-8.2 4.2-15.8 11-20.2l42.2-27.1c36.6-23.6 58.8-64.1 58.8-107.7V160c0-70.7-57.3-128-128-128H144C73.3 32 16 89.3 16 160c0 17.7 14.3 32 32 32s32-14.3 32-32zm80 320a40 40 0 1 0 0-80 40 40 0 1 0 0 80z" />
                                </svg>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 17v1a1 1 0 001 1h4a1 1 0 001-1v-1"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 15s-2-4-6-4H9c-4 0-6 4-6 4"></path>
                                <path d="M3 21h18a2 2 0 002-2v-1H1v1a2 2 0 002 2z"></path>
                                </svg>
                                <span class="ml-4">Preguntas</span>
                            </a>
                        </li>
                    @endif
                @endauth

                <li class="relative px-6 py-3">
                    <a class="inline-flex items-center w-full text-sm font-semibold text-white transition-colors duration-150 hover:text-blue-300 dark:hover:text-blue-200"
                        {{-- href="#"> --}} href="{{ route('responder.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" height="16" width="12"
                            viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                            <path fill=white
                                d="M192 0c-41.8 0-77.4 26.7-90.5 64H64C28.7 64 0 92.7 0 128V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V128c0-35.3-28.7-64-64-64H282.5C269.4 26.7 233.8 0 192 0zm0 64a32 32 0 1 1 0 64 32 32 0 1 1 0-64zM105.8 229.3c7.9-22.3 29.1-37.3 52.8-37.3h58.3c34.9 0 63.1 28.3 63.1 63.1c0 22.6-12.1 43.5-31.7 54.8L216 328.4c-.2 13-10.9 23.6-24 23.6c-13.3 0-24-10.7-24-24V314.5c0-8.6 4.6-16.5 12.1-20.8l44.3-25.4c4.7-2.7 7.6-7.7 7.6-13.1c0-8.4-6.8-15.1-15.1-15.1H158.6c-3.4 0-6.4 2.1-7.5 5.3l-.4 1.2c-4.4 12.5-18.2 19-30.6 14.6s-19-18.2-14.6-30.6l.4-1.2zM160 416a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z" />
                        </svg>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17v1a1 1 0 001 1h4a1 1 0 001-1v-1"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 15s-2-4-6-4H9c-4 0-6 4-6 4"></path>
                        <path d="M3 21h18a2 2 0 002-2v-1H1v1a2 2 0 002 2z"></path>
                        </svg>
                        <span class="ml-4">Mis Cuestionarios</span>
                    </a>
                </li>

                <li class="relative px-6 py-3">
                    <a class="inline-flex items-center w-full text-sm font-semibold text-white transition-colors duration-150 hover:text-blue-300 dark:hover:text-blue-200"
                        {{-- href="#"> --}} href="{{ route('perfilEmocional.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14"
                            viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                            <path fill=white
                                d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z" />
                        </svg>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17v1a1 1 0 001 1h4a1 1 0 001-1v-1"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 15s-2-4-6-4H9c-4 0-6 4-6 4"></path>
                        <path d="M3 21h18a2 2 0 002-2v-1H1v1a2 2 0 002 2z"></path>
                        </svg>
                        <span class="ml-4">Perfil Emocional</span>
                    </a>
                </li>

                @auth
                    @if (auth()->user()->hasRole(['director', 'consejero']))
                        <li class="relative px-6 py-3">
                            <a class="inline-flex items-center w-full text-sm font-semibold text-white transition-colors duration-150 hover:text-blue-300 dark:hover:text-blue-200"
                                href="{{ route('sesiones.index') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14"
                                    viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                                    <path
                                        fill=white d="M96 32V64H48C21.5 64 0 85.5 0 112v48H448V112c0-26.5-21.5-48-48-48H352V32c0-17.7-14.3-32-32-32s-32 14.3-32 32V64H160V32c0-17.7-14.3-32-32-32S96 14.3 96 32zM448 192H0V464c0 26.5 21.5 48 48 48H400c26.5 0 48-21.5 48-48V192zM224 248c13.3 0 24 10.7 24 24v56h56c13.3 0 24 10.7 24 24s-10.7 24-24 24H248v56c0 13.3-10.7 24-24 24s-24-10.7-24-24V376H144c-13.3 0-24-10.7-24-24s10.7-24 24-24h56V272c0-13.3 10.7-24 24-24z" />
                                </svg>
                                <span class="ml-4">Sesiones de Apoyo</span>
                            </a>
                        </li>
                    @endif
                @endauth

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
