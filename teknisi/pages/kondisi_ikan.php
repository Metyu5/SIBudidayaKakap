<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once __DIR__ . '/../../config/koneksi.php';
if (!isset($_SESSION['usersId'])) {
    header("Location: ../../auth/login.php");
    exit();
}
$id_user = $_SESSION['usersId'];
$query_user = mysqli_query($koneksi, "SELECT nama FROM users WHERE usersId = $id_user AND kategori = 'teknisi'");
$data_user = mysqli_fetch_assoc($query_user);
$nama_teknisi = $data_user['nama'] ?? 'Tidak diketahui';
$bibit_result_form = mysqli_query($koneksi, "SELECT * FROM bibit");
$tambak_result_form = mysqli_query($koneksi, "SELECT * FROM tambak WHERE status = 'Siap'");
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    $id_bibit = intval($_POST['id_bibit'] ?? 0);
    $id_tambak = intval($_POST['id_tambak'] ?? 0);
    $tanggal_tebar = $_POST['tanggal_tebar'] ?? '';
    $jumlah_tebar = intval($_POST['jumlah_tebar'] ?? 0);
    $keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan'] ?? '');
    if ($id_user && $id_bibit && $id_tambak && $tanggal_tebar && $jumlah_tebar) {
        mysqli_begin_transaction($koneksi);
        try {
            $insert_tebar = mysqli_query($koneksi, "INSERT INTO laporan_tebar (id_teknisi, id_bibit, id_tambak, tanggal_tebar, jumlah_tebar, keterangan)
                VALUES ('$id_user', '$id_bibit', '$id_tambak', '$tanggal_tebar', '$jumlah_tebar', '$keterangan')");

            if (!$insert_tebar) {
                throw new Exception("Gagal menyimpan data tebar bibit: " . mysqli_error($koneksi));
            }

            // 2. Kurangi stok di tabel bibit
            $update_stok_bibit = mysqli_query($koneksi, "UPDATE bibit SET stok = stok - '$jumlah_tebar' WHERE id_bibit = '$id_bibit'");

            if (!$update_stok_bibit) {
                throw new Exception("Gagal mengurangi stok bibit: " . mysqli_error($koneksi));
            }

            // 3. Update status tambak menjadi 'Beroperasi' dan set id_bibit, id_teknisi
            $update_status_tambak = mysqli_query($koneksi, "UPDATE tambak SET status = 'Beroperasi', id_bibit = '$id_bibit', id_teknisi = '$id_user', tanggal_mulai = '$tanggal_tebar' WHERE id_tambak = '$id_tambak'");

            if (!$update_status_tambak) {
                throw new Exception("Gagal memperbarui status tambak: " . mysqli_error($koneksi));
            }

            // Commit transaksi jika semua query berhasil
            mysqli_commit($koneksi);

            echo "<script>
                const notyf = new Notyf({ duration: 3000, position: { x: 'right', y: 'bottom' } });
                notyf.success('Data tebar bibit berhasil disimpan, stok dan status tambak diperbarui!');
                setTimeout(() => { window.location.href = ''; }, 1500);
            </script>";
        } catch (Exception $e) {
            // Rollback transaksi jika ada error
            mysqli_rollback($koneksi);
            echo "<script>
                const notyf = new Notyf({ duration: 3000, position: { x: 'right', y: 'top' } });
                notyf.error('" . $e->getMessage() . "');
            </script>";
        }
    } else {
        echo "<script>
            const notyf = new Notyf({ duration: 3000, position: { x: 'right', y: 'top' } });
            notyf.error('Semua field wajib diisi!');
        </script>";
    }
}

