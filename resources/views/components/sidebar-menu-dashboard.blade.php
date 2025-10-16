@props(['icon' => null, 'routeName' => null, 'title' => null])

<li>
    <a href="{{ route($routeName) }}" class="flex items-center p-2 text-base rounded-lg
              {{ request()->routeIs($routeName) ? 'bg-gray-100 text-black' : 'text-white hover:bg-gray-100 hover:text-black' }}
              group">
        {{ $icon }}
        <span class="ml-3" sidebar-toggle-item>{{ $title }}</span>
    </a>
</li>