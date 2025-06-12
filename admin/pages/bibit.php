<?php
// Tidak perlu session_start() jika notifikasi langsung di-echo dalam script
include_once __DIR__ . '/../../config/koneksi.php';

// Cek apakah ada permintaan hapus bibit
if (isset($_POST['hapus_bibit'])) {
    $id = intval($_POST['id_bibit']); // Pastikan nama input sesuai dengan form Anda
    $stmt = $koneksi->prepare("DELETE FROM bibit WHERE id_bibit=?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>
            // Pastikan Notyf sudah dimuat di header.php atau file serupa
            const notyf = new Notyf({ duration: 3000, position: { x: 'right', y: 'bottom' } });
            notyf.success('Data bibit berhasil dihapus!');
            setTimeout(() => { window.location.href = ''; }, 1500); // Redirect setelah 1.5 detik
        </script>";
    } else {
        echo "<script>
            // Pastikan Notyf sudah dimuat di header.php atau file serupa
            const notyf = new Notyf({ duration: 3000, position: { x: 'right', y: 'top' } }); // Posisi error di top
            notyf.error('Gagal menghapus data bibit: " . $stmt->error . "');
        </script>";
    }
    $stmt->close();
    // Tidak perlu exit() di sini jika script JavaScript yang mengalihkan
}

// Cek apakah form update dikirim (Edit Bibit)
if (isset($_POST['edit_bibit'])) { // Pastikan nama input sesuai dengan form Anda
    $id             = $_POST['id_bibit'];
    $nama_bibit     = $_POST['nama_bibit'];
    $jenis_ikan     = $_POST['jenis_ikan'];
    $ukuran         = $_POST['ukuran'];
    $umur           = $_POST['umur'];
    $stok           = $_POST['stok'];
    $harga          = $_POST['harga'];
    $supplier       = $_POST['supplier'];
    $tanggal_masuk  = $_POST['tanggal_masuk'];
    $kualitas       = $_POST['kualitas'];
    $status         = $_POST['status'];

    // Perbaikan: Menggunakan 'i' untuk stok (integer) dan 'd' untuk harga (double/decimal)
    $stmt = $koneksi->prepare("UPDATE bibit SET nama_bibit=?, jenis_ikan=?, ukuran=?, umur=?, stok=?, harga=?, supplier=?, tanggal_masuk=?, kualitas=?, status=? WHERE id_bibit=?");
    $stmt->bind_param("ssssiissssi", $nama_bibit, $jenis_ikan, $ukuran, $umur, $stok, $harga, $supplier, $tanggal_masuk, $kualitas, $status, $id);

    if ($stmt->execute()) {
        echo "<script>
            const notyf = new Notyf({ duration: 3000, position: { x: 'right', y: 'bottom' } });
            notyf.success('Data bibit berhasil diperbarui!');
            setTimeout(() => { window.location.href = ''; }, 1500);
        </script>";
    } else {
        echo "<script>
            const notyf = new Notyf({ duration: 3000, position: { x: 'right', y: 'top' } });
            notyf.error('Gagal memperbarui data bibit: " . $stmt->error . "');
        </script>";
    }
    $stmt->close();
}

// Cek jika form tambah bibit dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah_bibit'])) {
    $nama_bibit     = $_POST['nama_bibit'];
    $jenis_ikan     = $_POST['jenis_ikan'];
    $ukuran         = $_POST['ukuran'];
    $umur           = $_POST['umur'];
    $stok           = $_POST['stok'];
    $harga          = $_POST['harga'];
    $supplier       = $_POST['supplier'];
    $tanggal_masuk  = $_POST['tanggal_masuk'];
    $kualitas       = $_POST['kualitas'];
    $status         = $_POST['status'];

    // Perbaikan: Menggunakan 'i' untuk stok (integer) dan 'd' untuk harga (double/decimal)
    $stmt = $koneksi->prepare("INSERT INTO bibit (nama_bibit, jenis_ikan, ukuran, umur, stok, harga, supplier, tanggal_masuk, kualitas, status)
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssiissss", $nama_bibit, $jenis_ikan, $ukuran, $umur, $stok, $harga, $supplier, $tanggal_masuk, $kualitas, $status);

    if ($stmt->execute()) {
        echo "<script>
            const notyf = new Notyf({ duration: 3000, position: { x: 'right', y: 'bottom' } });
            notyf.success('Data bibit berhasil ditambahkan!');
            setTimeout(() => { window.location.href = ''; }, 1500);
        </script>";
    } else {
        echo "<script>
            const notyf = new Notyf({ duration: 3000, position: { x: 'right', y: 'top' } });
            notyf.error('Gagal menambahkan data bibit: " . $stmt->error . "');
        </script>";
    }
    $stmt->close();
}

