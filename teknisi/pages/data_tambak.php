<?php
// teknisi/pages/data_tambak.php
// Konten ini akan di-include di dashboard.php
// session_start(); // Jika diperlukan
// include '../config/database.php'; // Contoh koneksi database

// Contoh data statis untuk demonstrasi
$tambaks = [
    [
        'id' => 1,
        'nama' => 'Tambak Harapan Jaya',
        'lokasi' => 'Desa Bahagia, Kec. Makmur',
        'luas' => '500 m²',
        'kapasitas_air' => '1000 m³',
        'status' => 'Aktif',
        'tanggal_pembentukan' => '2023-01-15'
    ],
    [
        'id' => 2,
        'nama' => 'Tambak Subur Makmur',
        'lokasi' => 'Jl. Ikan, No. 10, Kota Perikanan',
        'luas' => '750 m²',
        'kapasitas_air' => '1500 m³',
        'status' => 'Aktif',
        'tanggal_pembentukan' => '2023-03-20'
    ],
    [
        'id' => 3,
        'nama' => 'Tambak Emas Biru',
        'lokasi' => 'Pesisir Pantai Indah',
        'luas' => '400 m²',
        'kapasitas_air' => '800 m³',
        'status' => 'Perbaikan',
        'tanggal_pembentukan' => '2023-06-01'
    ]
];
?>

<div class="container mx-auto px-4 py-6">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Data Tambak</h2>

    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Daftar Tambak yang Anda Kelola</h3>

        <div class="flex justify-end mb-4">
            <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg flex items-center">
                <i class="fas fa-plus mr-2"></i> Tambah Tambak Baru
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead>
                    <tr class="bg-gray-100 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                        <th class="py-3 px-4 border-b">ID</th>
                        <th class="py-3 px-4 border-b">Nama Tambak</th>
                        <th class="py-3 px-4 border-b">Lokasi</th>
                        <th class="py-3 px-4 border-b">Luas</th>
                        <th class="py-3 px-4 border-b">Kapasitas Air</th>
                        <th class="py-3 px-4 border-b">Status</th>
                        <th class="py-3 px-4 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($tambaks)): ?>
                        <?php foreach ($tambaks as $tambak): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4 border-b border-gray-200"><?= htmlspecialchars($tambak['id']) ?></td>
                                <td class="py-3 px-4 border-b border-gray-200"><?= htmlspecialchars($tambak['nama']) ?></td>
                                <td class="py-3 px-4 border-b border-gray-200"><?= htmlspecialchars($tambak['lokasi']) ?></td>
                                <td class="py-3 px-4 border-b border-gray-200"><?= htmlspecialchars($tambak['luas']) ?></td>
                                <td class="py-3 px-4 border-b border-gray-200"><?= htmlspecialchars($tambak['kapasitas_air']) ?></td>
                                <td class="py-3 px-4 border-b border-gray-200">
                                    <?php
                                    $status_class = '';
                                    if ($tambak['status'] === 'Aktif') {
                                        $status_class = 'bg-green-100 text-green-800';
                                    } elseif ($tambak['status'] === 'Perbaikan') {
                                        $status_class = 'bg-yellow-100 text-yellow-800';
                                    } else {
                                        $status_class = 'bg-gray-100 text-gray-800';
                                    }
                                    ?>
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold <?= $status_class ?>">
                                        <?= htmlspecialchars($tambak['status']) ?>
                                    </span>
                                </td>
                                <td class="py-3 px-4 border-b border-gray-200">
                                    <button class="text-blue-600 hover:text-blue-900 mr-2" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="text-yellow-600 hover:text-yellow-900 mr-2" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-900" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="py-4 px-4 text-center text-gray-500">Belum ada data tambak.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>