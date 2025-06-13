<?php
include_once __DIR__ . '/../../config/koneksi.php';

// Function to clean input data
function clean_input_pemeliharaan($data)
{
    global $koneksi;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return mysqli_real_escape_string($koneksi, $data);
}

// --- Logika Hapus Pemeliharaan ---
if (isset($_POST['hapus_pemeliharaan'])) {
    $id_pemeliharaan = intval($_POST['id_pemeliharaan']);
    $stmt = $koneksi->prepare("DELETE FROM pemeliharaan_ikan WHERE id_pemeliharaan=?");
    $stmt->bind_param("i", $id_pemeliharaan);

    if ($stmt->execute()) {
        echo "<script>
            const notyf = new Notyf({ duration: 3000, position: { x: 'right', y: 'bottom' } });
            notyf.success('Data pemeliharaan berhasil dihapus!');
            setTimeout(() => { window.location.href = ''; }, 1500);
        </script>";
    } else {
        echo "<script>
            const notyf = new Notyf({ duration: 3000, position: { x: 'right', y: 'top' } });
            notyf.error('Gagal menghapus data pemeliharaan: " . addslashes($stmt->error) . "');
        </script>";
    }
    $stmt->close();
}

// --- Logika Edit Pemeliharaan ---
if (isset($_POST['edit_pemeliharaan'])) {
    $id_pemeliharaan = clean_input_pemeliharaan($_POST['id_pemeliharaan']);
    $id_tebar = clean_input_pemeliharaan($_POST['id_tebar']);
    $id_pakan = clean_input_pemeliharaan($_POST['id_pakan']);
    $usia_pemeliharaan = clean_input_pemeliharaan($_POST['usia_pemeliharaan']);
    $jumlah_awal = clean_input_pemeliharaan($_POST['jumlah_awal']);
    $jumlah_hidup = clean_input_pemeliharaan($_POST['jumlah_hidup']);
    $jumlah_mati = clean_input_pemeliharaan($_POST['jumlah_mati']);
    $tanggal_pemeliharaan = clean_input_pemeliharaan($_POST['tanggal_pemeliharaan']);

    $stmt = $koneksi->prepare("UPDATE pemeliharaan_ikan SET id_tebar=?, id_pakan=?, usia_pemeliharaan=?, jumlah_awal=?, jumlah_hidup=?, jumlah_mati=?, tanggal_pemeliharaan=? WHERE id_pemeliharaan=?");
    $stmt->bind_param("iisssssi", $id_tebar, $id_pakan, $usia_pemeliharaan, $jumlah_awal, $jumlah_hidup, $jumlah_mati, $tanggal_pemeliharaan, $id_pemeliharaan);

    if ($stmt->execute()) {
        echo "<script>
            const notyf = new Notyf({ duration: 3000, position: { x: 'right', y: 'bottom' } });
            notyf.success('Data pemeliharaan berhasil diperbarui!');
            setTimeout(() => { window.location.href = ''; }, 1500);
        </script>";
    } else {
        echo "<script>
            const notyf = new Notyf({ duration: 3000, position: { x: 'right', y: 'top' } });
            notyf.error('Gagal memperbarui data pemeliharaan: " . addslashes($stmt->error) . "');
        </script>";
    }
    $stmt->close();
}

