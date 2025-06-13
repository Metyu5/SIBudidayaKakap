<?php
// teknisi/pages/jadwal.php
// Konten ini akan di-include di dashboard.php
// session_start(); // Jika diperlukan
// include '../config/database.php'; // Contoh koneksi database

// Contoh data statis tugas untuk demonstrasi
// Di dunia nyata, ini akan diambil dari database berdasarkan ID teknisi yang login
$daftar_tugas = [
    [
        'id' => 1,
        'id_tambak' => '1',
        'nama_tambak' => 'Tambak Harapan Jaya',
        'nama_tugas' => 'Cek Kualitas Air Pagi',
        'deskripsi' => 'Ambil sampel air, ukur suhu, pH, DO, Amonia, Nitrit. Catat hasilnya.',
        'tanggal_tugas' => '2025-06-13',
        'waktu_tugas' => '08:00',
        'prioritas' => 'Tinggi',
        'status_tugas' => 'Belum Selesai'
    ],
    [
        'id' => 2,
        'id_tambak' => '2',
        'nama_tambak' => 'Tambak Subur Makmur',
        'nama_tugas' => 'Pemberian Pakan Siang',
        'deskripsi' => 'Berikan pakan jenis Pelet Ikan Nila Premium, 3 kg. Amati nafsu makan ikan.',
        'tanggal_tugas' => '2025-06-13',
        'waktu_tugas' => '12:00',
        'prioritas' => 'Sedang',
        'status_tugas' => 'Sedang Dikerjakan'
    ],
    [
        'id' => 3,
        'id_tambak' => '1',
        'nama_tambak' => 'Tambak Harapan Jaya',
        'nama_tugas' => 'Observasi Kondisi Ikan Sore',
        'deskripsi' => 'Amati perilaku dan kondisi fisik ikan secara umum. Catat jika ada indikasi penyakit.',
        'tanggal_tugas' => '2025-06-13',
        'waktu_tugas' => '16:00',
        'prioritas' => 'Tinggi',
        'status_tugas' => 'Belum Selesai'
    ],
    [
        'id' => 4,
        'id_tambak' => '3',
        'nama_tambak' => 'Tambak Emas Biru',
        'nama_tugas' => 'Pembersihan Filter Air',
        'deskripsi' => 'Lakukan pembersihan rutin pada sistem filter air tambak.',
        'tanggal_tugas' => '2025-06-12',
        'waktu_tugas' => '14:00',
        'prioritas' => 'Rendah',
        'status_tugas' => 'Selesai'
    ]
];
?>

<div class="container mx-auto px-4 py-6">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Jadwal & Tugas Saya</h2>

    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Daftar Tugas Harian/Mingguan</h3>

        <form class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end mb-4">
            <div>
                <label for="filter_status_tugas" class="block text-sm font-medium text-gray-700">Filter Status</label>
                <select id="filter_status_tugas" name="status_tugas" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <option value="">Semua Status</option>
                    <option value="Belum Selesai">Belum Selesai</option>
                    <option value="Sedang Dikerjakan">Sedang Dikerjakan</option>
                    <option value="Selesai">Selesai</option>
                    <option value="Dibatalkan">Dibatalkan</option>
                </select>
            </div>
            <div>
                <label for="filter_tanggal_tugas" class="block text-sm font-medium text-gray-700">Tanggal Tugas</label>
                <input type="date" id="filter_tanggal_tugas" name="tanggal_tugas" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <div class="md:col-span-1 flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg flex items-center">
                    <i class="fas fa-filter mr-2"></i> Terapkan Filter
                </button>
            </div>
        </form>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead>
                    <tr class="bg-gray-100 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                        <th class="py-3 px-4 border-b">ID</th>
                        <th class="py-3 px-4 border-b">Tambak</th>
                        <th class="py-3 px-4 border-b">Tugas</th>
                        <th class="py-3 px-4 border-b">Deskripsi</th>
                        <th class="py-3 px-4 border-b">Tanggal & Waktu</th>
                        <th class="py-3 px-4 border-b">Prioritas</th>
                        <th class="py-3 px-4 border-b">Status</th>
                        <th class="py-3 px-4 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($daftar_tugas)): ?>
                        <?php foreach ($daftar_tugas as $tugas): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4 border-b border-gray-200"><?= htmlspecialchars($tugas['id']) ?></td>
                                <td class="py-3 px-4 border-b border-gray-200"><?= htmlspecialchars($tugas['nama_tambak']) ?></td>
                                <td class="py-3 px-4 border-b border-gray-200"><?= htmlspecialchars($tugas['nama_tugas']) ?></td>
                                <td class="py-3 px-4 border-b border-gray-200 text-sm"><?= htmlspecialchars($tugas['deskripsi']) ?></td>
                                <td class="py-3 px-4 border-b border-gray-200"><?= htmlspecialchars($tugas['tanggal_tugas']) ?> <?= htmlspecialchars($tugas['waktu_tugas']) ?></td>
                                <td class="py-3 px-4 border-b border-gray-200">
                                    <?php
                                    $prioritas_class = '';
                                    if ($tugas['prioritas'] === 'Tinggi') {
                                        $prioritas_class = 'bg-red-100 text-red-800';
                                    } elseif ($tugas['prioritas'] === 'Sedang') {
                                        $prioritas_class = 'bg-orange-100 text-orange-800';
                                    } else {
                                        $prioritas_class = 'bg-gray-100 text-gray-800';
                                    }
                                    ?>
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold <?= $prioritas_class ?>">
                                        <?= htmlspecialchars($tugas['prioritas']) ?>
                                    </span>
                                </td>
                                <td class="py-3 px-4 border-b border-gray-200">
                                    <?php
                                    $status_class = '';
                                    if ($tugas['status_tugas'] === 'Selesai') {
                                        $status_class = 'bg-green-100 text-green-800';
                                    } elseif ($tugas['status_tugas'] === 'Sedang Dikerjakan') {
                                        $status_class = 'bg-blue-100 text-blue-800';
                                    } elseif ($tugas['status_tugas'] === 'Belum Selesai') {
                                        $status_class = 'bg-orange-100 text-orange-800';
                                    } else {
                                        $status_class = 'bg-gray-100 text-gray-800';
                                    }
                                    ?>
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold <?= $status_class ?>">
                                        <?= htmlspecialchars($tugas['status_tugas']) ?>
                                    </span>
                                </td>
                                <td class="py-3 px-4 border-b border-gray-200">
                                    <?php if ($tugas['status_tugas'] !== 'Selesai'): ?>
                                        <button class="text-blue-600 hover:text-blue-900 mr-2" title="Update Status" onclick="alert('Ini akan mengupdate status tugas ID <?= $tugas['id'] ?>')">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    <?php else: ?>
                                        <span class="text-gray-400" title="Tugas Selesai"><i class="fas fa-check-circle"></i></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="py-4 px-4 text-center text-gray-500">Belum ada tugas yang ditetapkan untuk Anda.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>