<?php
// teknisi/sidebar.php
$current_page = isset($_GET['page']) ? $_GET['page'] : 'home';

function activeMenu($pageName)
{
    global $current_page;
    return $current_page === $pageName ? 'bg-blue-700 text-white' : 'text-blue-200 hover:bg-blue-700';
}

// Fungsi untuk memeriksa apakah dropdown harus terbuka berdasarkan current_page
function isDropdownOpen($pages = [])
{
    global $current_page;
    return in_array($current_page, $pages);
}
?>

<aside class="fixed inset-y-0 left-0 z-40 w-64 bg-gradient-to-b from-blue-800 to-blue-900 text-white sidebar"
    :class="{
        'translate-x-0': isSidebarOpen,
        '-translate-x-full': !isSidebarOpen,
        'sidebar-collapsed': isSidebarCollapsed
    }"
    x-transition:enter="transition ease-out duration-300 transform"
    x-transition:enter-start="-translate-x-full"
    x-transition:enter-end="translate-x-0"
    x-transition:leave="transition ease-in duration-300 transform"
    x-transition:leave-start="translate-x-0"
    x-transition:leave-end="-translate-x-full">
    <div class="px-4 py-6 h-full flex flex-col">
        <div class="mb-6 px-4 py-3 bg-blue-700 rounded-lg flex items-center justify-between">
            <div class="flex items-center">
                <img src="../assets/images/settings.png" alt="Teknisi" class="h-10 w-10 rounded-full">
                <div class="ml-3 sidebar-item-text">
                    <p class="text-sm font-medium">Teknisi Lapangan</p>
                    <p class="text-xs text-blue-200">Pengelola Tambak</p>
                </div>
            </div>
            <button @click="closeSidebar()" class="lg:hidden text-blue-200 hover:text-white" x-show="isSidebarOpen">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <nav class="space-y-1 flex-1 overflow-y-auto custom-scrollbar pr-2">
            <a href="dashboard.php?page=home"
                class="flex items-center px-4 py-2 text-sm font-medium rounded-lg sidebar-item <?= activeMenu('home') ?>">
                <i class="fas fa-home mr-3 text-blue-300"></i>
                <span class="sidebar-item-text">Dashboard</span>
            </a>

            <div x-data="{ open: <?= var_export(isDropdownOpen(['data_tambak', 'kualitas_air', 'kondisi_ikan', 'laporan_air', 'laporan_pakan', 'laporan_kesehatan']), true) ?> }">
                <button @click="open = !open"
                    class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium rounded-lg hover:bg-blue-700 text-white sidebar-item">
                    <div class="flex items-center">
                        <i class="fas fa-water mr-3 text-blue-300"></i>
                        <span class="sidebar-item-text whitespace-nowrap">Manajemen Tambak</span>
                    </div>
                    <i class="fas fa-chevron-down text-xs transition-transform duration-200 sidebar-dropdown-icon ml-3" 
                        :class="open ? 'transform rotate-180' : ''"></i>
                </button>
                <div x-show="open" x-collapse class="ml-7 mt-3 space-y-1 sidebar-dropdown-items">
                    <a href="dashboard.php?page=data_tambak" class="flex items-center px-3 py-2 text-sm rounded-lg <?= activeMenu('data_tambak') ?>">
                        <i class="fas fa-ruler-combined mr-2 w-4 text-blue-300"></i> Data Tambak
                    </a>
                    <a href="dashboard.php?page=kondisi_ikan" class="flex items-center px-3 py-2 text-sm rounded-lg <?= activeMenu('kondisi_ikan') ?>">
                        <i class="fas fa-fish mr-2 w-4 text-blue-300"></i> Tebar Bibit
                    </a>
                    <a href="dashboard.php?page=kualitas_air" class="flex items-center px-3 py-2 text-sm rounded-lg <?= activeMenu('kualitas_air') ?>">
                        <i class="fas fa-temperature-full mr-2 w-4 text-blue-300"></i> Pemeliharaan ikan
                    </a>
                    
                </div>
            </div>

            <!-- <a href="dashboard.php?page=jadwal"
                class="flex items-center px-4 py-2 text-sm font-medium rounded-lg sidebar-item <?= activeMenu('jadwal') ?>">
                <i class="fas fa-calendar-check mr-3 text-blue-300"></i>
                <span class="sidebar-item-text">Jadwal & Tugas</span>
            </a> -->
        </nav>
    </div>
</aside>

<style>
    /* PENTING: Pastikan CSS ini ada di file CSS utama Anda atau di dalam tag <head> */
    /* Untuk browser berbasis Webkit (Chrome, Safari, Edge, dll.) */
    .custom-scrollbar::-webkit-scrollbar {
        width: 8px;
        /* Lebar scrollbar */
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
        /* Latar belakang track transparan */
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background-color: rgba(255, 255, 255, 0.2);
        /* Warna thumb (pegangan) scrollbar, sedikit transparan */
        border-radius: 4px;
        /* Sudut melengkung pada thumb */
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background-color: rgba(255, 255, 255, 0.4);
        /* Warna thumb saat hover */
    }

    /* Untuk Firefox */
    .custom-scrollbar {
        scrollbar-width: thin;
        /* Membuat scrollbar tipis */
        scrollbar-color: rgba(255, 255, 255, 0.2) transparent;
        /* Warna thumb dan track */
    }


</style>