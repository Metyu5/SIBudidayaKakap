<?php
// pimpinan/sidebar.php
// Membutuhkan Alpine.js untuk fitur toggle
?>

<aside class="fixed inset-y-0 left-0 z-40 w-64 bg-gradient-to-b from-blue-700 to-blue-900 text-white sidebar"
    :class="{ 'w-64': $data.isSidebarOpen, 'w-20': !$data.isSidebarOpen && $data.isSidebarCollapsed, 'w-0 hidden lg:block': !$data.isSidebarOpen && !$data.isSidebarCollapsed }"
    x-transition:enter="transition transform ease-out duration-300"
    x-transition:enter-start="-translate-x-full lg:translate-x-0"
    x-transition:enter-end="translate-x-0"
    x-transition:leave="transition transform ease-in duration-300"
    x-transition:leave-start="translate-x-0"
    x-transition:leave-end="-translate-x-full lg:translate-x-0">

    <div class="h-16 flex items-center justify-between px-6 border-b border-blue-600">
        <a href="dashboard.php" class="text-white text-2xl font-bold whitespace-nowrap overflow-hidden text-ellipsis">Pimpinan Panel</a>
        <button @click="$data.toggleSidebarCollapse()" class="hidden lg:block p-2 rounded-full hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500" title="Toggle Sidebar">
            <i :class="$data.isSidebarCollapsed ? 'fas fa-arrow-right-from-bracket' : 'fas fa-arrow-left-from-bracket'"></i>
        </button>
        <button @click="$data.closeSidebar()" class="lg:hidden p-2 rounded-full hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500" title="Close Sidebar">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <nav class="flex-1 overflow-y-auto px-4 py-6">
        <ul class="space-y-2">
            <li>
                <a href="dashboard.php?page=home_pimpinan" class="flex items-center p-3 rounded-lg text-white hover:bg-blue-700 transition duration-150 ease-in-out"
                    :class="{'bg-blue-700': $data.currentPath.includes('home_pimpinan')}">
                    <i class="fas fa-chart-line mr-3"></i>
                    <span :class="{'hidden': !$data.isSidebarOpen || ($data.isSidebarOpen && $data.isSidebarCollapsed)}">Dashboard</span>
                </a>
            </li>

            <li>
                <button @click="$data.openSubmenu = ($data.openSubmenu === 'manajemen_pengguna' ? null : 'manajemen_pengguna')"
                    class="flex items-center w-full text-left p-3 rounded-lg text-white hover:bg-blue-700 transition duration-150 ease-in-out"
                    :class="{'bg-blue-700': $data.openSubmenu === 'manajemen_pengguna' || $data.currentPath.includes('kelola_teknisi')}"
                    aria-expanded="false" aria-controls="submenu-manajemen-pengguna">
                    <i class="fas fa-users mr-3"></i>
                    <span :class="{'hidden': !$data.isSidebarOpen || ($data.isSidebarOpen && $data.isSidebarCollapsed)}">Manajemen Pengguna</span>
                    <i class="fas fa-chevron-down ml-auto" :class="{'rotate-180': $data.openSubmenu === 'manajemen_pengguna', 'hidden': !$data.isSidebarOpen || ($data.isSidebarOpen && $data.isSidebarCollapsed)}"></i>
                </button>
                <ul x-show="$data.openSubmenu === 'manajemen_pengguna'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-y-0" x-transition:enter-end="opacity-100 scale-y-100"
                    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-y-100" x-transition:leave-end="opacity-0 scale-y-0"
                    class="pl-8 pt-2 space-y-2 origin-top" :class="{'hidden': !$data.isSidebarOpen || ($data.isSidebarOpen && $data.isSidebarCollapsed)}">
                    <li>
                        <a href="dashboard.php?page=kelola_teknisi" class="flex items-center p-2 rounded-lg text-white hover:bg-blue-600 transition duration-150 ease-in-out"
                            :class="{'bg-blue-600': $data.currentPath.includes('kelola_teknisi')}">
                            <i class="fas fa-user-tie mr-3"></i>
                            <span :class="{'hidden': !$data.isSidebarOpen || ($data.isSidebarOpen && $data.isSidebarCollapsed)}">Kelola Teknisi</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="dashboard.php?page=manajemen_tambak" class="flex items-center p-3 rounded-lg text-white hover:bg-blue-700 transition duration-150 ease-in-out"
                    :class="{'bg-blue-700': $data.currentPath.includes('manajemen_tambak')}">
                    <i class="fas fa-warehouse mr-3"></i>
                    <span :class="{'hidden': !$data.isSidebarOpen || ($data.isSidebarOpen && $data.isSidebarCollapsed)}">Manajemen Tambak</span>
                </a>
            </li>

            <li>
                <a href="dashboard.php?page=manajemen_tugas" class="flex items-center p-3 rounded-lg text-white hover:bg-blue-700 transition duration-150 ease-in-out"
                    :class="{'bg-blue-700': $data.currentPath.includes('manajemen_tugas')}">
                    <i class="fas fa-calendar-check mr-3"></i>
                    <span :class="{'hidden': !$data.isSidebarOpen || ($data.isSidebarOpen && $data.isSidebarCollapsed)}">Manajemen Jadwal & Tugas</span>
                </a>
            </li>

            <li>
                <button @click="$data.openSubmenu = ($data.openSubmenu === 'laporan_global' ? null : 'laporan_global')"
                    class="flex items-center w-full text-left p-3 rounded-lg text-white hover:bg-blue-700 transition duration-150 ease-in-out"
                    :class="{'bg-blue-700': $data.openSubmenu === 'laporan_global' || $data.currentPath.includes('laporan_kualitas_air_global') || $data.currentPath.includes('laporan_pakan_global') || $data.currentPath.includes('laporan_kesehatan_global')}"
                    aria-expanded="false" aria-controls="submenu-laporan-global">
                    <i class="fas fa-chart-bar mr-3"></i>
                    <span :class="{'hidden': !$data.isSidebarOpen || ($data.isSidebarOpen && $data.isSidebarCollapsed)}">Laporan Global</span>
                    <i class="fas fa-chevron-down ml-auto" :class="{'rotate-180': $data.openSubmenu === 'laporan_global', 'hidden': !$data.isSidebarOpen || ($data.isSidebarOpen && $data.isSidebarCollapsed)}"></i>
                </button>
                <ul x-show="$data.openSubmenu === 'laporan_global'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-y-0" x-transition:enter-end="opacity-100 scale-y-100"
                    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-y-100" x-transition:leave-end="opacity-0 scale-y-0"
                    class="pl-8 pt-2 space-y-2 origin-top" :class="{'hidden': !$data.isSidebarOpen || ($data.isSidebarOpen && $data.isSidebarCollapsed)}">
                    <li>
                        <a href="dashboard.php?page=laporan_kualitas_air_global" class="flex items-center p-2 rounded-lg text-white hover:bg-blue-600 transition duration-150 ease-in-out"
                            :class="{'bg-blue-600': $data.currentPath.includes('laporan_kualitas_air_global')}">
                            <i class="fas fa-water mr-3"></i>
                            <span :class="{'hidden': !$data.isSidebarOpen || ($data.isSidebarOpen && $data.isSidebarCollapsed)}">Kualitas Air</span>
                        </a>
                    </li>
                    <li>
                        <a href="dashboard.php?page=laporan_pakan_global" class="flex items-center p-2 rounded-lg text-white hover:bg-blue-600 transition duration-150 ease-in-out"
                            :class="{'bg-blue-600': $data.currentPath.includes('laporan_pakan_global')}">
                            <i class="fas fa-fish-fins mr-3"></i>
                            <span :class="{'hidden': !$data.isSidebarOpen || ($data.isSidebarOpen && $data.isSidebarCollapsed)}">Pemberian Pakan</span>
                        </a>
                    </li>
                    <li>
                        <a href="dashboard.php?page=laporan_kesehatan_global" class="flex items-center p-2 rounded-lg text-white hover:bg-blue-600 transition duration-150 ease-in-out"
                            :class="{'bg-blue-600': $data.currentPath.includes('laporan_kesehatan_global')}">
                            <i class="fas fa-heart-pulse mr-3"></i>
                            <span :class="{'hidden': !$data.isSidebarOpen || ($data.isSidebarOpen && $data.isSidebarCollapsed)}">Kesehatan Ikan</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</aside>