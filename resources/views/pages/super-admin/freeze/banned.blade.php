@extends('layouts.dashboard')
@section('title', 'Akun Freeze')

@section('content')

    <div class="px-24 py-8">


        <!-- Modal Konfirmasi -->
        <div id="confirmModal" class="fixed inset-0  hidden flex items-center justify-center z-50">
            <div class="bg-white rounded-2xl p-8 text-center shadow-lg w-[400px]">
                <div class="text-red-600 text-6xl mb-4">
                    <i class="fa-solid fa-exclamation-circle"></i>
                </div>
                <h2 class="text-xl font-semibold mb-4">Yakin akan membekukan akun ini?</h2>
                <div class="flex justify-center gap-4">
                    <button id="confirmYes"
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-md">Ya</button>
                    <button id="confirmNo"
                        class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-md">Tidak</button>
                </div>
            </div>
        </div>

        <!-- Modal Alasan -->
        <div id="reasonModal" class="fixed inset-0  hidden flex items-center justify-center z-50">
            <div class="bg-white rounded-2xl p-8 text-center shadow-lg w-[400px]">
                <h2 class="text-xl font-semibold mb-4">Masukkan Alasan</h2>
                <textarea id="banReason" name="alasan_freeze"
                    class="w-full border rounded-md p-2 mb-4 h-28 focus:ring-2 focus:ring-green-500 focus:outline-none"
                    placeholder="Masukkan alasan pembekuan akun..."></textarea>
                <button id="sendReason"
                    class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-md">Kirim</button>
            </div>
        </div>


        <!-- Card Utama -->
        <div class="bg-white border rounded-xl shadow-md overflow-hidden">

            <!-- Header: Foto + Tombol -->
            <div class="flex items-center justify-between px-10 py-6 border-b rounded-xl shadow-md/20">
                <!-- Foto -->
                <img src="{{ $user->img_profile ? asset('storage/' . $user->img_profile) : 'https://ui-avatars.com/api/?name=' . urlencode($user->username) . '&background=random' }}"
                    alt="Profile" class="w-24 h-24 rounded-full object-cover border">

                <div class="flex-1 flex justify-center gap-3">
                    <!-- Toggle banned/unbanned -->
                    <form action="{{ route('freeze.toggle', $user->id) }}" method="POST"
                        onsubmit="return confirmBan(event, '{{ $user->status }}')">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="alasan_freeze" id="alasan-ban">
                        <button type="submit"
                            class="{{ $user->status == 'banned' ? 'bg-green-600 hover:bg-green-700' : 'bg-yellow-600 hover:bg-yellow-700' }} text-white px-5 py-2 rounded-lg">
                            {{ $user->status == 'banned' ? 'Unbanned' : 'Banned' }}
                        </button>
                    </form>


                    <!-- Hapus akun -->
                    <form action="{{ route('freeze.destroy', $user->id) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin HAPUS akun ini secara permanen?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg">
                            Hapus Akun
                        </button>
                    </form>
                </div>

            </div>


            <!-- Info Section -->
            <div class="px-14 py-10 space-y-6">
                <!-- Row 1 -->
                <div class="bg-gray-200 text-center rounded-md py-2 text-gray-700 font-medium">
                    {{ $user->nama_pelamar }}
                </div>

                <!-- Row 2 -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-14">
                    <div class="bg-gray-200 text-center rounded-md py-2 text-gray-700">
                        {{ $user->kategori }}
                    </div>
                    <div class="bg-gray-200 text-center rounded-md py-2 text-gray-700">
                        {{ $user->teleponPelamar }}
                    </div>
                </div>

                <!-- Row 3 -->
                <div class="bg-gray-200 text-center rounded-md py-2 text-gray-700">
                    {{ $user->alamat ?? '-' }}
                </div>

                <!-- Row 4 -->
                <div class="bg-gray-200 rounded-md h-50 p-3 text-gray-700 overflow-auto">
                    {{ $user->alasan_freeze ?? '-' }}
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function confirmBan(event, status) {
        event.preventDefault(); // cegah submit langsung

        const confirmModal = document.getElementById('confirmModal');
        const reasonModal = document.getElementById('reasonModal');
        const confirmYes = document.getElementById('confirmYes');
        const confirmNo = document.getElementById('confirmNo');
        const sendReason = document.getElementById('sendReason');
        const alasanInput = document.getElementById('alasan-ban');
        const textarea = document.getElementById('banReason');

        const form = event.target;

        // kalau user sedang banned, langsung submit (unbanned)
        if (status === 'banned') {
            form.submit();
            return false;
        }

        // tampilkan modal konfirmasi
        confirmModal.classList.remove('hidden');

        // tombol Tidak → tutup modal
        confirmNo.onclick = () => {
            confirmModal.classList.add('hidden');
        };

        // tombol Ya → lanjut ke modal alasan
        confirmYes.onclick = () => {
            confirmModal.classList.add('hidden');
            reasonModal.classList.remove('hidden');
        };

        // tombol Kirim → ambil alasan dan submit form
        sendReason.onclick = () => {
            const reason = textarea.value.trim();
            if (reason === '') {
                alert('Alasan tidak boleh kosong.');
                return;
            }
            alasanInput.value = reason;
            reasonModal.classList.add('hidden');
            form.submit();
        };

        return false;
    }
</script>