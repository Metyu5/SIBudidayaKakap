<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_tambak";

$koneksi = new mysqli($servername, $username, $password, $dbname);

$statusMessage = "";
$statusClass = "";

if ($koneksi->connect_error) {
    $statusMessage = "Koneksi gagal: " . $koneksi->connect_error;
    $statusClass = "bg-red-100 text-red-800 border border-red-400";
} else {
    $statusMessage = "Koneksi berhasil terhubung";
    $statusClass = "bg-green-100 text-green-800 border border-green-400";
}

// Hanya tampilkan HTML jika file ini diakses langsung (bukan via include)
if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])):
?>
    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Status Koneksi Database</title>
        <link href="../src/output.css" rel="stylesheet">
    </head>

    <body class="bg-gray-50 flex items-center justify-center min-h-screen">
        <div class="max-w-md w-full p-6 rounded-lg shadow-md <?php echo $statusClass; ?>">
            <h1 class="text-xl font-semibold mb-2">Status Koneksi</h1>
            <p class="text-base"><?php echo $statusMessage; ?></p>
        </div>
    </body>

    </html>
<?php endif; ?>