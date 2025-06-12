<?php
// Tidak perlu session_start() jika notifikasi langsung di-echo dalam script
include_once __DIR__ . '/../../config/koneksi.php';

function clean_input_pakan($data) {
    global $koneksi; 
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return mysqli_real_escape_string($koneksi, $data);
}

// --- Logika Hapus Pakan ---
if (isset($_POST['hapus_pakan'])) {
    $id_pakan = intval($_POST['id_pakan']); // Pastikan nama input sesuai dengan form Anda
    $stmt = $koneksi->prepare("DELETE FROM pakan WHERE id_pakan=?");
    $stmt->bind_param("i", $id_pakan);

    if ($stmt->execute()) {
        echo "<script>
            // Pastikan Notyf sudah dimuat di header.php atau file serupa
            const notyf = new Notyf({ duration: 3000, position: { x: 'right', y: 'bottom' } });
            notyf.success('Data pakan berhasil dihapus!');
            setTimeout(() => { window.location.href = ''; }, 1500); // Redirect setelah 1.5 detik
        </script>";
    } else {
        echo "<script>
            // Pastikan Notyf sudah dimuat di header.php atau file serupa
            const notyf = new Notyf({ duration: 3000, position: { x: 'right', y: 'top' } }); // Posisi error di top
            notyf.error('Gagal menghapus data pakan: " . addslashes($stmt->error) . "');
        </script>";
    }
    $stmt->close();
}

// --- Logika Edit Pakan ---
if (isset($_POST['edit_pakan'])) {
    $id_pakan = clean_input_pakan($_POST['id_pakan']);
    $kode_pakan = clean_input_pakan($_POST['kode_pakan']);
    $jenis_pakan = clean_input_pakan($_POST['jenis_pakan']);
    $jumlah = clean_input_pakan($_POST['jumlah']);
    $harga = clean_input_pakan($_POST['harga']);

    // Perbaikan: Pastikan tipe data sesuai dengan kolom database Anda
    // Asumsi: jumlah dan harga adalah integer/decimal
    $stmt = $koneksi->prepare("UPDATE pakan SET kode_pakan=?, jenis_pakan=?, jumlah=?, harga=? WHERE id_pakan=?");
    $stmt->bind_param("ssiii", $kode_pakan, $jenis_pakan, $jumlah, $harga, $id_pakan);

    if ($stmt->execute()) {
        echo "<script>
            const notyf = new Notyf({ duration: 3000, position: { x: 'right', y: 'bottom' } });
            notyf.success('Data pakan berhasil diperbarui!');
            setTimeout(() => { window.location.href = ''; }, 1500);
        </script>";
    } else {
        echo "<script>
            const notyf = new Notyf({ duration: 3000, position: { x: 'right', y: 'top' } });
            notyf.error('Gagal memperbarui data pakan: " . addslashes($stmt->error) . "');
        </script>";
    }
    $stmt->close();
}

// --- Logika Tambah Pakan ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah_pakan'])) {
    $kode_pakan = clean_input_pakan($_POST['kode_pakan']);
    $jenis_pakan = clean_input_pakan($_POST['jenis_pakan']);
    $jumlah = clean_input_pakan($_POST['jumlah']);
    $harga = clean_input_pakan($_POST['harga']);

    // Perbaikan: Pastikan tipe data sesuai dengan kolom database Anda
    // Asumsi: jumlah dan harga adalah integer/decimal
    $stmt = $koneksi->prepare("INSERT INTO pakan (kode_pakan, jenis_pakan, jumlah, harga) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $kode_pakan, $jenis_pakan, $jumlah, $harga);

    if ($stmt->execute()) {
        echo "<script>
            const notyf = new Notyf({ duration: 3000, position: { x: 'right', y: 'bottom' } });
            notyf.success('Data pakan berhasil ditambahkan!');
            setTimeout(() => { window.location.href = ''; }, 1500);
        </script>";
    } else {
        echo "<script>
            const notyf = new Notyf({ duration: 3000, position: { x: 'right', y: 'top' } });
            notyf.error('Gagal menambahkan data pakan: " . addslashes($stmt->error) . "');
        </script>";
    }
    $stmt->close();
}

// Ambil data dari database untuk ditampilkan (ini akan dieksekusi setelah semua POST request diproses)
$sql = "SELECT id_pakan, kode_pakan, jenis_pakan, jumlah, harga FROM pakan ORDER BY id_pakan DESC"; // Sesuaikan kolom yang ingin ditampilkan
$result = mysqli_query($koneksi, $sql);

