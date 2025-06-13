<header class="bg-white shadow-sm z-10">
    <div class="flex items-center justify-between px-6 py-3">
        <div class="flex items-center">
            <button @click="toggleSidebar()" class="mr-4 text-gray-600 hover:text-gray-900 lg:hidden">
                <i class="fas fa-bars text-xl"></i>
            </button>

            <button @click="toggleSidebarCollapse()" class="hidden lg:block mr-4 text-gray-600 hover:text-gray-900">
                <i class="fas fa-bars text-xl"></i>
            </button>

            <h1 class="text-xl font-semibold text-gray-800">Dashboard Teknisi</h1>
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
                    <img src="../assets/images/settings.png" alt="Teknisi" class="h-8 w-8 rounded-full">
                    <span class="hidden md:inline text-sm font-medium">Teknisi</span>
                </button>
                <div x-show="open" @click.outside="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-20">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil Saya</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Pengaturan</a>
                    <hr class="border-gray-200 my-1">
                    <button onclick="confirmLogout()" class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Logout</button>
                </div>
            </div>
        </div>
    </div>
</header>