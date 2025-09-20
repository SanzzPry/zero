<x-sidebar-dashboard>
    <x-slot:top>
        <x-sidebar-menu-dashboard routeName="dashboard" title="Dashboard" />
    </x-slot:top>

    <x-slot:middle>
        <x-sidebar-menu-dashboard routeName="pelamar.index" title="Data Pelamar" />
        <x-sidebar-menu-dashboard routeName="perusahaan.index" title="Data Perusahaan" />
        <x-sidebar-menu-dashboard routeName="finance.index" title="Finance" />
        <x-sidebar-menu-dashboard routeName="freeze.index" title="Akun Freeze" />
        <x-sidebar-menu-dashboard routeName="tips.index" title="Tips Kerja" />
        <x-sidebar-menu-dashboard routeName="event.index" title="Event" />
    </x-slot:middle>

    <x-slot:bottom>
        <x-sidebar-menu-dashboard routeName="akun.index" title="Akun" />
        <x-sidebar-menu-dashboard routeName="social.index" title="Link & Header" />
        <x-sidebar-menu-dashboard routeName="pengaturan.index" title="Pengaturan" />
    </x-slot:bottom>
</x-sidebar-dashboard>