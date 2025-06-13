<?php
session_start();
?>
<?php include "header.php" ?>

<body class="bg-gray-50 font-sans antialiased" x-data="dashboard()" x-init="init()" x-cloak>
    <div class="flex h-screen overflow-hidden">
        <div
            x-show="isSidebarOpen && window.innerWidth < 1024"
            @click="closeSidebar()"
            class="fixed inset-0 bg-black bg-opacity-50 z-30 lg:hidden"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-50"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-50"
            x-transition:leave-end="opacity-0">
        </div>

        <?php include 'sidebar.php'; ?>

        <div class="flex-1 flex flex-col overflow-hidden bg-gray-50 main-content"
            :class="{ 'lg:ml-64': !isSidebarCollapsed && isSidebarOpen, 'lg:ml-20': isSidebarCollapsed && isSidebarOpen, 'ml-0': !isSidebarOpen && window.innerWidth < 1024 }">
            <?php include 'topnav.php'; ?>
            <main class="flex-1 p-4 overflow-y-auto">
                <?php
                $page = isset($_GET['page']) ? $_GET['page'] : 'home';
                $file = __DIR__ . "/pages/{$page}.php";
                if (file_exists($file)) {
                    include $file;
                } else {
                    echo "<p class='text-red-500'>Halaman <strong>{$page}</strong> tidak ditemukan untuk Teknisi.</p>";
                }
                ?>
            </main>
            <footer class="bg-white p-4 text-center text-gray-600 text-sm shadow-inner mt-auto border-t border-gray-200">
                &copy; 2025 E-Tambak. Hak Cipta Dilindungi.
            </footer>
        </div>
    </div>
    <script src="assets/js/dashboard.js"></script>
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
            <?php unset($_SESSION['success']); ?>
        </script>
    <?php endif; ?>
</body>

</html>