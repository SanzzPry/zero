<nav class="absolute z-50 pt-4 right-0 left-64 bg-white ">
    <div class="px-6 py-5 flex items-center justify-between">
        <!-- Judul Halaman -->
        <h1 class="text-xl font-semibold text-black">@yield('title')</h1>

        <!-- Bagian Kanan -->
        <div class="flex items-center space-x-4">


            <!-- Profile Dropdown -->
            <div class="relative border-2 border-orange-400 rounded-xl px-3 py-1.5 shadow-md">
                <button id="profileBtn" class="flex items-center space-x-3 focus:outline-none">
                    <img src="{{ Auth::user()->superAdmin && Auth::user()->superAdmin->img_profile
    ? asset('storage/' . Auth::user()->superAdmin->img_profile)
    : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->username) . '&background=random' }}"
                        class="w-10 h-10 rounded-full object-cover" alt="User">


                    <div class="text-left hidden sm:block">
                        <p class="text-sm font-semibold text-gray-800">
                            {{ Auth::check() ? Auth::user()->username : 'Example' }}
                        </p>
                        <p class="text-xs text-gray-500">
                            {{ Auth::check() ? Auth::user()->email : 'example@gmail.com' }}
                        </p>
                    </div>
                    @if (Auth::check() && Auth::user()->role === 'superadmin')

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    @endif
                </button>
                @if (Auth::check() && Auth::user()->role === 'superadmin')

                    <!-- Dropdown -->
                    <div id="profileDropdown"
                        class="absolute right-0 hidden w-48 mt-2 bg-white border rounded-lg shadow-lg">
                        <a href="{{ route('profile') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                        <a href="{{ route('superAdmin.dashboard') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>


                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Logout
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</nav>

<script>
    const profileBtn = document.getElementById('profileBtn');
    const profileDropdown = document.getElementById('profileDropdown');

    profileBtn.addEventListener('click', () => {
        profileDropdown.classList.toggle('hidden');
    });

    // Tutup dropdown kalau klik di luar
    document.addEventListener('click', (event) => {
        if (!profileBtn.contains(event.target) && !profileDropdown.contains(event.target)) {
            profileDropdown.classList.add('hidden');
        }
    });
</script>