// --- Logika Tambah Pemeliharaan ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah_pemeliharaan'])) {
    $id_tebar = clean_input_pemeliharaan($_POST['id_tebar']);
    $id_pakan = clean_input_pemeliharaan($_POST['id_pakan']);
    $usia_pemeliharaan = clean_input_pemeliharaan($_POST['usia_pemeliharaan']);
    $jumlah_awal = clean_input_pemeliharaan($_POST['jumlah_awal']);
    $jumlah_hidup = clean_input_pemeliharaan($_POST['jumlah_hidup']);
    $jumlah_mati = clean_input_pemeliharaan($_POST['jumlah_mati']);
    $tanggal_pemeliharaan = clean_input_pemeliharaan($_POST['tanggal_pemeliharaan']);

    // Check if id_tebar already exists in pemeliharaan_ikan
    $check_stmt = $koneksi->prepare("SELECT COUNT(*) FROM pemeliharaan_ikan WHERE id_tebar = ?");
    $check_stmt->bind_param("i", $id_tebar);
    $check_stmt->execute();
    $check_stmt->bind_result($count);
    $check_stmt->fetch();
    $check_stmt->close();

    if ($count > 0) {
        echo "<script>
            const notyf = new Notyf({ duration: 3000, position: { x: 'right', y: 'top' } });
            notyf.error('Tambak ini sudah memiliki data pemeliharaan. Silakan pilih tambak lain atau edit data yang sudah ada.');
            setTimeout(() => { window.location.href = ''; }, 1500);
        </script>";
    } else {
        $stmt = $koneksi->prepare("INSERT INTO pemeliharaan_ikan (id_tebar, id_pakan, usia_pemeliharaan, jumlah_awal, jumlah_hidup, jumlah_mati, tanggal_pemeliharaan) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iisssss", $id_tebar, $id_pakan, $usia_pemeliharaan, $jumlah_awal, $jumlah_hidup, $jumlah_mati, $tanggal_pemeliharaan);

        if ($stmt->execute()) {
            echo "<script>
                const notyf = new Notyf({ duration: 3000, position: { x: 'right', y: 'bottom' } });
                notyf.success('Data pemeliharaan berhasil ditambahkan!');
                setTimeout(() => { window.location.href = ''; }, 1500);
            </script>";
        } else {
            echo "<script>
                const notyf = new Notyf({ duration: 3000, position: { x: 'right', y: 'top' } });
                notyf.error('Gagal menambahkan data pemeliharaan: " . addslashes($stmt->error) . "');
            </script>";
        }
        $stmt->close();
    }
}

