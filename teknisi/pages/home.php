<?php
// teknisi/pages/home.php
// Konten ini akan di-include di dashboard.php
// Pastikan sesi sudah dimulai di dashboard.php atau cek di sini jika diperlukan
// session_start();
?>

<div class="container mx-auto px-4 py-6">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Selamat Datang, Teknisi!</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Jumlah Tambak</p>
                <p class="text-2xl font-semibold text-gray-900">5</p>
            </div>
            <div class="p-3 bg-blue-100 rounded-full text-blue-600">
                <i class="fas fa-warehouse text-xl"></i>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Tugas Hari Ini</p>
                <p class="text-2xl font-semibold text-gray-900">3</p>
            </div>
            <div class="p-3 bg-green-100 rounded-full text-green-600">
                <i class="fas fa-clipboard-list text-xl"></i>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Perlu Perhatian</p>
                <p class="text-2xl font-semibold text-red-600">1</p>
            </div>
            <div class="p-3 bg-red-100 rounded-full text-red-600">
                <i class="fas fa-exclamation-triangle text-xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Pembaruan & Notifikasi</h3>
        <ul class="space-y-3">
            <li class="flex items-start text-gray-700">
                <i class="fas fa-circle-info text-blue-500 mt-1 mr-3"></i>
                <div>
                    <p class="font-medium">Laporan kualitas air Tambak A belum diisi hari ini.</p>
                    <p class="text-sm text-gray-500">10 menit yang lalu</p>
                </div>
            </li>
            <li class="flex items-start text-gray-700">
                <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                <div>
                    <p class="font-medium">Pemberian pakan Tambak B selesai.</p>
                    <p class="text-sm text-gray-500">2 jam yang lalu</p>
                </div>
            </li>
            <li class="flex items-start text-gray-700">
                <i class="fas fa-triangle-exclamation text-yellow-500 mt-1 mr-3"></i>
                <div>
                    <p class="font-medium">Suhu air di Tambak C sedikit naik. Mohon periksa kembali.</p>
                    <p class="text-sm text-gray-500">Kemarin</p>
                </div>
            </li>
        </ul>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Jadwal Tugas Mendatang</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="bg-gray-100 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                        <th class="py-3 px-4 border-b border-gray-200">Tambak</th>
                        <th class="py-3 px-4 border-b border-gray-200">Tugas</th>
                        <th class="py-3 px-4 border-b border-gray-200">Waktu</th>
                        <th class="py-3 px-4 border-b border-gray-200">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-4 border-b border-gray-200">Tambak A</td>
                        <td class="py-3 px-4 border-b border-gray-200">Cek Kualitas Air</td>
                        <td class="py-3 px-4 border-b border-gray-200">08:00 WIB</td>
                        <td class="py-3 px-4 border-b border-gray-200"><span class="px-2 py-1 text-xs font-semibold text-orange-600 bg-orange-100 rounded-full">Pending</span></td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-4 border-b border-gray-200">Tambak B</td>
                        <td class="py-3 px-4 border-b border-gray-200">Beri Pakan Pagi</td>
                        <td class="py-3 px-4 border-b border-gray-200">08:30 WIB</td>
                        <td class="py-3 px-4 border-b border-gray-200"><span class="px-2 py-1 text-xs font-semibold text-green-600 bg-green-100 rounded-full">Selesai</span></td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-4 border-b border-gray-200">Tambak C</td>
                        <td class="py-3 px-4 border-b border-gray-200">Periksa Kesehatan Ikan</td>
                        <td class="py-3 px-4 border-b border-gray-200">10:00 WIB</td>
                        <td class="py-3 px-4 border-b border-gray-200"><span class="px-2 py-1 text-xs font-semibold text-red-600 bg-red-100 rounded-full">Terlambat</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>