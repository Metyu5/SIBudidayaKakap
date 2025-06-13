<?php
// teknisi/pages/kondisi_ikan.php
// Konten ini akan di-include di dashboard.php
// session_start(); // Jika diperlukan
// include '../config/database.php'; // Contoh koneksi database

// Contoh data statis kondisi ikan untuk demonstrasi
$data_kondisi_ikan = [
    [
        'id' => 1,
        'id_tambak' => '1',
        'nama_tambak' => 'Tambak Harapan Jaya',
        'tanggal' => '2025-06-12',
        'waktu' => '10:00',
        'jumlah_ikan_diamati' => 50,
        'perilaku' => 'Aktif berenang, respon baik terhadap pakan.',
        'kondisi_fisik' => 'Sirip utuh, tidak ada luka/bintik.',
        'indikasi_penyakit' => 'Tidak ada',
        'tindakan_diambil' => 'Normal'
    ],
    [
        'id' => 2,
        'id_tambak' => '2',
        'nama_tambak' => 'Tambak Subur Makmur',
        'tanggal' => '2025-06-12',
        'waktu' => '11:15',
        'jumlah_ikan_diamati' => 45,
        'perilaku' => 'Beberapa ikan cenderung berkumpul di permukaan, nafsu makan sedikit berkurang.',
        'kondisi_fisik' => 'Ada 1-2 ikan dengan lendir berlebih.',
        'indikasi_penyakit' => 'Stress/kemungkinan awal infeksi.',
        'tindakan_diambil' => 'Observasi lebih lanjut, cek ulang kualitas air.'
    ],
    [
        'id' => 3,
        'id_tambak' => '1',
        'nama_tambak' => 'Tambak Harapan Jaya',
        'tanggal' => '2025-06-11',
        'waktu' => '15:30',
        'jumlah_ikan_diamati' => 60,
        'perilaku' => 'Sangat aktif.',
        'kondisi_fisik' => 'Sehat.',
        'indikasi_penyakit' => 'Tidak ada',
        'tindakan_diambil' => 'Normal'
    ]
];
?>

<div class="container mx-auto px-4 py-6">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Pemantauan Kondisi Ikan</h2>

    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Input Data Kondisi Ikan Baru</h3>
        <form action="#" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="tambak_id_ikan" class="block text-sm font-medium text-gray-700">Pilih Tambak</label>
                <select id="tambak_id_ikan" name="tambak_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <option value="">-- Pilih Tambak --</option>
                    <option value="1">Tambak Harapan Jaya</option>
                    <option value="2">Tambak Subur Makmur</option>
                    <option value="3">Tambak Emas Biru</option>
                </select>
            </div>
            <div>
                <label for="tanggal_observasi" class="block text-sm font-medium text-gray-700">Tanggal Observasi</label>
                <input type="date" id="tanggal_observasi" name="tanggal_observasi" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <div>
                <label for="waktu_observasi" class="block text-sm font-medium text-gray-700">Waktu Observasi</label>
                <input type="time" id="waktu_observasi" name="waktu_observasi" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <div>
                <label for="jumlah_diamati" class="block text-sm font-medium text-gray-700">Jumlah Ikan Diamati</label>
                <input type="number" id="jumlah_diamati" name="jumlah_diamati" placeholder="Contoh: 50" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <div class="md:col-span-2">
                <label for="perilaku_ikan" class="block text-sm font-medium text-gray-700">Perilaku Ikan (Deskripsi)</label>
                <textarea id="perilaku_ikan" name="perilaku_ikan" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Contoh: Aktif berenang, nafsu makan baik, dll."></textarea>
            </div>
            <div class="md:col-span-2">
                <label for="kondisi_fisik_ikan" class="block text-sm font-medium text-gray-700">Kondisi Fisik Ikan (Deskripsi)</label>
                <textarea id="kondisi_fisik_ikan" name="kondisi_fisik_ikan" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Contoh: Sirip utuh, tidak ada luka, warna cerah, dll."></textarea>
            </div>
            <div class="md:col-span-2">
                <label for="indikasi_penyakit" class="block text-sm font-medium text-gray-700">Indikasi Penyakit / Masalah</label>
                <input type="text" id="indikasi_penyakit" name="indikasi_penyakit" placeholder="Contoh: Lendir berlebih, bintik putih, gerakan lesu" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <div class="md:col-span-2">
                <label for="tindakan_diambil" class="block text-sm font-medium text-gray-700">Tindakan yang Diambil</label>
                <textarea id="tindakan_diambil" name="tindakan_diambil" rows="2" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Catatan tindakan yang diambil jika ada masalah..."></textarea>
            </div>
            <div class="md:col-span-2 flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg flex items-center">
                    <i class="fas fa-save mr-2"></i> Simpan Observasi Ikan
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Riwayat Observasi Kondisi Ikan</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead>
                    <tr class="bg-gray-100 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                        <th class="py-3 px-4 border-b">ID</th>
                        <th class="py-3 px-4 border-b">Tambak</th>
                        <th class="py-3 px-4 border-b">Tanggal & Waktu</th>
                        <th class="py-3 px-4 border-b">Ikan Diamati</th>
                        <th class="py-3 px-4 border-b">Perilaku</th>
                        <th class="py-3 px-4 border-b">Kondisi Fisik</th>
                        <th class="py-3 px-4 border-b">Indikasi Penyakit</th>
                        <th class="py-3 px-4 border-b">Tindakan</th>
                        <th class="py-3 px-4 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data_kondisi_ikan)): ?>
                        <?php foreach ($data_kondisi_ikan as $data): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4 border-b border-gray-200"><?= htmlspecialchars($data['id']) ?></td>
                                <td class="py-3 px-4 border-b border-gray-200"><?= htmlspecialchars($data['nama_tambak']) ?></td>
                                <td class="py-3 px-4 border-b border-gray-200"><?= htmlspecialchars($data['tanggal']) ?> <?= htmlspecialchars($data['waktu']) ?></td>
                                <td class="py-3 px-4 border-b border-gray-200"><?= htmlspecialchars($data['jumlah_ikan_diamati']) ?></td>
                                <td class="py-3 px-4 border-b border-gray-200 text-sm"><?= htmlspecialchars($data['perilaku']) ?></td>
                                <td class="py-3 px-4 border-b border-gray-200 text-sm"><?= htmlspecialchars($data['kondisi_fisik']) ?></td>
                                <td class="py-3 px-4 border-b border-gray-200 text-sm">
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold
                                        <?php
                                        if ($data['indikasi_penyakit'] === 'Tidak ada') {
                                            echo 'bg-green-100 text-green-800';
                                        } elseif (strpos($data['indikasi_penyakit'], 'Stress') !== false || strpos($data['indikasi_penyakit'], 'infeksi') !== false) {
                                            echo 'bg-orange-100 text-orange-800';
                                        } else {
                                            echo 'bg-red-100 text-red-800';
                                        }
                                        ?>">
                                        <?= htmlspecialchars($data['indikasi_penyakit']) ?>
                                    </span>
                                </td>
                                <td class="py-3 px-4 border-b border-gray-200 text-sm"><?= htmlspecialchars($data['tindakan_diambil']) ?></td>
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
                            <td colspan="9" class="py-4 px-4 text-center text-gray-500">Belum ada riwayat observasi kondisi ikan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>