// --- Ambil Data Laporan Tebar (termasuk nama_tambak) untuk Dropdown ---
// Hanya ambil laporan tebar yang belum ada di tabel pemeliharaan_ikan
$tebar_options = [];
$result_tebar = mysqli_query($koneksi, "
    SELECT lt.id_tebar, lt.tanggal_tebar, t.nama_tambak 
    FROM laporan_tebar AS lt 
    JOIN tambak AS t ON lt.id_tambak = t.id_tambak 
    LEFT JOIN pemeliharaan_ikan AS pi ON lt.id_tebar = pi.id_tebar
    WHERE pi.id_tebar IS NULL
    ORDER BY lt.tanggal_tebar DESC
");

if ($result_tebar) {
    while ($row = mysqli_fetch_assoc($result_tebar)) {
        $tebar_options[] = $row;
    }
}

// --- Ambil Data Pakan untuk Dropdown (Menggunakan kode_pakan) ---
$pakan_options = [];
$result_pakan = mysqli_query($koneksi, "SELECT id_pakan, kode_pakan FROM pakan ORDER BY kode_pakan ASC");
if ($result_pakan) {
    while ($row = mysqli_fetch_assoc($result_pakan)) {
        $pakan_options[] = $row;
    }
}

// --- Query untuk menampilkan data pemeliharaan dengan join ke laporan_tebar, tambak, dan pakan ---
$sql = "SELECT
            pi.id_pemeliharaan,
            pi.id_tebar,
            pi.id_pakan,
            pi.usia_pemeliharaan,
            pi.jumlah_awal,
            pi.jumlah_hidup,
            pi.jumlah_mati,
            pi.tanggal_pemeliharaan,
            lt.tanggal_tebar,
            t.nama_tambak,
            p.jenis_pakan,
            p.kode_pakan
        FROM
            pemeliharaan_ikan AS pi
        LEFT JOIN
            laporan_tebar AS lt ON pi.id_tebar = lt.id_tebar
        LEFT JOIN
            tambak AS t ON lt.id_tambak = t.id_tambak
        LEFT JOIN
            pakan AS p ON pi.id_pakan = p.id_pakan
        ORDER BY
            pi.id_pemeliharaan DESC";

$result = mysqli_query($koneksi, $sql);

if (!$result) {
    die("Query gagal: " . mysqli_error($koneksi));
}

$no = 1; // Inisialisasi nomor untuk tabel
?>

<div x-data="{ showModal: false, showEditModal: false, editPemeliharaan: {} }" x-cloak>

    <main class="p-3 w-full max-w-screen-xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Manajemen Pemeliharaan Ikan</h1>
                <p class="text-gray-500 mt-2">Kelola data pemeliharaan ikan</p>
            </div>

            <button
                @click="showModal = true"
                class="bg-indigo-600 hover:bg-indigo-700 active:scale-95 active:shadow-inner text-white text-sm font-medium px-2 py-2.5 rounded-md shadow-md flex items-center transition-all duration-150 ease-in-out">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Tambah Pemeliharaan
            </button>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr class="text-left text-sm font-medium text-gray-500 tracking-wider">
                            <th class="px-6 py-3">No</th>
                            <th class="px-6 py-3">Tambak & Detail Tebar</th>
                            <th class="px-6 py-3">Pakan</th>
                            <th class="px-6 py-3">Usia Pemeliharaan (hari)</th>
                            <th class="px-6 py-3">Jumlah Awal</th>
                            <th class="px-6 py-3">Jumlah Hidup</th>
                            <th class="px-6 py-3">Jumlah Mati</th>
                            <th class="px-6 py-3">Tanggal Pemeliharaan</th>
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
                                            <?= strtoupper(substr($row['nama_tambak'] ?? '', 0, 1)) ?>
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-900">Tambak: <?= htmlspecialchars($row['nama_tambak'] ?? 'N/A') ?></div>
                                            <div class="text-gray-500 text-xs">Tanggal Tebar: <?= htmlspecialchars($row['tanggal_tebar'] ?? 'N/A') ?></div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500"><?= htmlspecialchars($row['kode_pakan'] ?? 'N/A') ?></td>
                                    <td class="px-6 py-4 text-sm text-gray-500"><?= htmlspecialchars($row['usia_pemeliharaan']) ?></td>
                                    <td class="px-6 py-4 text-sm text-gray-500  "><?= htmlspecialchars($row['jumlah_awal']) ?></td>
                                    <td class="px-6 py-4 text-sm text-gray-500  "><?= htmlspecialchars($row['jumlah_hidup']) ?></td>
                                    <td class="px-6 py-4 text-sm text-gray-500 "><?= htmlspecialchars($row['jumlah_mati']) ?></td>
                                    <td class="px-6 py-4 text-sm text-gray-500"><?= htmlspecialchars($row['tanggal_pemeliharaan']) ?></td>
                                    <td class="px-6 py-4 text-right text-sm flex justify-end space-x-2">
                                        <button
                                            class="text-indigo-600 hover:text-indigo-900 p-2 rounded bg-indigo-500/10 hover:bg-indigo-500/20"
                                            title="Edit"
                                            @click="editPemeliharaan = <?= htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8') ?>; showEditModal = true">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <form method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data pemeliharaan ini?')">
                                            <input type="hidden" name="hapus_pemeliharaan" value="1">
                                            <input type="hidden" name="id_pemeliharaan" value="<?= $row['id_pemeliharaan'] ?>">
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
                                <td colspan="9" class="px-6 py-4 text-center text-gray-500 text-sm">Tidak ada data pemeliharaan ikan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 px-4">
        <div @click.away="showModal = false" class="bg-white rounded-lg shadow-lg w-full max-w-4xl mx-auto overflow-hidden border border-gray-200">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">Tambah Pemeliharaan Ikan</h2>
                    <button @click="showModal = false" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <form action="" method="POST" class="p-6 space-y-4">
                <input type="hidden" name="tambah_pemeliharaan" value="1" />

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="add_id_tebar" class="block text-sm font-medium text-gray-700 mb-1">Tambak & Tanggal Tebar</label>
                        <?php if (empty($tebar_options)): ?>
                            <input type="text" id="add_id_tebar" value="Semua tambak telah sedang beroperasi" readonly
                                class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm bg-gray-100 text-gray-500 cursor-not-allowed" />
                            <input type="hidden" name="id_tebar" value="" /> <?php else: ?>
                            <select id="add_id_tebar" name="id_tebar" required
                                class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option value="">Pilih Tambak & Tanggal Tebar</option>
                                <?php foreach ($tebar_options as $option): ?>
                                    <option value="<?= htmlspecialchars($option['id_tebar']) ?>">
                                        <?= htmlspecialchars($option['nama_tambak']) ?> (<?= htmlspecialchars($option['tanggal_tebar']) ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label for="add_id_pakan" class="block text-sm font-medium text-gray-700 mb-1">Kode Pakan</label>
                        <select id="add_id_pakan" name="id_pakan" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="">Pilih Kode Pakan</option>
                            <?php foreach ($pakan_options as $option): ?>
                                <option value="<?= htmlspecialchars($option['id_pakan']) ?>"><?= htmlspecialchars($option['kode_pakan']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label for="add_usia_pemeliharaan" class="block text-sm font-medium text-gray-700 mb-1">Usia Pemeliharaan (hari)</label>
                        <input type="text" id="add_usia_pemeliharaan" name="usia_pemeliharaan" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                    </div>
                    <div>
                        <label for="add_jumlah_awal" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Awal</label>
                        <input type="text" id="add_jumlah_awal" name="jumlah_awal" required min="0"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                    </div>
                    <div>
                        <label for="add_jumlah_hidup" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Hidup</label>
                        <input type="text" id="add_jumlah_hidup" name="jumlah_hidup" required min="0"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                    </div>
                    <div>
                        <label for="add_jumlah_mati" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Mati</label>
                        <input type="text" id="add_jumlah_mati" name="jumlah_mati" required min="0"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                    </div>
                    <div>
                        <label for="add_tanggal_pemeliharaan" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pemeliharaan</label>
                        <input type="date" id="add_tanggal_pemeliharaan" name="tanggal_pemeliharaan" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                    </div>
                </div>

                <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                    <button type="button" @click="showModal = false"
                        class="px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                        <?php if (empty($tebar_options)) echo 'disabled'; ?>>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div x-show="showEditModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 px-4">
        <div @click.away="showEditModal = false" class="bg-white rounded-lg shadow-lg w-full max-w-4xl mx-auto overflow-hidden border border-gray-200">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">Edit Pemeliharaan Ikan</h2>
                    <button @click="showEditModal = false" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <form action="" method="POST" class="px-6 py-6 space-y-6">
                <input type="hidden" name="edit_pemeliharaan" value="1">
                <input type="hidden" name="id_pemeliharaan" :value="editPemeliharaan.id_pemeliharaan">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="edit_id_tebar" class="block text-sm font-medium text-gray-700 mb-1">Tambak & Tanggal Tebar</label>
                        <select id="edit_id_tebar" name="id_tebar" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <?php
                            // Fetch all tebar options for the edit modal, including ones already used
                            $all_tebar_options = [];
                            $result_all_tebar = mysqli_query($koneksi, "SELECT lt.id_tebar, lt.tanggal_tebar, t.nama_tambak FROM laporan_tebar AS lt JOIN tambak AS t ON lt.id_tambak = t.id_tambak ORDER BY lt.tanggal_tebar DESC");
                            if ($result_all_tebar) {
                                while ($row_all_tebar = mysqli_fetch_assoc($result_all_tebar)) {
                                    $all_tebar_options[] = $row_all_tebar;
                                }
                            }
                            ?>
                            <option value="">Pilih Tambak & Tanggal Tebar</option>
                            <?php foreach ($all_tebar_options as $option): ?>
                                <option value="<?= htmlspecialchars($option['id_tebar']) ?>" :selected="editPemeliharaan.id_tebar == <?= htmlspecialchars($option['id_tebar']) ?>">
                                    <?= htmlspecialchars($option['nama_tambak']) ?> (<?= htmlspecialchars($option['tanggal_tebar']) ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label for="edit_id_pakan" class="block text-sm font-medium text-gray-700 mb-1">Kode Pakan</label>
                        <select id="edit_id_pakan" name="id_pakan" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="">Pilih Kode Pakan</option>
                            <?php foreach ($pakan_options as $option): ?>
                                <option value="<?= htmlspecialchars($option['id_pakan']) ?>" :selected="editPemeliharaan.id_pakan == <?= htmlspecialchars($option['id_pakan']) ?>"><?= htmlspecialchars($option['kode_pakan']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label for="edit_usia_pemeliharaan" class="block text-sm font-medium text-gray-700 mb-1">Usia Pemeliharaan (hari)</label>
                        <input type="text" id="edit_usia_pemeliharaan" name="usia_pemeliharaan" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            :value="editPemeliharaan.usia_pemeliharaan" />
                    </div>
                    <div>
                        <label for="edit_jumlah_awal" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Awal</label>
                        <input type="text" id="edit_jumlah_awal" name="jumlah_awal" required min="0"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            :value="editPemeliharaan.jumlah_awal" />
                    </div>
                    <div>
                        <label for="edit_jumlah_hidup" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Hidup</label>
                        <input type="text" id="edit_jumlah_hidup" name="jumlah_hidup" required min="0"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            :value="editPemeliharaan.jumlah_hidup" />
                    </div>
                    <div>
                        <label for="edit_jumlah_mati" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Mati</label>
                        <input type="text" id="edit_jumlah_mati" name="jumlah_mati" required min="0"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            :value="editPemeliharaan.jumlah_mati" />
                    </div>
                    <div>
                        <label for="edit_tanggal_pemeliharaan" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pemeliharaan</label>
                        <input type="date" id="edit_tanggal_pemeliharaan" name="tanggal_pemeliharaan" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            :value="editPemeliharaan.tanggal_pemeliharaan" />
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
                    <button type="button" @click="showEditModal = false"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
                        Perbarui
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="../assets/js/dashboard.js"></script>