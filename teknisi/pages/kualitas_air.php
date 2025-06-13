<?php
// teknisi/pages/kualitas_air.php
// Konten ini akan di-include di dashboard.php
// session_start(); // Jika diperlukan
// include '../config/database.php'; // Contoh koneksi database

// Contoh data statis kualitas air untuk demonstrasi
$data_kualitas_air = [
    [
        'id' => 1,
        'id_tambak' => '1',
        'nama_tambak' => 'Tambak Harapan Jaya',
        'tanggal' => '2025-06-12',
        'waktu' => '08:00',
        'suhu' => '28.5',
        'ph' => '7.8',
        'do' => '6.2', // Dissolved Oxygen
        'amonia' => '0.05',
        'nitrit' => '0.02',
        'keterangan' => 'Kondisi stabil.'
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
        'keterangan' => 'pH agak tinggi, perlu pemantauan.'
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
        'keterangan' => 'Normal.'
    ]
];
?>

<div class="container mx-auto px-4 py-6">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Manajemen Kualitas Air Ikan</h2>

    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Input Data Kualitas Air Baru</h3>
        <form action="#" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="tambak_id" class="block text-sm font-medium text-gray-700">Pilih Tambak</label>
                <select id="tambak_id" name="tambak_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <option value="">-- Pilih Tambak --</option>
                    <option value="1">Tambak Harapan Jaya</option>
                    <option value="2">Tambak Subur Makmur</option>
                    <option value="3">Tambak Emas Biru</option>
                </select>
            </div>
            <div>
                <label for="tanggal_cek" class="block text-sm font-medium text-gray-700">Tanggal Pengecekan</label>
                <input type="date" id="tanggal_cek" name="tanggal_cek" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <div>
                <label for="waktu_cek" class="block text-sm font-medium text-gray-700">Waktu Pengecekan</label>
                <input type="time" id="waktu_cek" name="waktu_cek" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <div>
                <label for="suhu_air" class="block text-sm font-medium text-gray-700">Suhu Air (°C)</label>
                <input type="number" step="0.1" id="suhu_air" name="suhu_air" placeholder="Contoh: 28.5" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <div>
                <label for="ph_air" class="block text-sm font-medium text-gray-700">pH Air</label>
                <input type="number" step="0.1" id="ph_air" name="ph_air" placeholder="Contoh: 7.5" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <div>
                <label for="do_air" class="block text-sm font-medium text-gray-700">DO (mg/L)</label>
                <input type="number" step="0.1" id="do_air" name="do_air" placeholder="Contoh: 6.0" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <div>
                <label for="amonia" class="block text-sm font-medium text-gray-700">Amonia (mg/L)</label>
                <input type="number" step="0.01" id="amonia" name="amonia" placeholder="Contoh: 0.05" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <div>
                <label for="nitrit" class="block text-sm font-medium text-gray-700">Nitrit (mg/L)</label>
                <input type="number" step="0.01" id="nitrit" name="nitrit" placeholder="Contoh: 0.02" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <div class="md:col-span-2">
                <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan Tambahan</label>
                <textarea id="keterangan" name="keterangan" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Catatan kondisi air atau tindakan yang diambil..."></textarea>
            </div>
            <div class="md:col-span-2 flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg flex items-center">
                    <i class="fas fa-save mr-2"></i> Simpan Data Air
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Riwayat Data Kualitas Air</h3>
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
                        <th class="py-3 px-4 border-b">Keterangan</th>
                        <th class="py-3 px-4 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data_kualitas_air)): ?>
                        <?php foreach ($data_kualitas_air as $data): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4 border-b border-gray-200"><?= htmlspecialchars($data['id']) ?></td>
                                <td class="py-3 px-4 border-b border-gray-200"><?= htmlspecialchars($data['nama_tambak']) ?></td>
                                <td class="py-3 px-4 border-b border-gray-200"><?= htmlspecialchars($data['tanggal']) ?> <?= htmlspecialchars($data['waktu']) ?></td>
                                <td class="py-3 px-4 border-b border-gray-200"><?= htmlspecialchars($data['suhu']) ?></td>
                                <td class="py-3 px-4 border-b border-gray-200"><?= htmlspecialchars($data['ph']) ?></td>
                                <td class="py-3 px-4 border-b border-gray-200"><?= htmlspecialchars($data['do']) ?></td>
                                <td class="py-3 px-4 border-b border-gray-200"><?= htmlspecialchars($data['amonia']) ?></td>
                                <td class="py-3 px-4 border-b border-gray-200"><?= htmlspecialchars($data['nitrit']) ?></td>
                                <td class="py-3 px-4 border-b border-gray-200 text-sm"><?= htmlspecialchars($data['keterangan']) ?></td>
                                <td class="py-3 px-4 border-b border-gray-200">
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
                            <td colspan="10" class="py-4 px-4 text-center text-gray-500">Belum ada riwayat data kualitas air.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>