// --- Proses update tebar bibit (UPDATE) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit') {
    $id_tebar = intval($_POST['edit_id_tebar'] ?? 0);
    $id_bibit_baru = intval($_POST['edit_id_bibit'] ?? 0); // Ubah nama variabel
    $id_tambak_baru = intval($_POST['edit_id_tambak'] ?? 0); // Ubah nama variabel
    $tanggal_tebar_baru = $_POST['edit_tanggal_tebar'] ?? '';
    $jumlah_tebar_baru = intval($_POST['edit_jumlah_tebar'] ?? 0);
    $keterangan = mysqli_real_escape_string($koneksi, $_POST['edit_keterangan'] ?? '');

    if ($id_tebar && $id_bibit_baru && $id_tambak_baru && $tanggal_tebar_baru && $jumlah_tebar_baru) {
        // Ambil data lama sebelum update untuk penyesuaian stok dan status tambak
        $query_old_data = mysqli_query($koneksi, "SELECT jumlah_tebar, id_bibit, id_tambak FROM laporan_tebar WHERE id_tebar = $id_tebar AND id_teknisi = $id_user");
        $old_data = mysqli_fetch_assoc($query_old_data);

        if (!$old_data) {
            echo "<script>
                const notyf = new Notyf({ duration: 3000, position: { x: 'right', y: 'top' } });
                notyf.error('Data laporan tebar tidak ditemukan untuk pembaruan!');
            </script>";
            exit();
        }

        $jumlah_tebar_lama = $old_data['jumlah_tebar'];
        $id_bibit_lama = $old_data['id_bibit'];
        $id_tambak_lama = $old_data['id_tambak'];

        mysqli_begin_transaction($koneksi); // Mulai transaksi

        try {
            $update_laporan = mysqli_query($koneksi, "UPDATE laporan_tebar SET
                id_bibit = '$id_bibit_baru',
                id_tambak = '$id_tambak_baru',
                tanggal_tebar = '$tanggal_tebar_baru',
                jumlah_tebar = '$jumlah_tebar_baru',
                keterangan = '$keterangan'
                WHERE id_tebar = $id_tebar AND id_teknisi = $id_user");

            if (!$update_laporan) {
                throw new Exception("Gagal memperbarui data tebar bibit: " . mysqli_error($koneksi));
            }

            if ($id_bibit_lama != $id_bibit_baru) {
                $revert_old_bibit_stok = mysqli_query($koneksi, "UPDATE bibit SET stok = stok + '$jumlah_tebar_lama' WHERE id_bibit = '$id_bibit_lama'");
                if (!$revert_old_bibit_stok) {
                    throw new Exception("Gagal mengembalikan stok bibit lama: " . mysqli_error($koneksi));
                }
                $deduct_new_bibit_stok = mysqli_query($koneksi, "UPDATE bibit SET stok = stok - '$jumlah_tebar_baru' WHERE id_bibit = '$id_bibit_baru'");
                if (!$deduct_new_bibit_stok) {
                    throw new Exception("Gagal mengurangi stok bibit baru: " . mysqli_error($koneksi));
                }
            } else {
                $selisih_jumlah = $jumlah_tebar_baru - $jumlah_tebar_lama;
                if ($selisih_jumlah != 0) {
                    $update_stok_selisih = mysqli_query($koneksi, "UPDATE bibit SET stok = stok - '$selisih_jumlah' WHERE id_bibit = '$id_bibit_baru'");
                    if (!$update_stok_selisih) {
                        throw new Exception("Gagal menyesuaikan stok bibit: " . mysqli_error($koneksi));
                    }
                }
            }

            // Logika penyesuaian status tambak
            // Jika tambak berubah, set tambak lama ke 'Siap' dan tambak baru ke 'Beroperasi'
            if ($id_tambak_lama != $id_tambak_baru) {
                // Set tambak lama kembali ke 'Siap', dan kosongkan id_bibit, id_teknisi
                $update_old_tambak = mysqli_query($koneksi, "UPDATE tambak SET status = 'Siap', id_bibit = NULL, id_teknisi = NULL, tanggal_mulai = NULL WHERE id_tambak = '$id_tambak_lama'");
                if (!$update_old_tambak) {
                    throw new Exception("Gagal memperbarui status tambak lama: " . mysqli_error($koneksi));
                }
                // Set tambak baru ke 'Beroperasi' dan set id_bibit, id_teknisi
                $update_new_tambak = mysqli_query($koneksi, "UPDATE tambak SET status = 'Beroperasi', id_bibit = '$id_bibit_baru', id_teknisi = '$id_user', tanggal_mulai = '$tanggal_tebar_baru' WHERE id_tambak = '$id_tambak_baru'");
                if (!$update_new_tambak) {
                    throw new Exception("Gagal memperbarui status tambak baru: " . mysqli_error($koneksi));
                }
            } else {
                // Jika tambak tidak berubah, hanya update id_bibit, id_teknisi, dan tanggal_mulai
                $update_current_tambak = mysqli_query($koneksi, "UPDATE tambak SET status = 'Beroperasi', id_bibit = '$id_bibit_baru', id_teknisi = '$id_user', tanggal_mulai = '$tanggal_tebar_baru' WHERE id_tambak = '$id_tambak_baru'");
                if (!$update_current_tambak) {
                    throw new Exception("Gagal memperbarui status tambak saat ini: " . mysqli_error($koneksi));
                }
            }


            mysqli_commit($koneksi); // Commit transaksi jika semua berhasil

            echo "<script>
                const notyf = new Notyf({ duration: 3000, position: { x: 'right', y: 'bottom' } });
                notyf.success('Data tebar bibit berhasil diperbarui, stok dan status tambak disesuaikan!');
                setTimeout(() => { window.location.href = ''; }, 1500);
            </script>";
        } catch (Exception $e) {
            mysqli_rollback($koneksi); // Rollback jika ada error
            echo "<script>
                const notyf = new Notyf({ duration: 3000, position: { x: 'right', y: 'top' } });
                notyf.error('Terjadi kesalahan saat memperbarui: " . $e->getMessage() . "');
            </script>";
        }
    } else {
        echo "<script>
            const notyf = new Notyf({ duration: 3000, position: { x: 'right', y: 'top' } });
            notyf.error('Semua field wajib diisi untuk pembaruan!');
        </script>";
    }
}


