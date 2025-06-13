<?php
// teknisi/pages/laporan_air.php
// Konten ini akan di-include di dashboard.php
// session_start(); // Jika diperlukan
// include '../config/database.php'; // Contoh koneksi database

// Contoh data statis laporan kualitas air (bisa sama dengan data_kualitas_air tapi fokus pada laporan)
$laporan_kualitas_air = [
    [
        'id' => 1,
        'id_tambak' => '1',
        'nama_tambak' => 'Tambak Harapan Jaya',
        'tanggal' => '2025-06-12',
        'waktu' => '08:00',
        'suhu' => '28.5',
        'ph' => '7.8',
        'do' => '6.2',
        'amonia' => '0.05',
        'nitrit' => '0.02',
        'status_air' => 'Optimal' // Status berdasarkan parameter
    ],
    [
        'id' => 2,
        'id_tambak' => '2',
        'nama_tambak' => 'Tambak Subur Makmur',
        'tanggal' => '2025-06-12',
        'waktu' => '09:30',
        'suhu' => '29.1',
        'ph' => '8.1',
        'do' => '5.8',
        'amonia' => '0.10',
        'nitrit' => '0.04',
        'status_air' => 'Perlu Perhatian'
    ],
    [
        'id' => 3,
        'id_tambak' => '1',
        'nama_tambak' => 'Tambak Harapan Jaya',
        'tanggal' => '2025-06-11',
        'waktu' => '16:00',
        'suhu' => '27.9',
        'ph' => '7.7',
        'do' => '6.5',
        'amonia' => '0.04',
        'nitrit' => '0.01',
        'status_air' => 'Optimal'
    ]
];
?>

<div class="container mx-auto px-4 py-6">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Laporan Harian Kualitas Air</h2>

    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Filter Laporan</h3>
        <form class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
            <div>
                <label for="filter_tambak" class="block text-sm font-medium text-gray-700">Pilih Tambak</label>
                <select id="filter_tambak" name="tambak_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <option value="">Semua Tambak</option>
                    <option value="1">Tambak Harapan Jaya</option>
                    <option value="2">Tambak Subur Makmur</option>
                    <option value="3">Tambak Emas Biru</option>
                </select>
            </div>
            <div>
                <label for="filter_tanggal_mulai" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                <input type="date" id="filter_tanggal_mulai" name="tanggal_mulai" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <div>
                <label for="filter_tanggal_akhir" class="block text-sm font-medium text-gray-700">Tanggal Akhir</label>
                <input type="date" id="filter_tanggal_akhir" name="tanggal_akhir" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <div class="md:col-span-3 flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg flex items-center">
                    <i class="fas fa-filter mr-2"></i> Terapkan Filter
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Data Kualitas Air Terbaru</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead>
                    <tr class="bg-gray-100 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                        <th class="py-3 px-4 border-b">ID</th>
                        <th class="py-3 px-4 border-b">Tambak</th>
                        <th class="py-3 px-4 border-b">Tanggal & Waktu</th>
                        <th class="py-3 px-4 border-b">Suhu (°C)</th>
                        <th class="py-3 px-4 border-b">pH</th>
                        <th class="py-3 px-4 border-b">DO (mg/L)</th>
                        <th class="py-3 px-4 border-b">Amonia (mg/L)</th>
                        <th class="py-3 px-4 border-b">Nitrit (mg/L)</th>
                        <th class="py-3 px-4 border-b">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($laporan_kualitas_air)): ?>
                        <?php foreach ($laporan_kualitas_air as $data): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4 border-b border-gray-200"><?= htmlspecialchars($data['id']) ?></td>
                                <td class="py-3 px-4 border-b border-gray-200"><?= htmlspecialchars($data['nama_tambak']) ?></td>
                                <td class="py-3 px-4 border-b border-gray-200"><?= htmlspecialchars($data['tanggal']) ?> <?= htmlspecialchars($data['waktu']) ?></td>
                                <td class="py-3 px-4 border-b border-gray-200"><?= htmlspecialchars($data['suhu']) ?></td>
                                <td class="py-3 px-4 border-b border-gray-200"><?= htmlspecialchars($data['ph']) ?></td>
                                <td class="py-3 px-4 border-b border-gray-200"><?= htmlspecialchars($data['do']) ?></td>
                                <td class="py-3 px-4 border-b border-gray-200"><?= htmlspecialchars($data['amonia']) ?></td>
                                <td class="py-3 px-4 border-b border-gray-200"><?= htmlspecialchars($data['nitrit']) ?></td>
                                <td class="py-3 px-4 border-b border-gray-200">
                                    <?php
                                    $status_class = '';
                                    if ($data['status_air'] === 'Optimal') {
                                        $status_class = 'bg-green-100 text-green-800';
                                    } elseif ($data['status_air'] === 'Perlu Perhatian') {
                                        $status_class = 'bg-orange-100 text-orange-800';
                                    } else {
                                        $status_class = 'bg-red-100 text-red-800';
                                    }
                                    ?>
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold <?= $status_class ?>">
                                        <?= htmlspecialchars($data['status_air']) ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="py-4 px-4 text-center text-gray-500">Belum ada data laporan kualitas air.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>