// Perbaikan: Tambahkan penanganan error untuk mysqli_query
if (!$result) {
    die("Query gagal: " . mysqli_error($koneksi));
}

$no = 1; // Inisialisasi nomor untuk tabel
?>

<div x-data="{ showModal: false, showEditModal: false, editPakan: {} }" x-cloak>

    <main class="p-3 w-full max-w-screen-xl mx-auto"> <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Manajemen Pakan Ikan</h1>
                <p class="text-gray-500 mt-2">Kelola data pakan ikan secara efisien</p>
            </div>

            <button
                @click="showModal = true"
                class="bg-indigo-600 hover:bg-indigo-700 active:scale-95 active:shadow-inner text-white text-sm font-medium px-2 py-2.5 rounded-md shadow-md flex items-center transition-all duration-150 ease-in-out">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Tambah Pakan
            </button>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr class="text-left text-sm font-medium text-gray-500 tracking-wider">
                            <th class="px-6 py-3">No</th>
                            <th class="px-6 py-3">Kode Pakan</th>
                            <th class="px-6 py-3">Jumlah</th>
                            <th class="px-6 py-3">Harga</th>
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
                                            <?= strtoupper(substr($row['kode_pakan'], 0, 1)) ?>
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-900"><?= htmlspecialchars($row['kode_pakan']) ?></div>
                                            <div class="text-gray-500 text-xs">Jenis: <?= htmlspecialchars($row['jenis_pakan']) ?></div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500"><?= htmlspecialchars($row['jumlah']) ?></td>
                                    <td class="px-6 py-4 text-sm text-gray-500">Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                                    <td class="px-6 py-4 text-right text-sm flex justify-end space-x-2">
                                        <button
                                            class="text-indigo-600 hover:text-indigo-900 p-2 rounded bg-indigo-500/10 hover:bg-indigo-500/20"
                                            title="Edit"
                                            @click="editPakan = <?= htmlspecialchars(json_encode($row)) ?>; showEditModal = true">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <form method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data pakan ini?')">
                                            <input type="hidden" name="hapus_pakan" value="1">
                                            <input type="hidden" name="id_pakan" value="<?= $row['id_pakan'] ?>">
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
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500 text-sm">Tidak ada data pakan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <div x-show="showModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 px-4">
        <div @click.away="showModal = false" class="bg-white rounded-xl shadow-xl w-full max-w-md mx-auto overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">Tambah Pakan Ikan</h2>
                    <button @click="showModal = false" class="text-gray-400 hover:text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <form action="" method="POST" class="px-6 py-5 space-y-5">
                <input type="hidden" name="tambah_pakan" value="1" />

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kode Pakan</label>
                    <input type="text" name="kode_pakan" required class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Pakan</label>
                    <input type="text" name="jenis_pakan" required class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah</label>
                    <input type="number" name="jumlah" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                    <input type="number" name="harga" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                </div>

                <div class="flex justify-end space-x-3 pt-2 border-t border-gray-200">
                    <button type="button" @click="showModal = false"
                        class="px-5 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-5 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div x-show="showEditModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 px-4">
        <div @click.away="showEditModal = false" class="bg-white rounded-xl shadow-xl w-full max-w-md mx-auto overflow-hidden">

            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">Edit Pakan Ikan</h2>
                    <button @click="showEditModal = false" class="text-gray-400 hover:text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <form action="" method="POST" class="px-6 py-5 space-y-5">
                <input type="hidden" name="edit_pakan" value="1">
                <input type="hidden" name="id_pakan" :value="editPakan.id_pakan">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kode Pakan</label>
                    <input type="text" name="kode_pakan" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        :value="editPakan.kode_pakan" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Pakan</label>
                    <input type="text" name="jenis_pakan" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        :value="editPakan.jenis_pakan" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah</label>
                    <input type="number" name="jumlah"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        :value="editPakan.jumlah" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                    <input type="number" name="harga"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        :value="editPakan.harga" />
                </div>

                <div class="flex justify-end space-x-3 pt-2 border-t border-gray-200">
                    <button type="button" @click="showEditModal = false"
                        class="px-5 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-5 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        Perbarui
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="../assets/js/dashboard.js"></script>