// --- Proses hapus tebar bibit (DELETE) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    $id_tebar = intval($_POST['delete_id_tebar'] ?? 0);

    if ($id_tebar) {
        // Ambil jumlah tebar, id bibit, dan id tambak sebelum dihapus untuk mengembalikan stok dan status
        $query_tebar_data = mysqli_query($koneksi, "SELECT jumlah_tebar, id_bibit, id_tambak FROM laporan_tebar WHERE id_tebar = $id_tebar AND id_teknisi = $id_user");
        $tebar_data = mysqli_fetch_assoc($query_tebar_data);

        if ($tebar_data) {
            $jumlah_tebar_yang_dihapus = $tebar_data['jumlah_tebar'];
            $id_bibit_yang_dihapus = $tebar_data['id_bibit'];
            $id_tambak_yang_dihapus = $tebar_data['id_tambak'];

            mysqli_begin_transaction($koneksi); // Mulai transaksi

            try {
                // Hapus dari laporan_tebar
                $delete = mysqli_query($koneksi, "DELETE FROM laporan_tebar WHERE id_tebar = $id_tebar AND id_teknisi = $id_user");

                if (!$delete) {
                    throw new Exception("Gagal menghapus data tebar bibit: " . mysqli_error($koneksi));
                }

                // Kembalikan stok di tabel bibit
                $restore_stok = mysqli_query($koneksi, "UPDATE bibit SET stok = stok + '$jumlah_tebar_yang_dihapus' WHERE id_bibit = '$id_bibit_yang_dihapus'");

                if (!$restore_stok) {
                    throw new Exception("Gagal mengembalikan stok bibit: " . mysqli_error($koneksi));
                }

                // Set status tambak yang bersangkutan kembali menjadi 'Siap', dan kosongkan id_bibit, id_teknisi
                $reset_tambak_status = mysqli_query($koneksi, "UPDATE tambak SET status = 'Siap', id_bibit = NULL, id_teknisi = NULL, tanggal_mulai = NULL WHERE id_tambak = '$id_tambak_yang_dihapus'");

                if (!$reset_tambak_status) {
                    throw new Exception("Gagal mereset status tambak: " . mysqli_error($koneksi));
                }

                mysqli_commit($koneksi); // Commit transaksi jika semua berhasil

                echo "<script>
                    const notyf = new Notyf({ duration: 3000, position: { x: 'right', y: 'bottom' } });
                    notyf.success('Data tebar bibit berhasil dihapus, stok dan status tambak dikembalikan!');
                    setTimeout(() => { window.location.href = ''; }, 1500);
                </script>";
            } catch (Exception $e) {
                mysqli_rollback($koneksi); // Rollback jika ada error
                echo "<script>
                    const notyf = new Notyf({ duration: 3000, position: { x: 'right', y: 'top' } });
                    notyf.error('Terjadi kesalahan saat menghapus: " . $e->getMessage() . "');
                </script>";
            }
        } else {
            echo "<script>
                const notyf = new Notyf({ duration: 3000, position: { x: 'right', y: 'top' } });
                notyf.error('Data laporan tebar tidak ditemukan untuk penghapusan!');
            </script>";
        }
    } else {
        echo "<script>
            const notyf = new Notyf({ duration: 3000, position: { x: 'right', y: 'top' } });
            notyf.error('ID laporan tidak valid untuk penghapusan!');
        </script>";
    }
}


