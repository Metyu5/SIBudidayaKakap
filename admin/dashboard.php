<!doctype html>
<html lang="id" x-data="dashboard()">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard - White Snapper Farming</title>
    <link rel="icon" href="assets/images/logoHeader.png" />


    <!-- Font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <!-- Tailwind -->
    <link href="../src/output.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <!-- Notyf (Notification) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>

        * {
            font-family: "Poppins", sans-serif;
        }

        [x-cloak] {
            display: none !important;
        }

        .sidebar {
            transition: transform 0.3s ease, width 0.3s ease;
        }

        .sidebar-collapsed {
            width: 80px;
        }

        .sidebar-collapsed .sidebar-item-text,
        .sidebar-collapsed .sidebar-header-text,
        .sidebar-collapsed .sidebar-dropdown-items {
            display: none;
        }

        .sidebar-collapsed .sidebar-item {
            justify-content: center;
            padding-left: 0;
            padding-right: 0;
        }

        .sidebar-collapsed .sidebar-header {
            justify-content: center;
            padding-left: 0;
            padding-right: 0;
        }

        .sidebar-collapsed .sidebar-dropdown-icon {
            display: none;
        }

        .main-content {
            transition: margin-left 0.3s ease;
        }
    </style>
</head>

<body class="bg-gray-50 font-sans antialiased" x-cloak>
    <?php session_start(); ?>

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar Backdrop (Mobile) -->
        <div x-show="isMobileSidebarOpen" @click="closeMobileSidebar()"
            class="fixed inset-0 z-20 bg-black bg-opacity-50 lg:hidden"></div>

        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 z-30 w-64 bg-gradient-to-b from-blue-800 to-blue-900 text-white sidebar"
            :class="{
                   'translate-x-0': isSidebarOpen,
                   '-translate-x-full': !isSidebarOpen,
                   'sidebar-collapsed': isSidebarCollapsed
               }">
        

            <div class="px-4 py-6 h-[calc(100vh-73px)]">
                <div class="mb-6 px-4 py-3 bg-blue-700 rounded-lg">
                    <div class="flex items-center">
                        <img src="https://ui-avatars.com/api/?name=Admin&background=random" alt="Admin" class="h-10 w-10 rounded-full">
                        <div class="ml-3 sidebar-item-text">
                            <p class="text-sm font-medium">Administrator</p>
                            <p class="text-xs text-blue-200">Master Data</p>
                        </div>
                    </div>
                </div>

                <nav class="space-y-1">
                    <!-- Dashboard -->
                    <a href="#" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg bg-blue-700 text-white sidebar-item">
                        <i class="fas fa-tachometer-alt mr-3 text-blue-300"></i>
                        <span class="sidebar-item-text">Dashboard</span>
                    </a>

                    <!-- Fish Monitoring Dropdown -->
                    <div x-data="{ open: !isSidebarCollapsed }">
                        <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 text-sm font-medium rounded-lg hover:bg-blue-700 text-white sidebar-item">
                            <div class="flex items-center">
                                <i class="fas fa-fish mr-3 text-blue-300"></i>
                                <span class="sidebar-item-text">Fish Monitoring</span>
                            </div>
                            <i class="fas fa-chevron-down text-xs transition-transform duration-200 sidebar-dropdown-icon"
                                :class="open ? 'transform rotate-180' : ''"></i>
                        </button>
                        <div x-show="open" x-collapse class="ml-8 mt-1 space-y-1 sidebar-dropdown-items">
                            <a href="#" class="block px-3 py-2 text-sm rounded-lg hover:bg-blue-700 text-blue-200">Growth Tracking</a>
                            <a href="#" class="block px-3 py-2 text-sm rounded-lg hover:bg-blue-700 text-blue-200">Health Status</a>
                            <a href="#" class="block px-3 py-2 text-sm rounded-lg hover:bg-blue-700 text-blue-200">Feeding Schedule</a>
                            <a href="#" class="block px-3 py-2 text-sm rounded-lg hover:bg-blue-700 text-blue-200">Stock Inventory</a>
                        </div>
                    </div>

                    <!-- Water Quality Dropdown -->
                    <div x-data="{ open: !isSidebarCollapsed }">
                        <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 text-sm font-medium rounded-lg hover:bg-blue-700 text-white sidebar-item">
                            <div class="flex items-center">
                                <i class="fas fa-tint mr-3 text-blue-300"></i>
                                <span class="sidebar-item-text">Water Quality</span>
                            </div>
                            <i class="fas fa-chevron-down text-xs transition-transform duration-200 sidebar-dropdown-icon"
                                :class="open ? 'transform rotate-180' : ''"></i>
                        </button>
                        <div x-show="open" x-collapse class="ml-8 mt-1 space-y-1 sidebar-dropdown-items">
                            <a href="#" class="block px-3 py-2 text-sm rounded-lg hover:bg-blue-700 text-blue-200">Temperature</a>
                            <a href="#" class="block px-3 py-2 text-sm rounded-lg hover:bg-blue-700 text-blue-200">pH Levels</a>
                            <a href="#" class="block px-3 py-2 text-sm rounded-lg hover:bg-blue-700 text-blue-200">Oxygen Levels</a>
                            <a href="#" class="block px-3 py-2 text-sm rounded-lg hover:bg-blue-700 text-blue-200">Salinity</a>
                        </div>
                    </div>

                    <!-- Seaweed Integration -->
                    <div x-data="{ open: !isSidebarCollapsed }">
                        <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 text-sm font-medium rounded-lg hover:bg-blue-700 text-white sidebar-item">
                            <div class="flex items-center">
                                <i class="fas fa-leaf mr-3 text-blue-300"></i>
                                <span class="sidebar-item-text">Seaweed Integration</span>
                            </div>
                            <i class="fas fa-chevron-down text-xs transition-transform duration-200 sidebar-dropdown-icon"
                                :class="open ? 'transform rotate-180' : ''"></i>
                        </button>
                        <div x-show="open" x-collapse class="ml-8 mt-1 space-y-1 sidebar-dropdown-items">
                            <a href="#" class="block px-3 py-2 text-sm rounded-lg hover:bg-blue-700 text-blue-200">Symbiotic Analysis</a>
                            <a href="#" class="block px-3 py-2 text-sm rounded-lg hover:bg-blue-700 text-blue-200">Growth Comparison</a>
                            <a href="#" class="block px-3 py-2 text-sm rounded-lg hover:bg-blue-700 text-blue-200">Nutrient Exchange</a>
                        </div>
                    </div>

                    <!-- Reports -->
                    <a href="#" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg hover:bg-blue-700 text-white sidebar-item">
                        <i class="fas fa-chart-bar mr-3 text-blue-300"></i>
                        <span class="sidebar-item-text">Reports & Analytics</span>
                    </a>

                    <!-- Settings -->
                    <div x-data="{ open: !isSidebarCollapsed }">
                        <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 text-sm font-medium rounded-lg hover:bg-blue-700 text-white sidebar-item">
                            <div class="flex items-center">
                                <i class="fas fa-cog mr-3 text-blue-300"></i>
                                <span class="sidebar-item-text">Settings</span>
                            </div>
                            <i class="fas fa-chevron-down text-xs transition-transform duration-200 sidebar-dropdown-icon"
                                :class="open ? 'transform rotate-180' : ''"></i>
                        </button>
                        <div x-show="open" x-collapse class="ml-8 mt-1 space-y-1 sidebar-dropdown-items">
                            <a href="#" class="block px-3 py-2 text-sm rounded-lg hover:bg-blue-700 text-blue-200">User Management</a>
                            <a href="#" class="block px-3 py-2 text-sm rounded-lg hover:bg-blue-700 text-blue-200">System Configuration</a>
                            <a href="#" class="block px-3 py-2 text-sm rounded-lg hover:bg-blue-700 text-blue-200">Notification Settings</a>
                        </div>
                    </div>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden main-content" :class="{
            'lg:ml-64': !isSidebarCollapsed && isSidebarOpen,
            'lg:ml-20': isSidebarCollapsed && isSidebarOpen
        }">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm z-10">
                <div class="flex items-center justify-between px-6 py-3">
                    <div class="flex items-center">
                        <button @click="toggleMobileSidebar()" class="mr-4 text-gray-600 hover:text-gray-900 lg:hidden">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <button @click="toggleSidebarCollapse()" class="hidden lg:block mr-4 text-gray-600 hover:text-gray-900">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <h1 class="text-xl font-semibold text-gray-800">Dashboard admin panel</h1>
                    </div>

                    <div class="flex items-center space-x-4">
                        <button class="p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-full">
                            <i class="fas fa-bell"></i>
                        </button>
                        <button class="p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-full">
                            <i class="fas fa-envelope"></i>
                        </button>
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-2">
                                <img src="https://ui-avatars.com/api/?name=Admin&background=random" alt="Admin" class="h-8 w-8 rounded-full">
                                <span class="hidden md:inline text-sm font-medium">Admin</span>
                            </button>
                            <div x-show="open" @click.outside="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-20">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                                <button onclick="confirmLogout()" class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto p-6 bg-gray-50">
                <!-- Page Header -->
                <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <h2 class="text-2xl font-bold text-gray-800">Dashboard Overview</h2>
                    <div class="flex flex-wrap gap-2">
                        <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 text-sm sm:text-base">
                            <i class="fas fa-plus mr-2"></i> Add Record
                        </button>
                        <button class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-200 text-sm sm:text-base">
                            <i class="fas fa-download mr-2"></i> Export
                        </button>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-blue-500">
                        <div class="flex justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Total Fish</p>
                                <p class="text-2xl font-bold text-gray-800">1,248</p>
                            </div>
                            <div class="h-12 w-12 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-fish text-blue-600"></i>
                            </div>
                        </div>
                        <p class="mt-2 text-xs text-green-600 font-medium">
                            <i class="fas fa-arrow-up mr-1"></i> 12.5% from last month
                        </p>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-green-500">
                        <div class="flex justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Avg. Growth Rate</p>
                                <p class="text-2xl font-bold text-gray-800">2.8 cm</p>
                            </div>
                            <div class="h-12 w-12 bg-green-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-chart-line text-green-600"></i>
                            </div>
                        </div>
                        <p class="mt-2 text-xs text-green-600 font-medium">
                            <i class="fas fa-arrow-up mr-1"></i> 8.3% improvement
                        </p>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-yellow-500">
                        <div class="flex justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Water Quality</p>
                                <p class="text-2xl font-bold text-gray-800">Excellent</p>
                            </div>
                            <div class="h-12 w-12 bg-yellow-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-tint text-yellow-600"></i>
                            </div>
                        </div>
                        <p class="mt-2 text-xs text-red-600 font-medium">
                            <i class="fas fa-exclamation-triangle mr-1"></i> pH needs adjustment
                        </p>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-purple-500">
                        <div class="flex justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Seaweed Yield</p>
                                <p class="text-2xl font-bold text-gray-800">342 kg</p>
                            </div>
                            <div class="h-12 w-12 bg-purple-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-leaf text-purple-600"></i>
                            </div>
                        </div>
                        <p class="mt-2 text-xs text-green-600 font-medium">
                            <i class="fas fa-arrow-up mr-1"></i> 15.2% from last cycle
                        </p>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <div class="bg-white p-6 rounded-xl shadow-sm">
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-2">
                            <h3 class="text-lg font-semibold text-gray-800">Fish Growth Trend</h3>
                            <select class="text-sm border border-gray-300 rounded px-3 py-1 bg-white">
                                <option>Last 7 Days</option>
                                <option>Last 30 Days</option>
                                <option selected>Last 90 Days</option>
                            </select>
                        </div>
                        <div class="h-64 bg-gray-50 rounded flex items-center justify-center">
                            <p class="text-gray-400">Growth Chart Visualization</p>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-sm">
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-2">
                            <h3 class="text-lg font-semibold text-gray-800">Water Quality Metrics</h3>
                            <select class="text-sm border border-gray-300 rounded px-3 py-1 bg-white">
                                <option>Temperature</option>
                                <option>pH Level</option>
                                <option selected>Oxygen</option>
                            </select>
                        </div>
                        <div class="h-64 bg-gray-50 rounded flex items-center justify-center">
                            <p class="text-gray-400">Water Quality Chart</p>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity & Tasks -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Recent Activities</h3>
                        <div class="space-y-4">
                            <div class="flex">
                                <div class="flex-shrink-0 mr-3">
                                    <div class="h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-fish text-blue-600"></i>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-800">New fish batch added</p>
                                    <p class="text-xs text-gray-500">300 juvenile white snappers added to Tank B</p>
                                    <p class="text-xs text-gray-400 mt-1">2 hours ago</p>
                                </div>
                            </div>

                            <div class="flex">
                                <div class="flex-shrink-0 mr-3">
                                    <div class="h-10 w-10 bg-yellow-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-tint text-yellow-600"></i>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-800">Water quality alert</p>
                                    <p class="text-xs text-gray-500">pH level in Tank C dropped to 6.8</p>
                                    <p class="text-xs text-gray-400 mt-1">5 hours ago</p>
                                </div>
                            </div>

                            <div class="flex">
                                <div class="flex-shrink-0 mr-3">
                                    <div class="h-10 w-10 bg-green-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-leaf text-green-600"></i>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-800">Seaweed harvest</p>
                                    <p class="text-xs text-gray-500">Harvested 45kg of Gracilaria from Section 3</p>
                                    <p class="text-xs text-gray-400 mt-1">1 day ago</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Upcoming Tasks</h3>
                        <div class="space-y-3">
                            <div class="flex items-start">
                                <input type="checkbox" class="mt-1 rounded text-blue-600" checked>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-800 line-through">Morning feeding</p>
                                    <p class="text-xs text-gray-500">Tanks A, B, and D</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <input type="checkbox" class="mt-1 rounded text-blue-600">
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-800">Water quality check</p>
                                    <p class="text-xs text-gray-500">All tanks - pH and temperature</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <input type="checkbox" class="mt-1 rounded text-blue-600">
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-800">Research data collection</p>
                                    <p class="text-xs text-gray-500">Measure seaweed growth rates</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <input type="checkbox" class="mt-1 rounded text-blue-600">
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-800">Equipment maintenance</p>
                                    <p class="text-xs text-gray-500">Clean filters and pumps</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Dashboard JavaScript -->
    <script>
        function dashboard() {
            return {
                isSidebarOpen: window.innerWidth >= 1024,
                isMobileSidebarOpen: false,
                isSidebarCollapsed: false,

                init() {
                    window.addEventListener('resize', () => {
                        this.isSidebarOpen = window.innerWidth >= 1024;
                        if (window.innerWidth >= 1024) {
                            this.isMobileSidebarOpen = false;
                        }
                    });
                },

                toggleMobileSidebar() {
                    this.isMobileSidebarOpen = !this.isMobileSidebarOpen;
                },

                closeMobileSidebar() {
                    this.isMobileSidebarOpen = false;
                },

                toggleSidebarCollapse() {
                    this.isSidebarCollapsed = !this.isSidebarCollapsed;
                    // Close mobile sidebar if collapsing on mobile
                    if (window.innerWidth < 1024) {
                        this.isMobileSidebarOpen = false;
                    }
                }
            }
        }

        function confirmLogout() {
            const notyf = new Notyf({
                duration: 2000,
                position: {
                    x: 'right',
                    y: 'bottom'
                }
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