<?php

include_once __DIR__ . '/../../config/koneksi.php';


// Ambil data dari database untuk ditampilkan
$sql = "SELECT
            t.id_tambak,
            t.kode_tambak,
            t.nama_tambak,
            t.luas_m2,
            t.kapasitas_ikan,
            t.tanggal_mulai,
            t.status,
            COALESCE(t.keterangan, '') AS keterangan,
            t.id_bibit,
            t.id_teknisi,
            b.nama_bibit,
            u.nama AS nama_teknisi
        FROM
            tambak AS t
        LEFT JOIN
            bibit AS b ON t.id_bibit = b.id_bibit
        LEFT JOIN
            users AS u ON t.id_teknisi = u.usersId
        -- Hapus baris WHERE t.status = 'Siap' ini untuk menampilkan semua status
        ORDER BY
            t.id_tambak DESC";

$result = mysqli_query($koneksi, $sql);

if (!$result) {
    die("Query gagal: " . mysqli_error($koneksi));
}

$no = 1; // Inisialisasi nomor untuk tabel
?>

<div x-data="{ showModal: false, showEditModal: false, editKolam: {} }" x-cloak>

    <main class="p-3 w-full max-w-screen-xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Data Tambak</h1>
                <p class="text-gray-500 mt-2">Lihat semua data tambak</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr class="text-left text-sm font-medium text-gray-500 tracking-wider">
                            <th class="px-6 py-3">No</th>
                            <th class="px-6 py-3">Kode Tambak</th>
                            <th class="px-6 py-3">Luas (m²)</th>
                            <th class="px-6 py-3">Kapasitas Ikan</th>
                            <th class="px-6 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php if ($result->num_rows > 0): ?>
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900"><?= str_pad($no++, 2, '0', STR_PAD_LEFT) ?></td>
                                    <td class="px-6 py-4 flex items-center">
                                        <div class="h-10 w-10 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 font-medium mr-3">
                                            <?= strtoupper(substr($row['kode_tambak'], 0, 1)) ?>
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-900"><?= htmlspecialchars($row['kode_tambak']) ?></div>
                                            <div class="text-gray-500 text-xs">Nama: <?= htmlspecialchars($row['nama_tambak']) ?></div>
                                            <div class="text-gray-500 text-xs">Mulai: <?= htmlspecialchars($row['tanggal_mulai']) ?></div>
                                            <div class="text-gray-500 text-xs">Ket: <?= htmlspecialchars($row['keterangan']) ?></div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500"><?= htmlspecialchars($row['luas_m2']) ?></td>
                                    <td class="px-6 py-4 text-sm text-gray-500"><?= htmlspecialchars($row['kapasitas_ikan']) ?></td>
                                    <td class="px-6 py-4 text-sm">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            <?php
                                // Menentukan warna badge berdasarkan status
                                if ($row['status'] == 'Siap') {
                                    echo 'bg-green-100 text-green-800';
                                } elseif ($row['status'] == 'Beroperasi') {
                                    echo 'bg-red-500 text-white font-medium'; 
                                } else {
                                    echo 'bg-gray-100 text-gray-800'; 
                                }
                                ?>">
                                            <?= htmlspecialchars($row['status']) ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="px-6 py-4 text-center text-gray-500 text-sm">Tidak ada data tambak.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
<script src="../assets/js/dashboard.js"></script>