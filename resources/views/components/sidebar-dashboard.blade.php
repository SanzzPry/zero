@props(['top' => '', 'middle' => '', 'bottom' => ''])

<body class="h-screen">
    <aside id="sidebar"
        class="fixed top-0 left-0 z-20 flex-col flex-shrink-0 hidden w-64 h-screen font-normal duration-75 lg:flex transition-width"
        aria-label="Sidebar">
        <div class="relative flex flex-col flex-1 min-h-0 pt-6 bg-orange-500 border-r border-gray-200">
            <div class="flex items-center justify-center h-16 border-b border-orange-400 pr-8">
                <img src="{{ asset('images/Logo-area_kerja-white.png') }}" alt="Logo" class="h-13 w-auto mr-2 pt-3">
                <span class="text-lg font-bold text-white">areakerja.com</span>
            </div>

            <div class="flex flex-col flex-1 pb-4 overflow-y-auto">
                <div class="flex-1 px-3 space-y-1 bg-orange-500 divide-y divide-orange-400">
                    <ul class="pb-2 space-y-2 text-white text-sm">

                        <li class="px-3 pt-2 text-xs font-semibold uppercase tracking-wider text-white/80">Umum</li>
                        {{ $top }}

                        <li class="px-3 pt-4 text-xs font-semibold uppercase tracking-wider text-white/80">Finance
                        </li>
                        {{ $middle }}

                        @if (Auth::check() && Auth::user()->role === 'superadmin')
                            <li class="px-3 pt-4 text-xs font-semibold uppercase tracking-wider text-white/80">Manajemen
                                Akun</li>
                            {{ $bottom }}
                        @endif
                        <li class="px-3 pt-4 mt-24 text-xs font-semibold uppercase tracking-wider text-white/80"></li>
                        {{ $bottom }}


                    </ul>
                </div>
            </div>
        </div>
    </aside>
</body>