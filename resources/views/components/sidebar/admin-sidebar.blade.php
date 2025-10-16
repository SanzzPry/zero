<x-sidebar-dashboard>
    <x-slot:top>
        <x-sidebar-menu-dashboard routeName="superAdmin.dashboard" title="Dashboard">
            <x-slot:icon>
                <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
            </x-slot:icon>
        </x-sidebar-menu-dashboard>
    </x-slot:top>

    <x-slot:middle>
        <x-sidebar-menu-dashboard routeName="pelamar.index" title="Data Pelamar">
            <x-slot:icon>
                <i data-lucide="users" class="w-5 h-5"></i>
            </x-slot:icon>
        </x-sidebar-menu-dashboard>

        <x-sidebar-menu-dashboard routeName="perusahaan.index" title="Data Perusahaan">
            <x-slot:icon>
                <i data-lucide="building-2" class="w-5 h-5"></i>
            </x-slot:icon>
        </x-sidebar-menu-dashboard>

        <x-sidebar-menu-dashboard routeName="finance.index" title="Finance">
            <x-slot:icon>
                <i data-lucide="wallet" class="w-5 h-5"></i>
            </x-slot:icon>
        </x-sidebar-menu-dashboard>

        <x-sidebar-menu-dashboard routeName="freeze.index" title="Akun Freeze">
            <x-slot:icon>
                <i data-lucide="snowflake" class="w-5 h-5"></i>
            </x-slot:icon>
        </x-sidebar-menu-dashboard>

        <x-sidebar-menu-dashboard routeName="tips.index" title="Tips Kerja">
            <x-slot:icon>
                <i data-lucide="lightbulb" class="w-5 h-5"></i>
            </x-slot:icon>
        </x-sidebar-menu-dashboard>

        <x-sidebar-menu-dashboard routeName="event.index" title="Event">
            <x-slot:icon>
                <i data-lucide="calendar" class="w-5 h-5"></i>
            </x-slot:icon>
        </x-sidebar-menu-dashboard>
    </x-slot:middle>

    <x-slot:bottom>
        <x-sidebar-menu-dashboard routeName="akun.index" title="Akun">
            <x-slot:icon>
                <i data-lucide="user-cog" class="w-5 h-5"></i>
            </x-slot:icon>
        </x-sidebar-menu-dashboard>

        <x-sidebar-menu-dashboard routeName="social.index" title="Link & Header">
            <x-slot:icon>
                <i data-lucide="link-2" class="w-5 h-5"></i>
            </x-slot:icon>
        </x-sidebar-menu-dashboard>

        <x-sidebar-menu-dashboard routeName="pengaturan.index" title="Pengaturan">
            <x-slot:icon>
                <i data-lucide="settings" class="w-5 h-5"></i>
            </x-slot:icon>
        </x-sidebar-menu-dashboard>
    </x-slot:bottom>
</x-sidebar-dashboard>