@extends('layouts.dashboard')
@section('title', 'Tips Kerja')

@section('content')
    <div class="px-7 py-4">

        <!-- Header Filter -->
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-3 text-sm mb-4">
                <!-- Semua -->
                <a href="{{ route('tips.index') }}"
                    class="{{ $activeStatus == 'all' ? 'text-black font-semibold' : 'text-blue-600 hover:underline' }}">
                    Semua ({{ $countAll }})
                </a> |

                <!-- Published -->
                <a href="{{ route('tips.index', ['status' => 'terbit']) }}"
                    class="{{ $activeStatus == 'terbit' ? 'text-black font-semibold' : 'text-blue-600 hover:underline' }}">
                    Telah Terbit ({{ $countPublished }})
                </a> |

                <!-- Draft -->
                <a href="{{ route('tips.index', ['status' => 'belum terbit']) }}"
                    class="{{ $activeStatus == 'belum terbit' ? 'text-black font-semibold' : 'text-blue-600 hover:underline' }}">
                    Draf ({{ $countDraft }})
                </a>
            </div>


            <a href="{{ route('tips.create')}}"
                class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg shadow text-sm font-semibold">
                Buat Post
            </a>
        </div>

        <form action="{{ route('tips.deleteMultiple') }}" method="POST">
            @csrf
            <div class="flex items-center gap-3 mb-4">

                <!-- Filter tanggal -->
                <select name="sort"
                    class="rounded-lg border border-gray-300 px-3 py-1 focus:ring-orange-500 focus:border-orange-500">
                    <option value="">Tanggal</option>
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                </select>

                <!-- Tombol Terapkan filter (GET) -->
                <button type="submit" formmethod="GET" formaction="{{ route('tips.index') }}"
                    class="px-4 py-1 bg-gray-700 text-white rounded-lg shadow hover:bg-gray-800">Terapkan</button>

                <!-- Tombol Hapus (POST) -->
                <button type="submit"
                    class="px-4 py-1 bg-red-500 text-white rounded-lg shadow hover:bg-red-600">Hapus</button>

                <!-- Input Search -->
                <input type="text" name="search" value="{{ request('search') }}" placeholder="nama/tanggal..."
                    class="rounded-lg border border-gray-300 px-3 py-1 focus:ring-orange-500 focus:border-orange-500 ml-auto">

                <!-- Tombol Cari (GET) -->
                <button type="submit" formmethod="GET" formaction="{{ route('tips.index') }}"
                    class="px-8 py-1 bg-gray-700 text-white rounded-lg shadow hover:bg-gray-800">Cari</button>
            </div>

            <!-- Tabel Tips -->
            <div class="overflow-hidden rounded-md border border-gray-200">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="bg-orange-500 text-white">
                            <th class="px-4 py-3 text-left">
                                <input type="checkbox" id="select_all">
                            </th>
                            <th class="px-4 py-3 text-left font-semibold">Judul</th>
                            <th class="px-4 py-3 text-left font-semibold">Penulis</th>
                            <th class="px-4 py-3 text-left font-semibold">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($tips as $i => $tip)
                            <tr class="{{ $i % 2 == 0 ? 'bg-gray-100' : 'bg-gray-200' }}">
                                <td class="px-4 py-3">
                                    <input type="checkbox" name="selected_tips[]" value="{{ $tip->id }}">
                                </td>
                                <td class="px-4 py-3 text-blue-600 hover:underline cursor-pointer">
                                    <a href="{{ route('tips.show', $tip->id) }}">{{ $tip->title }}</a>
                                </td>
                                <td class="px-4 py-3">{{ $tip->penulis }}</td>
                                <td class="px-4 py-3">{{ $tip->created_at->format('d/m/Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>

    <script>
        // Select All checkbox
        document.getElementById('select_all').addEventListener('change', function (e) {
            const checkboxes = document.querySelectorAll('input[name="selected_tips[]"]');
            checkboxes.forEach(cb => cb.checked = e.target.checked);
        });
    </script>
@endsection