// Ambil riwayat tebar bibit teknisi ini (SETELAH semua POST request diproses)
// PENTING: Pastikan lt.id_tebar ada di tabel Anda
$riwayat_result = mysqli_query($koneksi, "SELECT lt.id_tebar, lt.tanggal_tebar, lt.jumlah_tebar, lt.keterangan,
    b.nama_bibit, b.id_bibit, t.nama_tambak, t.id_tambak, u.nama AS nama_teknisi
    FROM laporan_tebar lt
    JOIN bibit b ON lt.id_bibit = b.id_bibit
    JOIN tambak t ON lt.id_tambak = t.id_tambak
    JOIN users u ON lt.id_teknisi = u.usersId
    WHERE lt.id_teknisi = $id_user ORDER BY lt.tanggal_tebar DESC");

if (!$riwayat_result) {
    die("Query riwayat gagal: " . mysqli_error($koneksi));
}
$no = 1;
?>

<div class="container mx-auto px-4 py-6">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Tebar Bibit</h2>

    <div class="bg-white p-6 rounded-lg shadow-md mb-5">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Input Tebar Bibit</h3>
        <form action="" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input type="hidden" name="action" value="add">
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Teknisi</label>
                <input type="text" value="<?= htmlspecialchars($nama_teknisi) ?>" disabled class="w-full bg-gray-100 border border-gray-300 rounded-md px-3 py-2 text-sm">
            </div>
            <div>
                <label for="id_bibit" class="block text-sm font-medium text-gray-700">Pilih Bibit</label>
                <select name="id_bibit" id="id_bibit" class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 text-sm" required>
                    <option value="">-- Pilih Bibit --</option>
                    <?php
                    // Reset pointer for bibit_result_form if it was consumed by a previous loop
                    mysqli_data_seek($bibit_result_form, 0);
                    while ($row = mysqli_fetch_assoc($bibit_result_form)): ?>
                        <option value="<?= $row['id_bibit'] ?>"><?= htmlspecialchars($row['nama_bibit']) ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div>
                <label for="id_tambak" class="block text-sm font-medium text-gray-700">Pilih Tambak</label>
                <select name="id_tambak" id="id_tambak" class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 text-sm" required>
                    <option value="">-- Pilih Tambak --</option>
                    <?php
                    // Reset pointer for tambak_result_form
                    mysqli_data_seek($tambak_result_form, 0);
                    while ($row = mysqli_fetch_assoc($tambak_result_form)): ?>
                        <option value="<?= $row['id_tambak'] ?>"><?= htmlspecialchars($row['nama_tambak']) ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div>
                <label for="tanggal_tebar" class="block text-sm font-medium text-gray-700">Tanggal Tebar</label>
                <input type="date" name="tanggal_tebar" id="tanggal_tebar" class="w-full border border-gray-300 rounded-md py-2 px-3 text-sm" required>
            </div>
            <div>
                <label for="jumlah_tebar" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Tebar</label>
                <input type="number" id="jumlah_tebar" name="jumlah_tebar"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required />
            </div>

            <div class="md:col-span-2">
                <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                <textarea name="keterangan" id="keterangan" rows="3"
                    class="w-full border border-gray-300 rounded-md py-2 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
            </div>
            <div class="md:col-span-2 flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">Simpan</button>
            </div>
        </form>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Riwayat Tebar Bibit</h3>
        <div class="overflow-auto rounded-lg border border-gray-200" style="max-height: 400px;">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr class="text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        <th class="px-6 py-3 text-left w-12 sticky top-0 bg-gray-50 z-10">No</th>
                        <th class="px-6 py-3 text-left min-w-[120px] sticky top-0 bg-gray-50 z-10">Tanggal</th>
                        <th class="px-6 py-3 text-left min-w-[150px] sticky top-0 bg-gray-50 z-10">Nama Teknisi</th>
                        <th class="px-6 py-3 text-left min-w-[150px] sticky top-0 bg-gray-50 z-10">Bibit</th>
                        <th class="px-6 py-3 text-left min-w-[150px] sticky top-0 bg-gray-50 z-10">Tambak</th>
                        <th class="px-6 py-3 text-center min-w-[120px] sticky top-0 bg-gray-50 z-10">Jumlah Tebar</th>
                        <th class="px-6 py-3 text-left min-w-[200px] sticky top-0 bg-gray-50 z-10">Keterangan</th>
                        <th class="px-6 py-3 text-center sticky top-0 bg-gray-50 z-10">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    <?php if (mysqli_num_rows($riwayat_result) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($riwayat_result)): ?>
                            <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                <td class="px-6 py-4 text-sm text-gray-700 whitespace-nowrap">
                                    <?= str_pad($no++, 2, '0', STR_PAD_LEFT) ?>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700 whitespace-nowrap">
                                    <?= htmlspecialchars($row['tanggal_tebar']) ?>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700 whitespace-nowrap">
                                    <?= htmlspecialchars($row['nama_teknisi'] ?? 'N/A') ?>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700 whitespace-normal">
                                    <div class="font-medium text-gray-900"><?= htmlspecialchars($row['nama_bibit']) ?></div>
                                    <div class="text-gray-500 text-xs">ID: <?= htmlspecialchars($row['id_bibit']) ?></div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700 whitespace-normal">
                                    <div class="font-medium text-gray-900"><?= htmlspecialchars($row['nama_tambak']) ?></div>
                                    <div class="text-gray-500 text-xs">ID: <?= htmlspecialchars($row['id_tambak']) ?></div>
                                </td>
                                <td class="px-6 py-4 text-center text-sm text-gray-700">
                                    <span class="inline-flex items-center px-3 py-1 bg-indigo-500 text-white rounded-full text-xs font-semibold shadow-sm">
                                        <?= number_format($row['jumlah_tebar'], 0, ',', '.') ?> Ekor
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600 max-w-xs overflow-hidden text-ellipsis whitespace-nowrap" title="<?= htmlspecialchars($row['keterangan']) ?>">
                                    <?= htmlspecialchars($row['keterangan']) ?>
                                </td>
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    <div class="flex items-center justify-center space-x-2">
                                        <button
                                            @click="$dispatch('open-detail-modal', {
                                                id: '<?= $row['id_tebar'] ?>',
                                                tanggal: '<?= htmlspecialchars($row['tanggal_tebar']) ?>',
                                                teknisi: '<?= htmlspecialchars($row['nama_teknisi'] ?? 'N/A') ?>',
                                                bibit: '<?= htmlspecialchars($row['nama_bibit']) ?>',
                                                id_bibit: '<?= htmlspecialchars($row['id_bibit']) ?>',
                                                tambak: '<?= htmlspecialchars($row['nama_tambak']) ?>',
                                                id_tambak: '<?= htmlspecialchars($row['id_tambak']) ?>',
                                                jumlah: '<?= htmlspecialchars($row['jumlah_tebar']) ?>',
                                                keterangan: '<?= htmlspecialchars($row['keterangan']) ?>'
                                            })"
                                            class="text-blue-600 hover:text-blue-900 p-2 rounded-full hover:bg-blue-100 transition-colors duration-200"
                                            title="Lihat Detail">
                                            <i class="fas fa-eye text-lg"></i>
                                        </button>
                                        <button
                                            @click="$dispatch('open-edit-modal', {
                                                id: '<?= $row['id_tebar'] ?>',
                                                tanggal: '<?= htmlspecialchars($row['tanggal_tebar']) ?>',
                                                id_bibit: '<?= htmlspecialchars($row['id_bibit']) ?>',
                                                id_tambak: '<?= htmlspecialchars($row['id_tambak']) ?>',
                                                jumlah: '<?= htmlspecialchars($row['jumlah_tebar']) ?>',
                                                keterangan: '<?= htmlspecialchars($row['keterangan']) ?>'
                                            })"
                                            class="text-indigo-600 hover:text-indigo-900 p-2 rounded bg-indigo-500/10 hover:bg-indigo-500/20"
                                            title="Edit Data">
                                            <i class="fas fa-edit text-lg"></i>
                                        </button>
                                        <button
                                            @click="$dispatch('open-delete-modal', {
                                                id: '<?= $row['id_tebar'] ?>',
                                                tanggal: '<?= htmlspecialchars($row['tanggal_tebar']) ?>',
                                                bibit_nama: '<?= htmlspecialchars($row['nama_bibit']) ?>',
                                                tambak_nama: '<?= htmlspecialchars($row['nama_tambak']) ?>'
                                            })"
                                            class="text-red-600 hover:text-red-900 p-2 rounded bg-red-500/10 hover:bg-red-500/20"
                                            title="Hapus Data">
                                            <i class="fas fa-trash-alt text-lg"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-gray-500 italic">Belum ada riwayat tebar bibit yang tercatat.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div
    x-data="{
        show: false,
        data: {},
        formatNumber(num) {
            return new Intl.NumberFormat('id-ID').format(num);
        }
    }"
    @open-detail-modal.window="show = true; data = $event.detail"
    x-show="show"
    x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
    class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 px-4"
    x-cloak
    @click.away="show = false">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-lg mx-auto overflow-hidden border border-gray-200" @click.stop>
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                    <i class="fas fa-info-circle mr-3 text-blue-600"></i> Detail Tebar Bibit
                </h2>
                <button @click="show = false" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="px-6 py-6 space-y-4 text-base text-gray-700">
            <p><strong>No. Laporan:</strong> <span x-text="data.id"></span></p>
            <p><strong>Tanggal Tebar:</strong> <span x-text="data.tanggal"></span></p>
            <p><strong>Nama Teknisi:</strong> <span x-text="data.teknisi"></span></p>
            <p><strong>Bibit:</strong> <span x-text="data.bibit"></span> (ID: <span x-text="data.id_bibit"></span>)</p>
            <p><strong>Tambak:</strong> <span x-text="data.tambak"></span> (ID: <span x-text="data.id_tambak"></span>)</p>
            <p><strong>Jumlah Tebar:</strong> <span x-text="formatNumber(data.jumlah)"></span> Ekor</p>
            <div>
                <strong class="block mb-1">Keterangan:</strong>
                <p x-text="data.keterangan" class="block mt-1 p-3 bg-gray-100 rounded-lg border border-gray-200 text-sm leading-relaxed"></p>
            </div>
        </div>

        <div class="flex justify-end gap-3 pt-4 px-6 pb-6 border-t border-gray-200">
            <button type="button" @click="show = false"
                class="px-4 py-2 text-sm font-medium text-white bg-red-500 border border-gray-300 rounded-md hover:bg-red-400 transition">
                Tutup
            </button>
        </div>
    </div>
