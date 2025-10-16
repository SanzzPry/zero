<x-sidebar-dashboard>
    <x-slot:top>
        <x-sidebar-menu-dashboard routeName="finance.dashboard" title="Dashboard">
            <x-slot:icon>
                <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
            </x-slot:icon>
        </x-sidebar-menu-dashboard>
    </x-slot:top>

    <x-slot:middle>
        <x-sidebar-menu-dashboard routeName="paket.index" title="Paket Harga">
            <x-slot:icon>
                <i data-lucide="package" class="w-5 h-5"></i>
            </x-slot:icon>
        </x-sidebar-menu-dashboard>

        <x-sidebar-menu-dashboard routeName="omset.index" title="Omset Perusahaan">
            <x-slot:icon>
                <i data-lucide="bar-chart-3" class="w-5 h-5"></i>
            </x-slot:icon>
        </x-sidebar-menu-dashboard>

        <x-sidebar-menu-dashboard routeName="catatan.index" title="Catatan Transaksi">
            <x-slot:icon>
                <i data-lucide="file-text" class="w-5 h-5"></i>
            </x-slot:icon>
        </x-sidebar-menu-dashboard>

        <x-sidebar-menu-dashboard routeName="laporan.index" title="Laporan Transaksi">
            <x-slot:icon>
                <i data-lucide="clipboard-list" class="w-5 h-5"></i>
            </x-slot:icon>
        </x-sidebar-menu-dashboard>
    </x-slot:middle>

    <x-slot:bottom>
        <button id="logoutBtn" class="w-full flex items-center gap-2 px-4 py-2 text-sm text-white hover:text-gray-200">
            <i data-lucide="log-out" class="w-5 h-5"></i>
            Logout
        </button>

        {{-- Modal Konfirmasi Logout --}}
        <div id="logoutModal" class="hidden fixed inset-0 flex items-center justify-center z-50">
            <div class="bg-white rounded-xl shadow-lg p-6 w-80 text-center">
                <h2 class="text-lg font-semibold text-gray-800 mb-2">Konfirmasi Keluar</h2>
                <p class="text-sm text-gray-600 mb-5">Apakah kamu yakin ingin keluar?</p>
                <div class="flex justify-center gap-3">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition">Keluar</button>
                    </form>
                    <button id="cancelLogout"
                        class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition">Batal</button>
                </div>
            </div>
        </div>

        <script>
            const logoutBtn = document.getElementById('logoutBtn');
            const logoutModal = document.getElementById('logoutModal');
            const cancelLogout = document.getElementById('cancelLogout');

            logoutBtn.addEventListener('click', () => {
                logoutModal.classList.remove('hidden');
            });

            cancelLogout.addEventListener('click', () => {
                logoutModal.classList.add('hidden');
            });
        </script>
    </x-slot:bottom>

</x-sidebar-dashboard>