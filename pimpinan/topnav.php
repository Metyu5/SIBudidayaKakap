<?php
// pimpinan/topnav.php
// Membutuhkan Alpine.js untuk fungsi toggle dan logout
?>

<nav class="bg-white p-4 shadow-md flex items-center justify-between z-20">
    <button @click="$data.toggleSidebar()" class="lg:hidden text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-md p-2">
        <i class="fas fa-bars text-xl"></i>
    </button>

    <div class="flex-1 text-left lg:ml-0 ml-4">
        <span class="text-gray-800 text-xl font-semibold">E-Tambak Pimpinan</span>
    </div>

    <div x-data="{ dropdownOpen: false }" class="relative">
        <button @click="dropdownOpen = !dropdownOpen" class="flex items-center focus:outline-none">
            <span class="mr-2 text-gray-700 hidden md:block">Selamat datang, Pimpinan!</span>
            <img class="h-8 w-8 rounded-full object-cover" src="../assets/img/user.png" alt="Avatar">
            <i class="fas fa-chevron-down text-gray-500 ml-2"></i>
        </button>

        <div x-show="dropdownOpen" @click.away="dropdownOpen = false"
            x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95"
            class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg py-1 z-50">
            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profil</a>
            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Pengaturan</a>
            <div class="border-t border-gray-200 my-1"></div>
            <a href="../logout.php" @click.prevent="$data.confirmLogout()" class="block px-4 py-2 text-red-600 hover:bg-red-100">
                <i class="fas fa-sign-out-alt mr-2"></i> Logout
            </a>
        </div>
    </div>
</nav>