</div>

<div
    x-data="{
        show: false,
        formData: {
            id: '',
            tanggal: '',
            id_bibit: '',
            id_tambak: '',
            jumlah: '',
            keterangan: ''
        }
    }"
    @open-edit-modal.window="show = true; formData = $event.detail"
    x-show="show"
    x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
    class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 px-4"
    x-cloak
    @click.away="show = false">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-4xl mx-auto overflow-hidden border border-gray-200" @click.stop>
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Edit Tebar Bibit</h2>
                <button @click="show = false" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <form id="editForm" action="" method="POST" class="px-6 py-6 space-y-6">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="edit_id_tebar" x-model="formData.id">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="edit-tanggal-tebar" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Tebar</label>
                    <input type="date" name="edit_tanggal_tebar" id="edit-tanggal-tebar" x-model="formData.tanggal"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>
                <div>
                    <label for="edit-id-bibit" class="block text-sm font-medium text-gray-700 mb-1">Pilih Bibit</label>
                    <select name="edit_id_bibit" id="edit-id-bibit" x-model="formData.id_bibit"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                        <option value="">-- Pilih Bibit --</option>
                        <?php
                        // Reset pointer for bibit_result_form for edit modal
                        mysqli_data_seek($bibit_result_form, 0);
                        while ($row = mysqli_fetch_assoc($bibit_result_form)): ?>
                            <option value="<?= $row['id_bibit'] ?>"><?= htmlspecialchars($row['nama_bibit']) ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div>
                    <label for="edit-id-tambak" class="block text-sm font-medium text-gray-700 mb-1">Pilih Tambak</label>
                    <select name="edit_id_tambak" id="edit-id-tambak" x-model="formData.id_tambak"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                        <option value="">-- Pilih Tambak --</option>
                        <?php
                        // Reset pointer for tambak_result_form for edit modal
                        // Untuk edit, tambak yang sedang beroperasi (terkait dengan laporan tebar ini) juga harus muncul.
                        // Jadi kita perlu query ulang atau mengambil data tambak tanpa filter 'Siap' untuk modal edit.
                        // Ini adalah salah satu pendekatan: Ambil semua tambak
                        $tambak_result_edit_form = mysqli_query($koneksi, "SELECT * FROM tambak");
                        mysqli_data_seek($tambak_result_edit_form, 0);
                        while ($row = mysqli_fetch_assoc($tambak_result_edit_form)): ?>
                            <option value="<?= $row['id_tambak'] ?>"><?= htmlspecialchars($row['nama_tambak']) ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div>
                    <label for="edit-jumlah-tebar" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Tebar</label>
                    <input type="number" name="edit_jumlah_tebar" id="edit-jumlah-tebar" x-model="formData.jumlah"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>
            </div>
            <div>
                <label for="edit-keterangan" class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                <textarea name="edit_keterangan" id="edit-keterangan" rows="3" x-model="formData.keterangan"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
                <button type="button" @click="show = false"
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

