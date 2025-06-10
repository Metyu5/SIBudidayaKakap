<?php session_start(); ?>
<?php include "header.php" ?>

<body class="bg-gray-50 font-sans antialiased" x-data="dashboard()" x-init="init()" x-cloak>
    <div class="flex h-screen overflow-hidden">
        <!-- Overlay untuk sidebar di mobile -->
        <div
            x-show="isSidebarOpen && window.innerWidth < 1024"
            @click="closeSidebar()"
            class="fixed inset-0 bg-black bg-opacity-50 z-30 lg:hidden">
        </div>

        <?php include 'sidebar.php'; ?>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden main-content"
            :class="{ 'lg:ml-64': !isSidebarCollapsed && isSidebarOpen, 'lg:ml-20': isSidebarCollapsed && isSidebarOpen }">

            <?php include 'topnav.php'; ?>

            <main class="p-4 overflow-y-auto">
                <?php
                $page = isset($_GET['page']) ? $_GET['page'] : 'home';
                $file = __DIR__ . "/pages/{$page}.php";
                if (file_exists($file)) {
                    include $file;
                } else {
                    echo "<p class='text-red-500'>Halaman <strong>{$page}</strong> tidak ditemukan.</p>";
                }
                ?>
            </main>
        </div>
    </div>

    <!-- JS Custom -->
    <script src="assets/js/dashboard.js"></script>

    <!-- PHP untuk notifikasi sukses -->
    <?php if (isset($_SESSION['success'])): ?>
        <script>
            const notyf = new Notyf({
                duration: 3000,
                position: {
                    x: 'right',
                    y: 'bottom'
                },
            });
            notyf.success("<?= $_SESSION['success']; ?>");
        </script>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
</body>

</html>