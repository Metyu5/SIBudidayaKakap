<?php
// teknisi/pages/laporan_pakan.php
// Konten ini akan di-include di dashboard.php
// session_start(); // Jika diperlukan
// include '../config/database.php'; // Contoh koneksi database

// Contoh data statis laporan pemberian pakan untuk demonstrasi
$laporan_pemberian_pakan = [
    [
        'id' => 1,
        'id_tambak' => '1',
        'nama_tambak' => 'Tambak Harapan Jaya',
        'tanggal' => '2025-06-12',
        'waktu' => '08:30',
        'jenis_pakan' => 'Pelet Udang Prima',
        'jumlah_pakan_kg' => '2.5',
        'metode_pemberian' => 'Manual',
        'diobservasi_oleh' => 'Teknisi A',
        'keterangan' => 'Ikan merespon baik, pakan habis.'
    ],
    [
        'id' => 2,
        'id_tambak' => '2',
        'nama_tambak' => 'Tambak Subur Makmur',
        'tanggal' => '2025-06-12',
        'waktu' => '09:00',
        'jenis_pakan' => 'Pelet Ikan Nila Premium',
        'jumlah_pakan_kg' => '3.0',
        'metode_pemberian' => 'Otomatis',
        'diobservasi_oleh' => 'Teknisi A',
        'keterangan' => 'Sisa pakan sedikit, perlu penyesuaian jadwal.'
    ],
    [
        'id' => 3,
        'id_tambak' => '1',
        'nama_tambak' => 'Tambak Harapan Jaya',
        'tanggal' => '2025-06-11',
        'waktu' => '17:00',
        'jenis_pakan' => 'Pelet Udang Prima',
        'jumlah_pakan_kg' => '2.0',
        'metode_pemberian' => 'Manual',
        'diobservasi_oleh' => 'Teknisi B',
        'keterangan' => 'Normal.'
    ]
];
?>

<div class="container mx-auto px-4 py-6">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Laporan Harian Pemberian Pakan Ikan</h2>

    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Filter Laporan Pakan</h3>
        <form class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
            <div>
                <label for="filter_tambak_pakan" class="block text-sm font-medium text-gray-700">Pilih Tambak</label>
                <select id="filter_tambak_pakan" name="tambak_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <option value="">Semua Tambak</option>
                    <option value="1">Tambak Harapan Jaya</option>
                    <option value="2">Tambak Subur Makmur</option>
                    <option value="3">Tambak Emas Biru</option>
                </select>
            </div>
            <div>
                <label for="filter_tanggal_mulai_pakan" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                <input type="date" id="filter_tanggal_mulai_pakan" name="tanggal_mulai" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <div>
                <label for="filter_tanggal_akhir_pakan" class="block text-sm font-medium text-gray-700">Tanggal Akhir</label>
                <input type="date" id="filter_tanggal_akhir_pakan" name="tanggal_akhir" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <div class="md:col-span-3 flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg flex items-center">
                    <i class="fas fa-filter mr-2"></i> Terapkan Filter
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Riwayat Pemberian Pakan</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead>
                    <tr class="bg-gray-100 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                        <th class="py-3 px-4 border-b">ID</th>
                        <th class="py-3 px-4 border-b">Tambak</th>
                        <th class="py-3 px-4 border-b">Tanggal & Waktu</th>
                        <th class="py-3 px-4 border-b">Jenis Pakan</th>
                        <th class="py-3 px-4 border-b">Jumlah (Kg)</th>
                        <th class="py-3 px-4 border-b">Metode</th>
                        <th class="py-3 px-4 border-b">Oleh</th>
                        <th class="py-3 px-4 border-b">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($laporan_pemberian_pakan)): ?>
                        <?php foreach ($laporan_pemberian_pakan as $data): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4 border-b border-gray-200"><?= htmlspecialchars($data['id']) ?></td>
                                <td class="py-3 px-4 border-b border-gray-200"><?= htmlspecialchars($data['nama_tambak']) ?></td>
                                <td class="py-3 px-4 border-b border-gray-200"><?= htmlspecialchars($data['tanggal']) ?> <?= htmlspecialchars($data['waktu']) ?></td>
                                <td class="py-3 px-4 border-b border-gray-200"><?= htmlspecialchars($data['jenis_pakan']) ?></td>
                                <td class="py-3 px-4 border-b border-gray-200"><?= htmlspecialchars($data['jumlah_pakan_kg']) ?></td>
                                <td class="py-3 px-4 border-b border-gray-200"><?= htmlspecialchars($data['metode_pemberian']) ?></td>
                                <td class="py-3 px-4 border-b border-gray-200"><?= htmlspecialchars($data['diobservasi_oleh']) ?></td>
                                <td class="py-3 px-4 border-b border-gray-200 text-sm"><?= htmlspecialchars($data['keterangan']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="py-4 px-4 text-center text-gray-500">Belum ada data laporan pemberian pakan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>