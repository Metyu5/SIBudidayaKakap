<?php
// ... (Kode PHP di bagian atas, logika CRUD, dan pengambilan data bibit/teknisi tetap sama) ...

include_once __DIR__ . '/../../config/koneksi.php'; // Pastikan path ini benar

// --- Logika untuk Membuat Kode Kolam Otomatis ---
$query_kode = mysqli_query($koneksi, "SELECT MAX(kode_tambak) AS kode_terakhir FROM tambak");
$data_kode = mysqli_fetch_assoc($query_kode);
$kode_terakhir = $data_kode['kode_terakhir'];

if ($kode_terakhir) {
    // Ambil angka dari kode terakhir, misalnya TB-005 → 5
    $angka_terakhir = (int) substr($kode_terakhir, 3);
    $angka_baru = $angka_terakhir + 1;
} else {
    $angka_baru = 1; // Kalau belum ada data
}

$kode_baru = 'TB-' . str_pad($angka_baru, 3, '0', STR_PAD_LEFT); // Hasil: TB-006


function clean_input_kolam($data)
{
    global $koneksi;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return mysqli_real_escape_string($koneksi, $data);
}

// --- Logika Hapus Kolam ---
if (isset($_POST['hapus_kolam'])) {
    $id_tambak = intval($_POST['id_tambak']);
    $stmt = $koneksi->prepare("DELETE FROM tambak WHERE id_tambak=?");
    $stmt->bind_param("i", $id_tambak);

    if ($stmt->execute()) {
        echo "<script>
            const notyf = new Notyf({ duration: 3000, position: { x: 'right', y: 'bottom' } });
            notyf.success('Data kolam berhasil dihapus!');
            setTimeout(() => { window.location.href = ''; }, 1500);
        </script>";
    } else {
        echo "<script>
            const notyf = new Notyf({ duration: 3000, position: { x: 'right', y: 'top' } });
            notyf.error('Gagal menghapus data kolam: " . addslashes($stmt->error) . "');
        </script>";
    }
    $stmt->close();
}

// --- Logika Edit Kolam ---
if (isset($_POST['edit_kolam'])) {
    $id_tambak = clean_input_kolam($_POST['id_tambak']);
    $kode_tambak = clean_input_kolam($_POST['kode_tambak']);
    $nama_tambak = clean_input_kolam($_POST['nama_tambak']);
    $luas_m2 = clean_input_kolam($_POST['luas_m2']);
    $kapasitas_ikan = clean_input_kolam($_POST['kapasitas_ikan']);
    $tanggal_mulai = clean_input_kolam($_POST['tanggal_mulai']);
    $status = clean_input_kolam($_POST['status']);
    $keterangan = clean_input_kolam($_POST['keterangan']);
    $id_bibit = empty($_POST['id_bibit']) ? NULL : intval($_POST['id_bibit']);
    $id_teknisi = empty($_POST['id_teknisi']) ? NULL : intval($_POST['id_teknisi']);

    $stmt = $koneksi->prepare("UPDATE tambak SET kode_tambak=?, nama_tambak=?, luas_m2=?, kapasitas_ikan=?, tanggal_mulai=?, status=?, keterangan=?, id_bibit=?, id_teknisi=? WHERE id_tambak=?");
    $stmt->bind_param("ssdisssiii", $kode_tambak, $nama_tambak, $luas_m2, $kapasitas_ikan, $tanggal_mulai, $status, $keterangan, $id_bibit, $id_teknisi, $id_tambak);

    if ($stmt->execute()) {
        echo "<script>
            const notyf = new Notyf({ duration: 3000, position: { x: 'right', y: 'bottom' } });
            notyf.success('Data kolam berhasil diperbarui!');
            setTimeout(() => { window.location.href = ''; }, 1500);
        </script>";
    } else {
        echo "<script>
            const notyf = new Notyf({ duration: 3000, position: { x: 'right', y: 'top' } });
            notyf.error('Gagal memperbarui data kolam: " . addslashes($stmt->error) . "');
        </script>";
    }
    $stmt->close();
}

// --- Logika Tambah Kolam ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah_kolam'])) {
    $kode_tambak = clean_input_kolam($_POST['kode_tambak']);
    $nama_tambak = clean_input_kolam($_POST['nama_tambak']);
    $luas_m2 = clean_input_kolam($_POST['luas_m2']);
    $kapasitas_ikan = clean_input_kolam($_POST['kapasitas_ikan']);
    $tanggal_mulai = clean_input_kolam($_POST['tanggal_mulai']);
    $status = clean_input_kolam($_POST['status']);
    $keterangan = clean_input_kolam($_POST['keterangan']);
    $id_bibit = empty($_POST['id_bibit']) ? NULL : intval($_POST['id_bibit']);
    $id_teknisi = empty($_POST['id_teknisi']) ? NULL : intval($_POST['id_teknisi']);

    $stmt = $koneksi->prepare("INSERT INTO tambak (kode_tambak, nama_tambak, luas_m2, kapasitas_ikan, tanggal_mulai, status, keterangan, id_bibit, id_teknisi) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssddsssii", $kode_tambak, $nama_tambak, $luas_m2, $kapasitas_ikan, $tanggal_mulai, $status, $keterangan, $id_bibit, $id_teknisi);

    if ($stmt->execute()) {
        echo "<script>
            const notyf = new Notyf({ duration: 3000, position: { x: 'right', y: 'bottom' } });
            notyf.success('Data kolam berhasil ditambahkan!');
            setTimeout(() => { window.location.href = ''; }, 1500);
        </script>";
    } else {
        echo "<script>
            const notyf = new Notyf({ duration: 3000, position: { x: 'right', y: 'top' } });
            notyf.error('Gagal menambahkan data kolam: " . addslashes($stmt->error) . "');
        </script>";
    }
    $stmt->close();
}


