@extends('layouts.finance')

@section('title', 'Paket Harga')
@section('content')
    <div class="px-6 py-6">
        <div class="px-24">
            <div class="flex justify-between mb-2">
                <div>
                    <h2 class="text-lg font-semibold">Paket Harga Koin</h2>
                </div>
                <a onclick="openOverlay('editKoinOverlay')"
                    class="cursor-pointer inline-flex items-center px-6 bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium rounded-xl shadow">
                    Edit
                </a>
            </div>
            <div class="bg-white border border-gray-300 mb-6 rounded-xl shadow overflow-hidden">
                <table class="w-full table-auto border-collapse">
                    <thead class="bg-orange-500 text-white">
                        <tr>
                            <th class="px-12 py-3 text-left ">Nama</th>
                            <th class="px-10 py-3 text-right">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pakets->where('id', '<=', 6) as $paket)
                            <tr>
                                <td class="border-b border-gray-300 px-8 py-3">{{ $paket->nama }}</td>
                                <td class="border-b border-gray-300 px-8 py-3 text-right">{{ $paket->jumlah_koin }} koin</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="flex justify-between mb-2">
                <div>
                    <h2 class="text-lg font-semibold">Paket Harga Koin</h2>
                </div>
                <a onclick="openOverlay('editTunaiOverlay')"
                    class="cursor-pointer inline-flex items-center px-6 bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium rounded-xl shadow">
                    Edit
                </a>
            </div>
            <div class="bg-white border border-gray-300 mb-6 rounded-xl shadow overflow-hidden">
                <table class="w-full table-auto border-collapse">
                    <thead class="bg-orange-500 text-white">
                        <tr>
                            <th class="px-12 py-3 text-left ">Nama</th>
                            <th class="px-10 py-3 text-right">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pakets->where('id', '>', 6) as $paket)
                            <tr>
                                <td class="border-b border-gray-300 px-8 py-3">{{ $paket->nama }}</td>
                                <td class="border-b border-gray-300 px-8 py-3 text-right">Rp.
                                    {{ number_format($paket->harga, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


            {{-- ================== OVERLAY EDIT KOIN ================== --}}
            <div id="editKoinOverlay"
                class="fixed inset-0 bg-black bg-opacity-60 hidden flex items-center justify-center z-50">
                <form action="{{ route('paket.update') }}" method="POST" class="bg-white rounded-2xl w-[600px] p-6">
                    @csrf
                    @method('PUT')

                    <h2 class="text-lg font-semibold mb-4">Edit Paket Harga Koin</h2>
                    <table class="w-full border-collapse border border-gray-200 rounded-lg overflow-hidden mb-4">
                        <thead class="bg-orange-500 text-white">
                            <tr>
                                <th class="px-6 py-2 text-left">Nama</th>
                                <th class="px-6 py-2 text-right">Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pakets->where('id', '<=', 6) as $paket)
                                <tr>
                                    <td class="border-b border-gray-300 px-6 py-3">{{ $paket->nama }}</td>
                                    <td class="border-b border-gray-300 px-6 py-3 text-right">
                                        <input type="number" name="jumlah_koin[{{ $paket->id }}]"
                                            value="{{ $paket->jumlah_koin }}"
                                            class="border rounded-md px-3 py-1 w-24 text-right focus:outline-none focus:ring-2 focus:ring-orange-400">
                                        <span class="text-gray-600 text-sm">Koin</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="flex justify-center">
                        <button type="submit"
                            class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-2 rounded-full font-medium">
                            Selesai
                        </button>
                    </div>
                </form>
            </div>

            {{-- ================== OVERLAY EDIT TUNAI ================== --}}
            <div id="editTunaiOverlay"
                class="fixed inset-0 bg-black bg-opacity-60 hidden flex items-center justify-center z-50">
                <form action="{{ route('paket.update') }}" method="POST" class="bg-white rounded-2xl w-[600px] p-6">
                    @csrf
                    @method('PUT')

                    <h2 class="text-lg font-semibold mb-4">Edit Paket Harga Tunai</h2>
                    <table class="w-full border-collapse border border-gray-200 rounded-lg overflow-hidden mb-4">
                        <thead class="bg-orange-500 text-white">
                            <tr>
                                <th class="px-6 py-2 text-left">Nama</th>
                                <th class="px-6 py-2 text-right">Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pakets->where('id', '>', 6) as $paket)
                                <tr>
                                    <td class="border-b border-gray-300 px-6 py-3">{{ $paket->nama }}</td>
                                    <td class="border-b border-gray-300 px-6 py-3 text-right">
                                        <input type="number" name="harga[{{ $paket->id }}]" value="{{ $paket->harga }}"
                                            class="border rounded-md px-3 py-1 w-32 text-right focus:outline-none focus:ring-2 focus:ring-orange-400">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="flex justify-center">
                        <button type="submit"
                            class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-2 rounded-full font-medium">
                            Selesai
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>function openOverlay(id) {
            document.getElementById(id).classList.remove('hidden');
        }
        function closeOverlay(id) {
            document.getElementById(id).classList.add('hidden');
        }</script>
@endsection