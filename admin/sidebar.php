<?php
$current_page = isset($_GET['page']) ? $_GET['page'] : 'home';

function activeMenu($pageName)
{
    global $current_page;
    return $current_page === $pageName ? 'bg-blue-700 text-white' : 'text-blue-200 hover:bg-blue-700';
}

function isDropdownOpen($pages = [])
{
    global $current_page;
    return in_array($current_page, $pages);
}
?>

<!-- Sidebar -->
<aside class="fixed inset-y-0 left-0 z-30 w-64 bg-gradient-to-b from-blue-800 to-blue-900 text-white sidebar"
    :class="{
        'translate-x-0': isSidebarOpen,
        '-translate-x-full': !isSidebarOpen,
        'sidebar-collapsed': isSidebarCollapsed
    }">
    <div class="px-4 py-6 h-[calc(100vh-73px)]">
        <!-- Admin Info -->
        <div class="mb-6 px-4 py-3 bg-blue-700 rounded-lg">
            <div class="flex items-center">
                <img src="../assets/images/settings.png" alt="Admin" class="h-10 w-10 rounded-full">
                <div class="ml-3 sidebar-item-text">
                    <p class="text-sm font-medium">Administrator</p>
                    <p class="text-xs text-blue-200">Master Data</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="space-y-1">
            <!-- Dashboard -->
            <a href="dashboard.php?page=home"
                class="flex items-center px-4 py-3 text-sm font-medium rounded-lg sidebar-item <?= activeMenu('home') ?>">
                <i class="fas fa-tachometer-alt mr-3 text-blue-300"></i>
                <span class="sidebar-item-text">Dashboard</span>
            </a>

            <!-- Master Data -->
            <div x-data="{ open: <?= var_export(isDropdownOpen(['users', 'bibit', 'pakan', 'kolam']), true) ?> }">
                <button @click="open = !open"
                    class="flex items-center justify-between w-full px-4 py-3 text-sm font-medium rounded-lg hover:bg-blue-700 text-white sidebar-item">
                    <div class="flex items-center">
                        <i class="fas fa-table mr-3 text-blue-300"></i>
                        <span class="sidebar-item-text">Master Data</span>
                    </div>
                    <i class="fas fa-chevron-down text-xs transition-transform duration-200 sidebar-dropdown-icon"
                        :class="open ? 'transform rotate-180' : ''"></i>
                </button>
                <div x-show="open" x-collapse class="ml-8 mt-1 space-y-1 sidebar-dropdown-items">
                    <a href="dashboard.php?page=users" class="flex items-center px-3 py-2 text-sm rounded-lg <?= activeMenu('users') ?>">
                        <i class="fas fa-user mr-2 w-4 text-blue-300"></i> Pengguna
                    </a>
                    <a href="dashboard.php?page=bibit" class="flex items-center px-3 py-2 text-sm rounded-lg <?= activeMenu('bibit') ?>">
                        <i class="fas fa-seedling mr-2 w-4 text-blue-300"></i> Bibit
                    </a>
                    <a href="dashboard.php?page=pakan" class="flex items-center px-3 py-2 text-sm rounded-lg <?= activeMenu('pakan') ?>">
                        <i class="fas fa-fish mr-2 w-4 text-blue-300"></i> Pakan
                    </a>
                    <a href="dashboard.php?page=kolam" class="flex items-center px-3 py-2 text-sm rounded-lg <?= activeMenu('kolam') ?>">
                        <i class="fas fa-water mr-2 w-4 text-blue-300"></i> Kolam
                    </a>
                </div>
            </div>

            <!-- Water Quality -->
            <div x-data="{ open: <?= var_export(isDropdownOpen(['temperature', 'ph', 'oxygen', 'salinity']), true) ?> }">
                <button @click="open = !open"
                    class="flex items-center justify-between w-full px-4 py-3 text-sm font-medium rounded-lg hover:bg-blue-700 text-white sidebar-item">
                    <div class="flex items-center">
                        <i class="fas fa-tint mr-3 text-blue-300"></i>
                        <span class="sidebar-item-text">Water Quality</span>
                    </div>
                    <i class="fas fa-chevron-down text-xs transition-transform duration-200 sidebar-dropdown-icon"
                        :class="open ? 'transform rotate-180' : ''"></i>
                </button>
                <div x-show="open" x-collapse class="ml-8 mt-1 space-y-1 sidebar-dropdown-items">
                    <a href="dashboard.php?page=temperature" class="block px-3 py-2 text-sm rounded-lg <?= activeMenu('temperature') ?>">Temperature</a>
                    <a href="dashboard.php?page=ph" class="block px-3 py-2 text-sm rounded-lg <?= activeMenu('ph') ?>">pH Levels</a>
                    <a href="dashboard.php?page=oxygen" class="block px-3 py-2 text-sm rounded-lg <?= activeMenu('oxygen') ?>">Oxygen Levels</a>
                    <a href="dashboard.php?page=salinity" class="block px-3 py-2 text-sm rounded-lg <?= activeMenu('salinity') ?>">Salinity</a>
                </div>
            </div>

            <!-- Seaweed Integration -->
            <div x-data="{ open: <?= var_export(isDropdownOpen(['symbiotic', 'growth', 'nutrient']), true) ?> }">
                <button @click="open = !open"
                    class="flex items-center justify-between w-full px-4 py-3 text-sm font-medium rounded-lg hover:bg-blue-700 text-white sidebar-item">
                    <div class="flex items-center">
                        <i class="fas fa-leaf mr-3 text-blue-300"></i>
                        <span class="sidebar-item-text">Seaweed Integration</span>
                    </div>
                    <i class="fas fa-chevron-down text-xs transition-transform duration-200 sidebar-dropdown-icon"
                        :class="open ? 'transform rotate-180' : ''"></i>
                </button>
                <div x-show="open" x-collapse class="ml-8 mt-1 space-y-1 sidebar-dropdown-items">
                    <a href="dashboard.php?page=symbiotic" class="block px-3 py-2 text-sm rounded-lg <?= activeMenu('symbiotic') ?>">Symbiotic Analysis</a>
                    <a href="dashboard.php?page=growth" class="block px-3 py-2 text-sm rounded-lg <?= activeMenu('growth') ?>">Growth Comparison</a>
                    <a href="dashboard.php?page=nutrient" class="block px-3 py-2 text-sm rounded-lg <?= activeMenu('nutrient') ?>">Nutrient Exchange</a>
                </div>
            </div>

            <!-- Reports -->
            <a href="dashboard.php?page=reports" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg sidebar-item <?= activeMenu('reports') ?>">
                <i class="fas fa-chart-bar mr-3 text-blue-300"></i>
                <span class="sidebar-item-text">Reports & Analytics</span>
            </a>

            <!-- Settings -->
            <div x-data="{ open: <?= var_export(isDropdownOpen(['user_settings', 'system_config', 'notifications']), true) ?> }">
                <button @click="open = !open"
                    class="flex items-center justify-between w-full px-4 py-3 text-sm font-medium rounded-lg hover:bg-blue-700 text-white sidebar-item">
                    <div class="flex items-center">
                        <i class="fas fa-cog mr-3 text-blue-300"></i>
                        <span class="sidebar-item-text">Settings</span>
                    </div>
                    <i class="fas fa-chevron-down text-xs transition-transform duration-200 sidebar-dropdown-icon"
                        :class="open ? 'transform rotate-180' : ''"></i>
                </button>
                <div x-show="open" x-collapse class="ml-8 mt-1 space-y-1 sidebar-dropdown-items">
                    <a href="dashboard.php?page=user_settings" class="block px-3 py-2 text-sm rounded-lg <?= activeMenu('user_settings') ?>">User Management</a>
                    <a href="dashboard.php?page=system_config" class="block px-3 py-2 text-sm rounded-lg <?= activeMenu('system_config') ?>">System Configuration</a>
                    <a href="dashboard.php?page=notifications" class="block px-3 py-2 text-sm rounded-lg <?= activeMenu('notifications') ?>">Notification Settings</a>
                </div>
            </div>
        </nav>
    </div>
</aside>