// --- Ambil Data Bibit dan Teknisi untuk Dropdown ---
$bibit_options = [];
$result_bibit = mysqli_query($koneksi, "SELECT id_bibit, nama_bibit FROM bibit ORDER BY nama_bibit ASC");
if ($result_bibit) {
    while ($row = mysqli_fetch_assoc($result_bibit)) {
        $bibit_options[] = $row;
    }
}

$teknisi_options = [];
$result_teknisi = mysqli_query($koneksi, "SELECT usersId, nama FROM users WHERE kategori='teknisi' ORDER BY nama ASC");
if ($result_teknisi) {
    while ($row = mysqli_fetch_assoc($result_teknisi)) {
        $teknisi_options[] = $row;
    }
}

// Ambil data dari database untuk ditampilkan
// Ambil data dari database untuk ditampilkan
$sql = "SELECT
            t.id_tambak,
            t.kode_tambak,
            t.nama_tambak,
            t.luas_m2,
            t.kapasitas_ikan,
            t.tanggal_mulai,
            t.status,
            COALESCE(t.keterangan, '') AS keterangan, -- <<< TAMBAH INI
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
                <h1 class="text-2xl font-bold text-gray-900">Manajemen Tambak</h1>
                <p class="text-gray-500 mt-2">Kelola data tambak ikan secara efisien</p>
            </div>

            <button
                @click="showModal = true"
                class="bg-indigo-600 hover:bg-indigo-700 active:scale-95 active:shadow-inner text-white text-sm font-medium px-2 py-2.5 rounded-md shadow-md flex items-center transition-all duration-150 ease-in-out">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Tambah Tambak
            </button>
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
                            <th class="px-6 py-3">Bibit</th>
                            <th class="px-6 py-3">Teknisi</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3 text-right">Aksi</th>
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
                                    <td class="px-6 py-4 text-sm text-gray-500"><?= htmlspecialchars($row['nama_bibit'] ?? 'N/A') ?></td>
                                    <td class="px-6 py-4 text-sm text-gray-500"><?= htmlspecialchars($row['nama_teknisi'] ?? 'N/A') ?></td>
                                    <td class="px-6 py-4 text-sm">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= ($row['status'] == 'Aktif') ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                            <?= htmlspecialchars($row['status']) ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right text-sm flex justify-end space-x-2">
                                        <button
                                            class="text-indigo-600 hover:text-indigo-900 p-2 rounded bg-indigo-500/10 hover:bg-indigo-500/20"
                                            title="Edit"
                                            @click="editKolam = <?= htmlspecialchars(json_encode($row)) ?>; showEditModal = true">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <form method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data kolam ini?')">
                                            <input type="hidden" name="hapus_kolam" value="1">
                                            <input type="hidden" name="id_tambak" value="<?= $row['id_tambak'] ?>">
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-900 p-2 rounded bg-red-500/10 hover:bg-red-500/20"
                                                title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="px-6 py-4 text-center text-gray-500 text-sm">Tidak ada data kolam.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <div x-show="showModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 px-4">
        <div @click.away="showModal = false" class="bg-white rounded-lg shadow-lg w-full max-w-4xl mx-auto overflow-hidden border border-gray-200">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">Tambah Tambak</h2>
                    <button @click="showModal = false" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>


            <form action="" method="POST" class="p-6 space-y-4">
                <input type="hidden" name="tambah_kolam" value="1" />

                <!-- Grid input 2 kolom -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="add_kode_tambak" class="block text-sm font-medium text-gray-700 mb-1">Kode Tambak</label>
                        <input type="text" id="add_kode_tambak" name="kode_tambak" value="<?= $kode_baru ?>" readonly
                            class="w-full bg-gray-100 border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none" />
                    </div>


                    <div>
                        <label for="add_nama_tambak" class="block text-sm font-medium text-gray-700 mb-1">Nama Kolam</label>
                        <input type="text" id="add_nama_tambak" name="nama_tambak" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                    </div>

                    <div>
                        <label for="add_luas_m2" class="block text-sm font-medium text-gray-700 mb-1">Luas (m²)</label>
                        <input type="number" step="0.01" id="add_luas_m2" name="luas_m2"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                    </div>

                    <div>
                        <label for="add_kapasitas_ikan" class="block text-sm font-medium text-gray-700 mb-1">Kapasitas Ikan</label>
                        <input type="number" id="add_kapasitas_ikan" name="kapasitas_ikan"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                    </div>

                    <div>
                        <label for="add_tanggal_mulai" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
                        <input type="date" id="add_tanggal_mulai" name="tanggal_mulai"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                    </div>

                    <div>
                        <label for="add_status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select id="add_status" name="status"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>

                    <div>
                        <label for="add_id_bibit" class="block text-sm font-medium text-gray-700 mb-1">Bibit Ikan</label>
                        <select id="add_id_bibit" name="id_bibit"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="">-- Pilih Bibit --</option>
                            <?php foreach ($bibit_options as $bibit): ?>
                                <option value="<?= htmlspecialchars($bibit['id_bibit']) ?>">
                                    <?= htmlspecialchars($bibit['nama_bibit']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label for="add_id_teknisi" class="block text-sm font-medium text-gray-700 mb-1">Teknisi</label>
                        <select id="add_id_teknisi" name="id_teknisi"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="">-- Pilih Teknisi --</option>
                            <?php foreach ($teknisi_options as $teknisi): ?>
                                <option value="<?= htmlspecialchars($teknisi['usersId']) ?>">
                                    <?= htmlspecialchars($teknisi['nama']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- Keterangan di bawah 2 kolom -->
                <div>
                    <label for="add_keterangan" class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                    <textarea id="add_keterangan" name="keterangan" rows="3"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
                </div>

                <!-- Tombol aksi -->
                <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                    <button type="button" @click="showModal = false"
                        class="px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>


    <div x-show="showEditModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 px-4">
        <div @click.away="showEditModal = false" class="bg-white rounded-lg shadow-lg w-full max-w-4xl mx-auto overflow-hidden border border-gray-200">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">Edit Kolam Ikan</h2>
                    <button @click="showEditModal = false" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <form action="" method="POST" class="p-6 space-y-4">
                <input type="hidden" name="edit_kolam" value="1">
                <input type="hidden" name="id_tambak" :value="editKolam.id_tambak">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="edit_kode_tambak" class="block text-sm font-medium text-gray-700 mb-1">Kode Kolam</label>
                        <input type="text" id="edit_kode_tambak" name="kode_tambak" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            :value="editKolam.kode_tambak" />
                    </div>
                    <div>
                        <label for="edit_nama_tambak" class="block text-sm font-medium text-gray-700 mb-1">Nama Kolam</label>
                        <input type="text" id="edit_nama_tambak" name="nama_tambak" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            :value="editKolam.nama_tambak" />
                    </div>
                    <div>
                        <label for="edit_luas_m2" class="block text-sm font-medium text-gray-700 mb-1">Luas (m²)</label>
                        <input type="number" step="0.01" id="edit_luas_m2" name="luas_m2"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            :value="editKolam.luas_m2" />
                    </div>
                    <div>
                        <label for="edit_kapasitas_ikan" class="block text-sm font-medium text-gray-700 mb-1">Kapasitas Ikan</label>
                        <input type="number" id="edit_kapasitas_ikan" name="kapasitas_ikan"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            :value="editKolam.kapasitas_ikan" />
                    </div>
                    <div>
                        <label for="edit_tanggal_mulai" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
                        <input type="date" id="edit_tanggal_mulai" name="tanggal_mulai"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            :value="editKolam.tanggal_mulai" />
                    </div>
                    <div>
                        <label for="edit_status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select id="edit_status" name="status"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="Aktif" :selected="editKolam.status == 'Aktif'">Aktif</option>
                            <option value="Tidak Aktif" :selected="editKolam.status == 'Tidak Aktif'">Tidak Aktif</option>
                        </select>
                    </div>
                    <div>
                        <label for="edit_id_bibit" class="block text-sm font-medium text-gray-700 mb-1">Bibit Ikan</label>
                        <select id="edit_id_bibit" name="id_bibit"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="">-- Pilih Bibit --</option>
                            <?php foreach ($bibit_options as $bibit): ?>
                                <option value="<?= htmlspecialchars($bibit['id_bibit']) ?>"
                                    :selected="editKolam.id_bibit == <?= htmlspecialchars($bibit['id_bibit']) ?>">
                                    <?= htmlspecialchars($bibit['nama_bibit']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label for="edit_id_teknisi" class="block text-sm font-medium text-gray-700 mb-1">Teknisi</label>
                        <select id="edit_id_teknisi" name="id_teknisi"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="">-- Pilih Teknisi --</option>
                            <?php foreach ($teknisi_options as $teknisi): ?>
                                <option value="<?= htmlspecialchars($teknisi['usersId']) ?>"
                                    :selected="editKolam.id_teknisi == <?= htmlspecialchars($teknisi['usersId']) ?>">
                                    <?= htmlspecialchars($teknisi['nama']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- Kolom teks terpisah -->
                <div>
                    <label for="edit_keterangan" class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                    <textarea id="edit_keterangan" name="keterangan" rows="3"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        x-model="editKolam.keterangan"></textarea>

                </div>

                <!-- Tombol aksi -->
                <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                    <button type="button" @click="showEditModal = false"
                        class="px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        Perbarui
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
<script src="../assets/js/dashboard.js"></script>