<div
    x-data="{
        show: false,
        deleteId: '',
        deleteTanggal: '',
        deleteBibit: '',
        deleteTambak: ''
    }"
    @open-delete-modal.window="show = true; deleteId = $event.detail.id; deleteTanggal = $event.detail.tanggal; deleteBibit = $event.detail.bibit_nama; deleteTambak = $event.detail.tambak_nama;"
    x-show="show"
    x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
    class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4"
    x-cloak
    @click.away="show = false">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-lg mx-auto overflow-hidden border border-gray-200" @click.stop>
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                    <i class="fas fa-exclamation-triangle mr-3 text-red-600"></i> Konfirmasi Hapus
                </h2>
                <button @click="show = false" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <form id="deleteForm" action="" method="POST" class="px-6 py-6 space-y-6">
            <p class="text-gray-700 text-base leading-relaxed">
                Apakah Anda yakin ingin menghapus data tebar bibit pada tanggal
                <span x-text="deleteTanggal" class="font-semibold text-red-700"></span>
                (<span x-text="deleteBibit" class="font-semibold text-red-700"></span>
                di <span x-text="deleteTambak" class="font-semibold text-red-700"></span>)?
                Tindakan ini tidak dapat dibatalkan.
            </p>

            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="delete_id_tebar" x-model="deleteId">

            <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
                <button type="button" @click="show = false"
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400 transition">
                    Hapus
                </button>
            </div>
        </form>
    </div>
</div>
<script src="../assets/js/dashboard.js"></script>