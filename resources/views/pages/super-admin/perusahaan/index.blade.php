@extends('layouts.dashboard')
@section('title', 'Data Perusahaan')

@section('content')
        <div class="px-8 py-6">
            <div class="flex justify-between mb-6">
                <div class="flex items-center gap-2">
                    <a id="addButton" href="{{ route('perusahaan.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium rounded-md shadow">
                        +
                    </a>
                    <a href="{{ route('perusahaan.index', [
        'sort' => request('sort') === 'oldest' ? 'latest' : 'oldest',
        'section' => request('section', 'perusahaan')
    ]) }}" class="cursor-pointer inline-flex items-center px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium rounded-md shadow">
                        @if (request('sort') === 'oldest')
                            ↓
                        @else
                            ↑
                        @endif
                    </a>

                    <select id="sectionFilter"
                        class="px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium rounded-lg shadow cursor-pointer">
                        <option value="perusahaan">Perusahaan</option>
                        <option value="recruitment">Recruitment</option>
                        <option value="talent">Talent Hunter</option>
                        <option value="panggilan">Panggilan</option>
                    </select>
                </div>

                <form action="{{ route('perusahaan.index') }}" method="GET" class="flex space-x-2">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="cari.."
                        class="w-64 px-4 py-2 text-sm border rounded-md focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-400">

                    <button type="submit"
                        class="px-8 py-2 bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium rounded-md shadow">
                        Cari
                    </button>
                </form>
            </div>

            <!-- -----------------------PERUSAHAAN------------------------ -->
            <div id="perusahaan" class="section">
                <div class="bg-white border border-gray-300 rounded-3xl shadow overflow-hidden">
                    <table class="w-full table-auto border-collapse">
                        <thead>
                            <tr class="text-center">
                                <th class="px-6 pt-6 pb-3">ID</th>
                                <th class="px-6 pt-6 pb-3">Nama Perusahaan</th>
                                <th class="px-6 pt-6 pb-3">Email</th>
                                <th class="px-6 pt-6 pb-3">Telepon</th>
                                <th class="px-6 pt-6 pb-3">Legalitas</th>
                                <th class="px-6 pt-6 pb-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr class="hover:bg-gray-50 border-b-2 border-gray-300 text-center">
                                    <td class="px-4 py-2">{{ $user->id }}</td>
                                    <td class="px-4 py-2">{{ $user->namaPerusahaan }}</td>
                                    <td class="px-4 py-2">{{ $user->user->email ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $user->teleponPerusahaan ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $user->legalitas }}</td>
                                    <td class="px-4 py-2 space-x-1">
                                        <a href="{{ route('perusahaan.show', $user->id) }}"
                                            class="inline-flex items-center justify-center w-8 h-8 rounded-md bg-orange-500 hover:bg-orange-600 text-white">
                                            <i class="fas fa-eye text-xs"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-4 text-center text-gray-500">
                                        Tidak ada data perusahaan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>


            <div id="recruitment" class="section hidden">
                <div class="bg-white border border-gray-300 rounded-3xl shadow overflow-hidden">
                    <div class="px-5">
                        <table class="w-full table-auto border-collapse">
                            <thead>
                                <tr class="text-center">
                                    <th class="px-6 pt-6 pb-12">ID</th>
                                    <th class="px-6 pt-6 pb-12">Nama</th>
                                    <th class="px-6 pt-6 pb-12">Pendidikan</th>
                                    <th class="px-6 pt-6 pb-12">Skill</th>
                                    <th class="px-6 pt-6 pb-12">Alamat</th>
                                    <th class="px-6 pt-6 pb-12">Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pelamars as $user)
                                    <tr class="hover:bg-gray-50 border-b-2 border-gray-300 text-center">
                                        <td class="px-4 py-2">{{ $user->id}}</td>
                                        <td class="px-4 py-2">{{ $user->nama_pelamar }}</td>
                                        <td class="px-4 py-2">
                                            @if ($user->riwayatPendidikans->isNotEmpty())
                                                <span>{{ $user->riwayatPendidikans->first()->pendidikan }}
                                                    ({{ $user->riwayatPendidikans->first()->jurusan }})</span>
                                            @endif
                                        </td>

                                        <td class="px-4 py-2">
                                            {{ optional($user->skills->first())->skill ?? '-' }}
                                        </td>

                                        <td class="px-4 py-2">{{ $user->alamat ?? '-' }}</td>
                                        <td class="px-4 py-2 space-x-1">
                                            <!-- Tombol Aksi -->
                                            @php
        $kategori = request('kategori');
                                            @endphp

                                            <a href="{{ $kategori === 'calon kandidat' ? route('kandidatToPelamar.index', $user->id) : route('pelamar.show', $user->id) }}"
                                                class="inline-flex items-center justify-center w-8 h-8 rounded-md bg-orange-500 hover:bg-orange-600 text-white">
                                                <i class="fas fa-eye text-xs"></i>
                                            </a>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


                <!-- -----------------------TALENT HUNTER------------------------ -->
                <div id="talent" class="section hidden">
                    <div class="bg-white border border-gray-300 rounded-3xl shadow overflow-hidden">
                        <table class="w-full table-auto border-collapse">
                            <thead>
                                <tr class="text-center">
                                    <th class="px-6 pt-6 pb-3">ID</th>
                                    <th class="px-6 pt-6 pb-3">Nama Perusahaan</th>
                                    <th class="px-6 pt-6 pb-3">Email</th>
                                    <th class="px-6 pt-6 pb-3">Telepon</th>
                                    <th class="px-6 pt-6 pb-3">Posisi</th>
                                    <th class="px-6 pt-6 pb-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $perusahaan)
                                    @foreach ($perusahaan->talent as $talent)
                                        <tr class="hover:bg-gray-50 border-b-2 border-gray-300 text-center">
                                            <td class="px-4 py-2">{{ $talent->id }}</td>
                                            <td class="px-4 py-2">{{ $perusahaan->namaPerusahaan ?? '-' }}</td>
                                            <td class="px-4 py-2">{{ $talent->perusahaan->user->email ?? '-' }}</td>
                                            <td class="px-4 py-2">{{ $perusahaan->teleponPerusahaan ?? '-' }}</td>
                                            <td class="px-4 py-2">{{ $talent->posisi ?? '-' }}</td>
                                            <td class="px-4 py-2 space-x-1">
                                                <a href="{{ route('talent.show', $talent->id) }}"
                                                    class="inline-flex items-center justify-center w-8 h-8 rounded-md bg-orange-500 hover:bg-orange-600 text-white">
                                                    <i class="fas fa-eye text-xs"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @empty
                                    <tr>
                                        <td colspan="6" class="py-4 text-center text-gray-500">
                                            Tidak ada data talent.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>
                </div>


                <!-- -----------------------PANGGILAN------------------------ -->
                <div id="panggilan" class="section hidden">
                    <div class="bg-white border border-gray-300 rounded-3xl shadow overflow-hidden">
                        <table class="w-full table-auto border-collapse">
                            <thead>
                                <tr class="text-center">
                                    <th class="px-6 pt-6 pb-3">ID</th>
                                    <th class="px-6 pt-6 pb-3">Nama Perusahaan</th>
                                    <th class="px-6 pt-6 pb-3">Email</th>
                                    <th class="px-6 pt-6 pb-3">Telepon</th>
                                    <th class="px-6 pt-6 pb-3">Kepentingan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr class="hover:bg-gray-50 border-b-2 border-gray-300 text-center">
                                        <td class="px-4 py-2">{{ $user->id }}</td>
                                        <td class="px-4 py-2">{{ $user->namaPerusahaan }}</td>
                                        <td class="px-4 py-2">{{ $user->user->email ?? '-' }}</td>
                                        <td class="px-4 py-2">{{ $user->teleponPerusahaan ?? '-' }}</td>
                                        <td class="px-4 py-2">{{ $user->panggilan->jenis_panggilan ?? '-'}}</td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="py-4 text-center text-gray-500">
                                            Tidak ada data perusahaan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const filter = document.getElementById('sectionFilter');
                    const addButton = document.getElementById('addButton');
                    const currentSection = localStorage.getItem('activeSection') || 'perusahaan';

                    const sections = document.querySelectorAll('.section');

                    // Semua route create disiapin di sini
                    const routes = {
                        perusahaan: "{{ route('perusahaan.create') }}",
                        talent: "{{ route('talent.create', ['perusahaan_id' => $users->first()->id ?? 0]) }}",
                        recruitment: "#",
                        panggilan: "#",
                    };


                    // Fungsi buat ganti section
                    function switchSection(section) {
                        sections.forEach(s => s.classList.add('hidden'));
                        document.getElementById(section).classList.remove('hidden');
                        addButton.href = routes[section] || "#";
                        localStorage.setItem('activeSection', section);
                    }



                    // Apply section aktif dari localStorage (biar gak reset pas reload)
                    switchSection(currentSection);
                    filter.value = currentSection;

                    // Ubah section saat dropdown berubah
                    filter.addEventListener('change', function () {
                        const selected = this.value;
                        switchSection(selected);
                    });
                });
            </script>



@endsection
