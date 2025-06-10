<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Petugas</title>
    <link rel="icon" href="assets/images/logoHeader.png" />

    <!-- Tailwind -->
    <link href="../src/output.css" rel="stylesheet" />

    <!-- Notyf (Notification) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

    <!-- (Optional) Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="flex flex-col items-center justify-center min-h-screen bg-gray-100">

    <?php session_start(); ?>

    <h1 class="text-3xl font-bold text-gray-800 mb-6">Ini Halaman Petugas</h1>

    <!-- Tombol Logout -->
    <button
        class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-300 shadow-md"
        onclick="confirmLogout()">
        Keluar
    </button>

    <!-- JavaScript: Notyf & Logout Logic -->
    <script>
        function confirmLogout() {
            const notyf = new Notyf({
                duration: 2000
            });

            if (confirm("Yakin mau keluar?")) {
                notyf.success("Berhasil logout!");
                setTimeout(() => {
                    window.location.href = "../index.php";
                }, 1000);
            } else {
                notyf.error("Logout dibatalkan.");
            }
        }

        // Notifikasi sukses saat login
        <?php if (isset($_SESSION['success'])): ?>
            const notyf = new Notyf({
                duration: 3000,
                position: {
                    x: 'right',
                    y: 'bottom'
                },
            });
            notyf.success("<?= $_SESSION['success']; ?>");
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
    </script>

</body>

</html>