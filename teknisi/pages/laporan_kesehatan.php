<?php
// teknisi/pages/laporan_kesehatan.php
// Konten ini akan di-include di dashboard.php
// session_start(); // Jika diperlukan
// include '../config/database.php'; // Contoh koneksi database

// Contoh data statis laporan kesehatan ikan untuk demonstrasi
$laporan_kesehatan_ikan = [
    [
        'id' => 1,
        'id_tambak' => '1',
        'nama_tambak' => 'Tambak Harapan Jaya',
        'tanggal' => '2025-06-12',
        'waktu' => '10:00',
        'perilaku' => 'Aktif berenang, respon baik terhadap pakan.',
        'kondisi_fisik' => 'Sirip utuh, tidak ada luka/bintik.',
        'indikasi_penyakit' => 'Tidak ada',
        'tindakan_diambil' => 'Normal',
        'status_kesehatan' => 'Sehat'
    ],
    [
        'id' => 2,
        'id_tambak' => '2',
        'nama_tambak' => 'Tambak Subur Makmur',
        'tanggal' => '2025-06-12',
        'waktu' => '11:15',
        'perilaku' => 'Beberapa ikan cenderung berkumpul di permukaan, nafsu makan sedikit berkurang.',
        'kondisi_fisik' => 'Ada 1-2 ikan dengan lendir berlebih.',
        'indikasi_penyakit' => 'Stress/kemungkinan awal infeksi.',
        'tindakan_diambil' => 'Observasi lebih lanjut, cek ulang kualitas air.',
        'status_kesehatan' => 'Perlu Perhatian'
    ],
    [
        'id' => 3,
        'id_tambak' => '1',
        'nama_tambak' => 'Tambak Harapan Jaya',
        'tanggal' => '2025-06-11',
        'waktu' => '15:30',
        'perilaku' => 'Sangat aktif.',
        'kondisi_fisik' => 'Sehat.',
        'indikasi_penyakit' => 'Tidak ada',
        'tindakan_diambil' => 'Normal',
        'status_kesehatan' => 'Sehat'
    ]
];
?>

<div class="container mx-auto px-4 py-6">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Laporan Harian Kesehatan Ikan</h2>

    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Filter Laporan Kesehatan</h3>
        <form class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
            <div>
                <label for="filter_tambak_kesehatan" class="block text-sm font-medium text-gray-700">Pilih Tambak</label>
                <select id="filter_tambak_kesehatan" name="tambak_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <option value="">Semua Tambak</option>
                    <option value="1">Tambak Harapan Jaya</option>
                    <option value="2">Tambak Subur Makmur</option>
                    <option value="3">Tambak Emas Biru</option>
                </select>
            </div>
            <div>
                <label for="filter_tanggal_mulai_kesehatan" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                <input type="date" id="filter_tanggal_mulai_kesehatan" name="tanggal_mulai" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <div>
                <label for="filter_tanggal_akhir_kesehatan" class="block text-sm font-medium text-gray-700">Tanggal Akhir</label>
                <input type="date" id="filter_tanggal_akhir_kesehatan" name="tanggal_akhir" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <div class="md:col-span-3 flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg flex items-center">
                    <i class="fas fa-filter mr-2"></i> Terapkan Filter
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Riwayat Laporan Kesehatan Ikan</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead>
                    <tr class="bg-gray-100 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                        <th class="py-3 px-4 border-b">ID</th>
                        <th class="py-3 px-4 border-b">Tambak</th>
                        <th class="py-3 px-4 border-b">Tanggal & Waktu</th>
                        <th class="py-3 px-4 border-b">Perilaku</th>
                        <th class="py-3 px-4 border-b">Kondisi Fisik</th>
                        <th class="py-3 px-4 border-b">Indikasi Penyakit</th>
                        <th class="py-3 px-4 border-b">Tindakan</th>
                        <th class="py-3 px-4 border-b">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($laporan_kesehatan_ikan)): ?>
                        <?php foreach ($laporan_kesehatan_ikan as $data): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4 border-b border-gray-200"><?= htmlspecialchars($data['id']) ?></td>
                                <td class="py-3 px-4 border-b border-gray-200"><?= htmlspecialchars($data['nama_tambak']) ?></td>
                                <td class="py-3 px-4 border-b border-gray-200"><?= htmlspecialchars($data['tanggal']) ?> <?= htmlspecialchars($data['waktu']) ?></td>
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
                                    <?php
                                    $status_class = '';
                                    if ($data['status_kesehatan'] === 'Sehat') {
                                        $status_class = 'bg-green-100 text-green-800';
                                    } elseif ($data['status_kesehatan'] === 'Perlu Perhatian') {
                                        $status_class = 'bg-orange-100 text-orange-800';
                                    } else {
                                        $status_class = 'bg-red-100 text-red-800';
                                    }
                                    ?>
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold <?= $status_class ?>">
                                        <?= htmlspecialchars($data['status_kesehatan']) ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="py-4 px-4 text-center text-gray-500">Belum ada data laporan kesehatan ikan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>