// Ambil data dari database untuk ditampilkan (ini akan dieksekusi setelah semua POST request diproses)
$sql = "SELECT * FROM bibit";
$result = mysqli_query($koneksi, $sql);

// Perbaikan: Tambahkan penanganan error untuk mysqli_query
if (!$result) {
    die("Query gagal: " . mysqli_error($koneksi));
}

$no = 1; // Inisialisasi nomor untuk tabel
?>

<body class="bg-gray-50 font-sans antialiased">
    <div x-data="{ showModal: false, showEditModal: false, editBibit: {} }" x-cloak>

        <main class="p-3 w-full max-w-screen-2xl mx-auto">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Manajemen Bibit Ikan</h1>
                    <p class="text-gray-500 mt-2">Kelola data bibit ikan secara efisien</p>
                </div>

                <button
                    @click="showModal = true"
                    class="bg-indigo-600 hover:bg-indigo-700 active:scale-95 active:shadow-inner text-white text-sm font-medium px-2 py-2.5 rounded-md shadow-md flex items-center transition-all duration-150 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Tambah Bibit
                </button>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr class="text-left text-sm font-medium text-gray-500 tracking-wider">
                                <th class="px-6 py-3">No</th>
                                <th class="px-6 py-3">Nama Bibit</th>
                                <th class="px-6 py-3">Ukuran</th>
                                <th class="px-6 py-3">Umur</th>
                                <th class="px-6 py-3">Stok</th>
                                <th class="px-6 py-3">Harga</th>
                                <th class="px-6 py-3">Supplier</th>
                                <th class="px-6 py-3">Tgl Masuk</th>
                                <th class="px-6 py-3">Kualitas</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                <?php
                                $status = strtolower($row['status']);
                                $warnaStatus = match ($status) {
                                    'tersedia' => 'bg-green-100 text-green-800',
                                    'habis'    => 'bg-red-100 text-red-800',
                                    default    => 'bg-gray-100 text-gray-800',
                                };
                                ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900"><?= str_pad($no++, 2, '0', STR_PAD_LEFT) ?></td>
                                    <td class="px-6 py-4 flex items-center">
                                        <div class="h-10 w-10 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 font-medium mr-3">
                                            <?= strtoupper(substr($row['nama_bibit'], 0, 1)) ?>
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-900"><?= htmlspecialchars($row['nama_bibit']) ?></div>
                                            <div class="text-gray-500 text-xs">Jenis: <?= htmlspecialchars($row['jenis_ikan']) ?></div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500"><?= htmlspecialchars($row['ukuran']) ?></td>
                                    <td class="px-6 py-4 text-sm text-gray-500"><?= htmlspecialchars($row['umur']) ?></td>
                                    <td class="px-6 py-4 text-sm text-gray-500"><?= htmlspecialchars($row['stok']) ?></td>
                                    <td class="px-6 py-4 text-sm text-gray-500">Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                                    <td class="px-6 py-4 text-sm text-gray-500"><?= htmlspecialchars($row['supplier']) ?></td>
                                    <td class="px-6 py-4 text-sm text-gray-500"><?= htmlspecialchars($row['tanggal_masuk']) ?></td>
                                    <td class="px-6 py-4 text-sm text-gray-500"><?= htmlspecialchars($row['kualitas']) ?></td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full <?= $warnaStatus ?>">
                                            <?= ucfirst($status) ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right text-sm flex justify-end space-x-2">
                                        <button
                                            class="text-indigo-600 hover:text-indigo-900 p-2 rounded bg-indigo-500/10 hover:bg-indigo-500/20"
                                            title="Edit"
                                            @click="editBibit = <?= htmlspecialchars(json_encode($row)) ?>; showEditModal = true">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <form method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus bibit ini?')">
                                            <input type="hidden" name="hapus_bibit" value="1">
                                            <input type="hidden" name="id_bibit" value="<?= $row['id_bibit'] ?>">
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-900 p-2 rounded bg-red-500/10 hover:bg-red-500/20"
                                                title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>

        <div x-show="showModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 px-4">
            <div @click.away="showModal = false" class="bg-white rounded-xl shadow-xl w-full max-w-lg mx-auto overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-semibold text-gray-800">Tambah Bibit Ikan</h2>
                        <button @click="showModal = false" class="text-gray-400 hover:text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <form action="" method="POST" class="px-6 py-5 space-y-5">
                    <input type="hidden" name="tambah_bibit" value="1" />

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Bibit</label>
                            <input type="text" name="nama_bibit" required class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Ikan</label>
                            <input type="text" name="jenis_ikan" required class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Ukuran</label>
                            <input type="text" name="ukuran" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Umur</label>
                            <input type="text" name="umur" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Stok</label>
                            <input type="number" name="stok" required class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                            <input type="number" name="harga" required class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Supplier</label>
                            <input type="text" name="supplier" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Masuk</label>
                            <input type="date" name="tanggal_masuk" required class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kualitas</label>
                            <select name="kualitas" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option value="A">A (Baik)</option>
                                <option value="B">B (Sedang)</option>
                                <option value="C">C (Kurang)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select name="status" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option value="Tersedia">Tersedia</option>
                                <option value="Habis">Habis</option>
                            </select>
                        </div>
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
            <div @click.away="showEditModal = false" class="bg-white rounded-xl shadow-xl w-full max-w-lg mx-auto overflow-hidden">

                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-semibold text-gray-800">Edit Bibit Ikan</h2>
                        <button @click="showEditModal = false" class="text-gray-400 hover:text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <form action="" method="POST" class="px-6 py-5 space-y-5">
                    <input type="hidden" name="edit_bibit" value="1">
                    <input type="hidden" name="id_bibit" :value="editBibit.id_bibit">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Bibit</label>
                            <input type="text" name="nama_bibit" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                :value="editBibit.nama_bibit" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Ikan</label>
                            <input type="text" name="jenis_ikan" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                :value="editBibit.jenis_ikan" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Ukuran</label>
                            <input type="text" name="ukuran"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                :value="editBibit.ukuran" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Umur</label>
                            <input type="text" name="umur"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                :value="editBibit.umur" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Stok</label>
                            <input type="number" name="stok" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                :value="editBibit.stok" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                            <input type="number" name="harga" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                :value="editBibit.harga" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Supplier</label>
                            <input type="text" name="supplier"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                :value="editBibit.supplier" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Masuk</label>
                            <input type="date" name="tanggal_masuk" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                :value="editBibit.tanggal_masuk" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kualitas</label>
                            <select name="kualitas"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <template x-for="opt in ['A', 'B', 'C']">
                                    <option :value="opt" x-text="opt + (opt === 'A' ? ' (Baik)' : opt === 'B' ? ' (Sedang)' : ' (Kurang)')" :selected="editBibit.kualitas === opt"></option>
                                </template>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select name="status"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option value="Tersedia" :selected="editBibit.status === 'Tersedia'">Tersedia</option>
                                <option value="Habis" :selected="editBibit.status === 'Habis'">Habis</option>
                            </select>
                        </div>
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
</body>

</html>