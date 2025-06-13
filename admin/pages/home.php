<?php
include_once __DIR__ . '/../../config/koneksi.php';

// Inisialisasi variabel untuk menyimpan jumlah data
$total_users = 0;
$total_bibit = 0;
$total_pakan = 0;
$total_tambak = 0;

// Query untuk mendapatkan total users
$sql_users = "SELECT COUNT(*) AS total FROM USERS";
$result_users = $koneksi->query($sql_users);
if ($result_users && $result_users->num_rows > 0) {
    $row_users = $result_users->fetch_assoc();
    $total_users = $row_users['total'];
}

// Query untuk mendapatkan total bibit
$sql_bibit = "SELECT COUNT(*) AS total FROM bibit";
$result_bibit = $koneksi->query($sql_bibit);
if ($result_bibit && $result_bibit->num_rows > 0) {
    $row_bibit = $result_bibit->fetch_assoc();
    $total_bibit = $row_bibit['total'];
}

// Query untuk mendapatkan total pakan
$sql_pakan = "SELECT COUNT(*) AS total FROM PAKAN";
$result_pakan = $koneksi->query($sql_pakan);
if ($result_pakan && $result_pakan->num_rows > 0) {
    $row_pakan = $result_pakan->fetch_assoc();
    $total_pakan = $row_pakan['total'];
}

// Query untuk mendapatkan total tambak
$sql_tambak = "SELECT COUNT(*) AS total FROM TAMBAK";
$result_tambak = $koneksi->query($sql_tambak);
if ($result_tambak && $result_tambak->num_rows > 0) {
    $row_tambak = $result_tambak->fetch_assoc();
    $total_tambak = $row_tambak['total'];
}

// Tutup koneksi database
$koneksi->close();
?>

<main class="flex-1 overflow-y-auto p-6 bg-gray-50">
    <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <h2 class="text-2xl font-bold text-gray-800">Dashboard Administrator</h2>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-blue-500">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Users</p>
                    <p class="text-2xl font-bold text-gray-800"><?php echo $total_users; ?></p>
                </div>
                <div class="h-12 w-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-users text-blue-600"></i>
                </div>
            </div>
            <p class="mt-2 text-xs text-gray-500 font-medium">
                Jumlah pengguna terdaftar: <?php echo $total_users; ?>
            </p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-green-500">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Bibit</p>
                    <p class="text-2xl font-bold text-gray-800"><?php echo $total_bibit; ?></p>
                </div>
                <div class="h-12 w-12 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-seedling text-green-600"></i>
                </div>
            </div>
            <p class="mt-2 text-xs text-gray-500 font-medium">
                Jumlah jenis bibit: <?php echo $total_bibit; ?>
            </p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-yellow-500">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Pakan</p>
                    <p class="text-2xl font-bold text-gray-800"><?php echo $total_pakan; ?></p>
                </div>
                <div class="h-12 w-12 bg-yellow-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-fish text-yellow-600"></i>
                </div>
            </div>
            <p class="mt-2 text-xs text-gray-500 font-medium">
                Jumlah jenis pakan: <?php echo $total_pakan; ?>
            </p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-purple-500">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Tambak</p>
                    <p class="text-2xl font-bold text-gray-800"><?php echo $total_tambak; ?></p>
                </div>
                <div class="h-12 w-12 bg-purple-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-water text-purple-600"></i>
                </div>
            </div>
            <p class="mt-2 text-xs text-gray-500 font-medium">
                Jumlah tambak terdaftar: <?php echo $total_tambak; ?>
            </p>
        </div>
    </div>
</main>