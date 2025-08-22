<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Total Books -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-gray-600 text-sm">Total Buku</div>
                        <div class="text-3xl font-bold">{{ $stats['total_books'] }}</div>
                    </div>
                </div>

                <!-- Total Members -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-gray-600 text-sm">Total Anggota</div>
                        <div class="text-3xl font-bold">{{ $stats['total_members'] }}</div>
                    </div>
                </div>

                <!-- Active Loans -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-gray-600 text-sm">Peminjaman Aktif</div>
                        <div class="text-3xl font-bold">{{ $stats['active_loans'] }}</div>
                    </div>
                </div>

                <!-- Overdue Loans -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-gray-600 text-sm">Peminjaman Terlambat</div>
                        <div class="text-3xl font-bold text-red-600">{{ $stats['overdue_loans'] }}</div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Aksi Cepat</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <a href="{{ route('books.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700">
                            Tambah Buku
                        </a>
                        <a href="{{ route('members.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700">
                            Tambah Anggota
                        </a>
                        <a href="{{ route('loans.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700">
                            Peminjaman Baru
                        </a>
                        <a href="{{ route('loans.index') }}?status=overdue" class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-500">
                            Lihat Keterlambatan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
