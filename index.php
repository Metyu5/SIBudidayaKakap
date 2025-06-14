<!DOCTYPE html>
<html lang="id" class="dark">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Sistem Informasi Tambak Kakap Putih untuk budidaya laut penuh - Panduan lengkap budidaya, monitoring, dan analisis ekonomi">
    <title> Sistem Informasi Tambak Kakap Putih - SI Kakap | Budidaya Laut Penuh</title>
    <link rel="icon" href="assets/images/logoHeader.png" />


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <!-- Font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- AOS Animation -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            scroll-behavior: smooth;
        }

        .hero-gradient {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .water-wave {
            position: relative;
            overflow: hidden;
        }

        .water-wave::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 20px;
            background: url('data:image/svg+xml;utf8,<svg viewBox="0 0 1200 120" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none"><path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" fill="%23f3f4f6" opacity=".25"/><path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" fill="%23f3f4f6" opacity=".5"/><path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" fill="%23f3f4f6"/></svg>');
            background-size: cover;
            z-index: 10;
        }

        .dark .water-wave::after {
            background: url('data:image/svg+xml;utf8,<svg viewBox="0 0 1200 120" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none"><path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" fill="%231f2937" opacity=".25"/><path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" fill="%231f2937" opacity=".5"/><path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" fill="%231f2937"/></svg>');
        }

        .fade-in {
            animation: fadeIn 1s ease-in forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(40px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .nav-link {
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 0;
            background-color: #3b82f6;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100">
    <!-- Navigation -->
    <nav class="bg-white dark:bg-gray-800 shadow-md sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <img src="assets/images/bulat.png"
                        alt="LogoHeader"
                        class="h-10 mr-2">
                    <span class="text-xl font-bold text-blue-600 dark:text-blue-400 flex items-center">
                        E-TAMBAK
                    </span>
                </div>
                <div class="hidden md:flex space-x-8">
                    <a href="#home" class="nav-link text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">Beranda</a>
                    <a href="#about" class="nav-link text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">Tentang</a>
                    <a href="#culture" class="nav-link text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">Budidaya</a>
                    <a href="#monitoring" class="nav-link text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">Monitoring</a>
                    <a href="#calculator" class="nav-link text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">Kalkulator</a>
                </div>
                <button id="theme-toggle" class="p-2 rounded-full focus:outline-none">
                    <i class="fas fa-moon text-gray-700 dark:text-yellow-300"></i>
                </button>
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="p-2 rounded-md focus:outline-none">
                        <i class="fas fa-bars text-gray-700 dark:text-gray-300"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- Mobile menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white dark:bg-gray-800 pb-4 px-4">
            <a href="#home" class="block py-2 text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">Beranda</a>
            <a href="#about" class="block py-2 text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">Tentang</a>
            <a href="#culture" class="block py-2 text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">Budidaya</a>
            <a href="#monitoring" class="block py-2 text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">Monitoring</a>
            <a href="#calculator" class="block py-2 text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">Kalkulator</a>
        </div>
    </nav>

    <div x-data="{ open: false }">
        <!-- Hero Section -->
        <section id="home" class="hero-gradient text-white water-wave">
            <div class="max-w-6xl mx-auto px-4 py-20 md:py-32">
                <div class="flex flex-col md:flex-row items-center">
                    <div class="md:w-1/2 mb-10 md:mb-0 fade-in">
                        <h1 class="text-4xl md:text-5xl font-bold mb-4">Sistem Informasi Tambak Kakap Putih Di Lokas Riset Budidaya Ikan Laut</h1>
                        <p class="text-lg md:text-xl mb-6 opacity-90">Optimalisasi budidaya kakap putih (<em>Lates calcarifer</em>) dalam sistem budidaya laut penuh</p>
                        <div class="flex space-x-4">
                            <button
                                @click="open = true"
                                class="bg-white text-blue-600 px-6 py-3 rounded-lg font-medium hover:bg-gray-100 transition duration-300 shadow-lg">
                                Kelola Budidaya <i class="fas fa-arrow-right ml-2"></i>
                            </button>

                            <a href="#calculator" class="border border-white text-white px-6 py-3 rounded-lg font-medium hover:bg-white hover:text-blue-600 transition duration-300">
                                Kalkulator <i class="fas fa-calculator ml-2"></i>
                            </a>
                        </div>
                    </div>
                    <div class="md:w-1/2 flex justify-center fade-in-up">
                        <img src="assets/images/lokasi.png"
                            alt="Kakap Putih"
                            class="rounded-xl shadow-2xl max-w-md w-full border-4 border-white">
                    </div>
                </div>
            </div>
        </section>

        <!-- Modal -->
        <div
            x-show="open"
            x-transition
            x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div
                @click.away="open = false"
                class="bg-white text-black rounded-xl p-6 w-full max-w-lg shadow-lg relative">
                <!-- Tombol Close -->
                <button
                    @click="open = false"
                    class="absolute top-2 right-3 text-gray-500 hover:text-black text-xl font-bold">
                    &times;
                </button>

                <!-- Judul Modal -->
                <h2 class="text-2xl font-semibold text-center text-blue-600 mb-6">Log-in</h2>

                <!-- Form Login -->
                <form action="auth/proses_login.php" method="POST" class="space-y-5">
                    <!-- Email -->
                    <div class="relative">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input type="email" id="email" name="email" required
                                placeholder="contoh@email.com"
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        </div>
                    </div>

                    <!-- Password dengan toggle -->
                    <div x-data="{ show: false }" class="relative">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input :type="show ? 'text' : 'password'" id="password" name="password" required
                                placeholder="Masukkan password"
                                class="w-full pl-10 pr-10 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                            <button type="button" @click="show = !show"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-gray-700 focus:outline-none">
                                <i :class="show ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Konfirmasi Password dengan toggle -->
                    <div x-data="{ show: false }" class="relative">
                        <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="fas fa-check-circle"></i>
                            </span>
                            <input :type="show ? 'text' : 'password'" id="confirm_password" name="confirm_password" required
                                placeholder="Ulangi password"
                                class="w-full pl-10 pr-10 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                            <button type="button" @click="show = !show"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-gray-700 focus:outline-none">
                                <i :class="show ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                            </button>
                        </div>
                    </div>
                    <!-- Kategori Dropdown -->
                    <div class="relative">
                        <label for="kategori" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="fas fa-users-cog"></i>
                            </span>
                            <select id="kategori" name="kategori" required
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="" disabled selected>Pilih kategori</option>
                                <option value="administrator">Administrator</option>
                                <option value="pimpinan">Pimpinan</option>
                                <option value="teknisi">Teknisi</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300">
                            <i class="fas fa-sign-in-alt mr-2"></i>Login
                        </button>
                    </div>
                </form>
                <?php if (isset($_GET['error'])): ?>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                        const showError = () => {
                            <?php if ($_GET['error'] == 'login_gagal'): ?>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Login Gagal',
                                    text: 'Email atau password salah!'
                                });
                            <?php elseif ($_GET['error'] == 'kategori_salah'): ?>
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Kategori Salah',
                                    text: 'Kategori yang Anda pilih tidak sesuai!'
                                });
                            <?php elseif ($_GET['error'] == 'kategori_tidak_dikenal'): ?>
                                Swal.fire({
                                    icon: 'question',
                                    title: 'Kategori Tidak Dikenal',
                                    text: 'Mohon hubungi admin sistem.'
                                });
                            <?php endif; ?>
                        };

                        // Tampilkan SweetAlert lalu hilangkan ?error=... dari URL
                        showError();
                        if (window.history.replaceState) {
                            const cleanUrl = window.location.origin + window.location.pathname;
                            window.history.replaceState(null, null, cleanUrl);
                        }
                    </script>
                <?php endif; ?>



            </div>
        </div>
    </div>


    <!-- About Section -->
    <section id="about" class="py-16 bg-white dark:bg-gray-800">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-blue-600 dark:text-blue-400">Tentang Kakap Putih</h2>

            <div class="grid md:grid-cols-2 gap-10 items-center mb-16">
                <div class="fade-in-up">
                    <h3 class="text-2xl font-semibold mb-4">🐟 Profil Kakap Putih (<em>Lates calcarifer</em>)</h3>
                    <p class="text-gray-700 dark:text-gray-300 mb-4">
                        Kakap putih adalah ikan ekonomis penting yang hidup di perairan tropis dan subtropis Asia-Pasifik. Ikan ini memiliki sifat eurihalin (dapat hidup di berbagai salinitas) dan termasuk katadromous (hidup di laut tetapi berkembang biak di air tawar).
                    </p>
                    <p class="text-gray-700 dark:text-gray-300">
                        Dalam budidaya laut penuh, kakap putih menunjukkan pertumbuhan cepat dengan konversi pakan yang efisien, mencapai ukuran pasar (500-700g) dalam 6-8 bulan dengan survival rate 70-85%.
                    </p>
                </div>
                <div class="bg-gray-100 dark:bg-gray-700 p-6 rounded-xl shadow-md fade-in-up">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-blue-50 dark:bg-blue-900/30 p-4 rounded-lg">
                            <h4 class="font-semibold text-blue-600 dark:text-blue-300 mb-2">Habitat Alami</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Muara sungai, perairan pantai, terumbu karang</p>
                        </div>
                        <div class="bg-green-50 dark:bg-green-900/30 p-4 rounded-lg">
                            <h4 class="font-semibold text-green-600 dark:text-green-300 mb-2">Ukuran Dewasa</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-300">0.6-1.8 m, 2-60 kg (tergantung habitat)</p>
                        </div>
                        <div class="bg-yellow-50 dark:bg-yellow-900/30 p-4 rounded-lg">
                            <h4 class="font-semibold text-yellow-600 dark:text-yellow-300 mb-2">Suhu Optimal</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-300">26-32°C</p>
                        </div>
                        <div class="bg-purple-50 dark:bg-purple-900/30 p-4 rounded-lg">
                            <h4 class="font-semibold text-purple-600 dark:text-purple-300 mb-2">Salinitas</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-300">0-40 ppt (optimal 15-30 ppt)</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid md:grid-cols-3 gap-6 mt-10">
                <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-xl shadow-md hover:shadow-lg transition duration-300 card-hover">
                    <div class="text-blue-500 dark:text-blue-400 text-3xl mb-4">
                        <i class="fas fa-water"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Adaptabilitas Tinggi</h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        Kakap putih dapat beradaptasi dengan berbagai kondisi salinitas, membuatnya ideal untuk budidaya di keramba jaring apung (KJA) laut lepas.
                    </p>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-xl shadow-md hover:shadow-lg transition duration-300 card-hover">
                    <div class="text-green-500 dark:text-green-400 text-3xl mb-4">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Pertumbuhan Cepat</h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        Dengan pakan berkualitas, kakap putih dapat mencapai ukuran pasar dalam 6-8 bulan dengan FCR (Feed Conversion Ratio) 1.5-1.8.
                    </p>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-xl shadow-md hover:shadow-lg transition duration-300 card-hover">
                    <div class="text-purple-500 dark:text-purple-400 text-3xl mb-4">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Nilai Ekonomi Tinggi</h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        Permintaan pasar domestik dan internasional stabil dengan harga jual premium, terutama untuk ukuran 500g-1kg.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Culture Section -->
    <section id="culture" class="py-16 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-blue-600 dark:text-blue-400">Teknik Budidaya Laut Penuh</h2>

            <div class="mb-16">
                <h3 class="text-2xl font-semibold mb-6 text-center">📌 Tahapan Budidaya Kakap Putih di KJA</h3>

                <div class="relative">
                    <!-- Timeline line -->
                    <div class="hidden md:block absolute left-1/2 h-full w-1 bg-blue-200 dark:bg-blue-900 transform -translate-x-1/2"></div>

                    <!-- Timeline items -->
                    <div class="space-y-12">
                        <!-- Item 1 -->
                        <div class="relative flex flex-col md:flex-row items-center">
                            <div class="md:w-1/2 md:pr-12 mb-6 md:mb-0 md:text-right">
                                <h4 class="text-xl font-semibold mb-2">Persiapan Sarana Budidaya</h4>
                                <p class="text-gray-600 dark:text-gray-300">
                                    Pemilihan lokasi KJA dengan parameter: kedalaman >10m, arus 20-40cm/detik, jauh dari jalur pelayaran dan daerah penangkapan.
                                </p>
                            </div>
                            <div class="flex justify-center md:justify-start md:w-1/2 md:pl-12">
                                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md w-full max-w-md">
                                    <div class="flex items-center mb-3">
                                        <div class="bg-blue-100 dark:bg-blue-900/50 p-3 rounded-full mr-4">
                                            <i class="fas fa-map-marked-alt text-blue-500 dark:text-blue-400 text-xl"></i>
                                        </div>
                                        <h5 class="font-semibold">Parameter Lokasi Ideal</h5>
                                    </div>
                                    <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-300">
                                        <li class="flex items-start">
                                            <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                                            <span>Kedalaman air: 10-25 meter</span>
                                        </li>
                                        <li class="flex items-start">
                                            <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                                            <span>Jarak antar KJA minimal 50 meter</span>
                                        </li>
                                        <li class="flex items-start">
                                            <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                                            <span>Jauh dari muara sungai (minimal 1 km)</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Item 2 -->
                        <div class="relative flex flex-col md:flex-row items-center">
                            <div class="md:w-1/2 md:pr-12 mb-6 md:mb-0 order-2 md:order-1 md:text-left">
                                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md w-full max-w-md">
                                    <div class="flex items-center mb-3">
                                        <div class="bg-green-100 dark:bg-green-900/50 p-3 rounded-full mr-4">
                                            <i class="fas fa-fish text-green-500 dark:text-green-400 text-xl"></i>
                                        </div>
                                        <h5 class="font-semibold">Standar Benih Unggul</h5>
                                    </div>
                                    <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-300">
                                        <li class="flex items-start">
                                            <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                                            <span>Ukuran 5-10 cm (3-5 gram)</span>
                                        </li>
                                        <li class="flex items-start">
                                            <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                                            <span>Aktif bergerak dan responsif</span>
                                        </li>
                                        <li class="flex items-start">
                                            <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                                            <span>Tubuh simetris, tidak cacat</span>
                                        </li>
                                        <li class="flex items-start">
                                            <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                                            <span>Bebas penyakit (cek di bawah mikroskop)</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="md:w-1/2 md:pl-12 order-1 md:order-2 mb-6 md:mb-0">
                                <h4 class="text-xl font-semibold mb-2">Seleksi dan Penebaran Benih</h4>
                                <p class="text-gray-600 dark:text-gray-300">
                                    Benih kakap putih hasil hatchery dengan ukuran seragam (5-10 cm) ditebar dengan kepadatan 30-50 ekor/m³ setelah melalui proses aklimatisasi salinitas bertahap.
                                </p>
                            </div>
                        </div>

                        <!-- Item 3 -->
                        <div class="relative flex flex-col md:flex-row items-center">
                            <div class="md:w-1/2 md:pr-12 mb-6 md:mb-0 md:text-right">
                                <h4 class="text-xl font-semibold mb-2">Manajemen Pakan</h4>
                                <p class="text-gray-600 dark:text-gray-300">
                                    Pemberian pakan pelet komersial (protein 40-45%) dengan frekuensi 2-3 kali sehari. Dosis pakan disesuaikan dengan berat biomassa (3-5% per hari) dan kondisi lingkungan.
                                </p>
                            </div>
                            <div class="flex justify-center md:justify-start md:w-1/2 md:pl-12">
                                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md w-full max-w-md">
                                    <div class="flex items-center mb-3">
                                        <div class="bg-yellow-100 dark:bg-yellow-900/50 p-3 rounded-full mr-4">
                                            <i class="fas fa-utensils text-yellow-500 dark:text-yellow-400 text-xl"></i>
                                        </div>
                                        <h5 class="font-semibold">Jadwal Pemberian Pakan</h5>
                                    </div>
                                    <div class="grid grid-cols-3 gap-2 text-center text-sm">
                                        <div class="bg-blue-50 dark:bg-blue-900/30 p-2 rounded">
                                            <div class="font-medium">Pagi</div>
                                            <div class="text-gray-600 dark:text-gray-300">07.00-08.00</div>
                                            <div class="text-green-600 dark:text-green-400 font-bold">30%</div>
                                        </div>
                                        <div class="bg-blue-50 dark:bg-blue-900/30 p-2 rounded">
                                            <div class="font-medium">Siang</div>
                                            <div class="text-gray-600 dark:text-gray-300">12.00-13.00</div>
                                            <div class="text-green-600 dark:text-green-400 font-bold">20%</div>
                                        </div>
                                        <div class="bg-blue-50 dark:bg-blue-900/30 p-2 rounded">
                                            <div class="font-medium">Sore</div>
                                            <div class="text-gray-600 dark:text-gray-300">16.00-17.00</div>
                                            <div class="text-green-600 dark:text-green-400 font-bold">50%</div>
                                        </div>
                                    </div>
                                    <div class="mt-4 text-xs text-gray-500 dark:text-gray-400">
                                        *Persentase dapat berubah sesuai kondisi ikan dan lingkungan
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Item 4 -->
                        <div class="relative flex flex-col md:flex-row items-center">
                            <div class="md:w-1/2 md:pr-12 mb-6 md:mb-0 order-2 md:order-1 md:text-left">
                                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md w-full max-w-md">
                                    <div class="flex items-center mb-3">
                                        <div class="bg-red-100 dark:bg-red-900/50 p-3 rounded-full mr-4">
                                            <i class="fas fa-virus text-red-500 dark:text-red-400 text-xl"></i>
                                        </div>
                                        <h5 class="font-semibold">Penyakit Umum</h5>
                                    </div>
                                    <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-300">
                                        <li class="flex items-start">
                                            <i class="fas fa-bacteria text-red-500 mr-2 mt-1"></i>
                                            <span><strong>VNNV:</strong> Virus Nervous Necrosis - Gejala: berenang memutar</span>
                                        </li>
                                        <li class="flex items-start">
                                            <i class="fas fa-bacteria text-red-500 mr-2 mt-1"></i>
                                            <span><strong>Streptococcosis:</strong> Bakterial - Gejala: luka di tubuh</span>
                                        </li>
                                        <li class="flex items-start">
                                            <i class="fas fa-bacteria text-red-500 mr-2 mt-1"></i>
                                            <span><strong>Cryptocaryon:</strong> Parasit - Gejala: bintik putih</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="md:w-1/2 md:pl-12 order-1 md:order-2 mb-6 md:mb-0">
                                <h4 class="text-xl font-semibold mb-2">Manajemen Kesehatan</h4>
                                <p class="text-gray-600 dark:text-gray-300">
                                    Monitoring rutin terhadap gejala penyakit, pemberian vaksin (jika diperlukan), dan karantina ikan sakit. Penggunaan probiotik untuk meningkatkan kesehatan pencernaan dan kualitas air.
                                </p>
                            </div>
                        </div>

                        <!-- Item 5 -->
                        <div class="relative flex flex-col md:flex-row items-center">
                            <div class="md:w-1/2 md:pr-12 mb-6 md:mb-0 md:text-right">
                                <h4 class="text-xl font-semibold mb-2">Panen dan Pasca Panen</h4>
                                <p class="text-gray-600 dark:text-gray-300">
                                    Panen dilakukan setelah 6-8 bulan (ukuran 500-700g) dengan metode partial harvest untuk mempertahankan kualitas. Ikan dipuasakan 24 jam sebelum panen dan ditangani dengan hati-hati untuk mengurangi stres.
                                </p>
                            </div>
                            <div class="flex justify-center md:justify-start md:w-1/2 md:pl-12">
                                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md w-full max-w-md">
                                    <div class="flex items-center mb-3">
                                        <div class="bg-purple-100 dark:bg-purple-900/50 p-3 rounded-full mr-4">
                                            <i class="fas fa-balance-scale text-purple-500 dark:text-purple-400 text-xl"></i>
                                        </div>
                                        <h5 class="font-semibold">Standar Kualitas Panen</h5>
                                    </div>
                                    <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-300">
                                        <li class="flex items-start">
                                            <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                                            <span>Ukuran seragam (CV < 15%)</span>
                                        </li>
                                        <li class="flex items-start">
                                            <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                                            <span>Warna tubuh cerah dan segar</span>
                                        </li>
                                        <li class="flex items-start">
                                            <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                                            <span>Bebas penyakit dan cacat fisik</span>
                                        </li>
                                        <li class="flex items-start">
                                            <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                                            <span>Kadar lemak daging optimal (6-8%)</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-8 mt-12">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md">
                    <h3 class="text-xl font-semibold mb-4 flex items-center">
                        <i class="fas fa-tint text-blue-500 mr-3"></i> Manajemen Kualitas Air
                    </h3>
                    <div class="space-y-4">
                        <div>
                            <h4 class="font-medium mb-2">Parameter Kritis</h4>
                            <div class="grid grid-cols-3 gap-2 text-sm">
                                <div class="bg-blue-50 dark:bg-blue-900/30 p-2 rounded text-center">
                                    <div>Oksigen</div>
                                    <div class="font-bold">>5 ppm</div>
                                </div>
                                <div class="bg-green-50 dark:bg-green-900/30 p-2 rounded text-center">
                                    <div>pH</div>
                                    <div class="font-bold">7.5-8.5</div>
                                </div>
                                <div class="bg-yellow-50 dark:bg-yellow-900/30 p-2 rounded text-center">
                                    <div>Amonia</div>
                                    <div class="font-bold">
                                        <0.1 ppm</div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h4 class="font-medium mb-2">Frekuensi Pengecekan</h4>
                                <ul class="text-sm space-y-2 text-gray-600 dark:text-gray-300">
                                    <li class="flex items-center">
                                        <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                        <span>Harian: Suhu, DO, pH (pagi dan sore)</span>
                                    </li>
                                    <li class="flex items-center">
                                        <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                        <span>Mingguan: Amonia, Nitrit, Alkalinitas</span>
                                    </li>
                                    <li class="flex items-center">
                                        <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                        <span>Bulanan: Logam berat (jika dekat industri)</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md">
                        <h3 class="text-xl font-semibold mb-4 flex items-center">
                            <i class="fas fa-chart-pie text-green-500 mr-3"></i> Analisis Biaya Produksi
                        </h3>
                        <div class="space-y-4">
                            <div>
                                <h4 class="font-medium mb-2">Komponen Biaya (per siklus 8 bulan)</h4>
                                <div class="text-sm space-y-2 text-gray-600 dark:text-gray-300">
                                    <div class="flex justify-between">
                                        <span>Benih (1000 ekor)</span>
                                        <span class="font-medium">Rp 3.000.000</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Pakan (1.8 FCR)</span>
                                        <span class="font-medium">Rp 12.000.000</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Tenaga Kerja</span>
                                        <span class="font-medium">Rp 4.000.000</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Pemeliharaan KJA</span>
                                        <span class="font-medium">Rp 2.000.000</span>
                                    </div>
                                    <div class="border-t border-gray-200 dark:border-gray-700 pt-2 mt-2 font-semibold flex justify-between">
                                        <span>Total Biaya</span>
                                        <span>Rp 21.000.000</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h4 class="font-medium mb-2">Estimasi Pendapatan</h4>
                                <div class="text-sm text-gray-600 dark:text-gray-300">
                                    <div class="flex justify-between">
                                        <span>Produksi (700kg @Rp 60.000)</span>
                                        <span class="font-medium">Rp 42.000.000</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Keuntungan Bersih</span>
                                        <span class="font-medium text-green-600 dark:text-green-400">Rp 21.000.000</span>
                                    </div>
                                    <div class="text-xs mt-2 text-gray-500 dark:text-gray-400">
                                        *Perhitungan untuk 1 unit KJA ukuran 5x5x3m
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <!-- Monitoring Section -->
    <section id="monitoring" class="py-16 bg-white dark:bg-gray-800">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-blue-600 dark:text-blue-400">Sistem Monitoring Digital</h2>

            <div class="grid md:grid-cols-2 gap-10 items-center mb-16">
                <div class="fade-in-up">
                    <h3 class="text-2xl font-semibold mb-4">📊 Real-time Water Quality Monitoring</h3>
                    <p class="text-gray-700 dark:text-gray-300 mb-6">
                        Sistem sensor IoT kami memantau parameter kualitas air secara real-time dan mengirimkan notifikasi jika terjadi penyimpangan dari nilai optimal. Data dikumpulkan setiap 15 menit dan dapat diakses melalui dashboard online.
                    </p>
                    <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg mb-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-medium">Oksigen Terlarut</span>
                            <span class="font-bold text-blue-600 dark:text-blue-400">6.2 mg/L</span>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-600 rounded-full h-2.5">
                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: 82%"></div>
                        </div>
                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1 flex justify-between">
                            <span>Rendah</span>
                            <span>Optimal</span>
                            <span>Tinggi</span>
                        </div>
                    </div>
                    <a href="#" class="inline-flex items-center text-blue-600 dark:text-blue-400 hover:underline">
                        Lihat Dashboard Contoh
                        <i class="fas fa-external-link-alt ml-2"></i>
                    </a>
                </div>
                <div class="bg-gray-100 dark:bg-gray-700 p-6 rounded-xl shadow-md fade-in-up">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white dark:bg-gray-600 p-4 rounded-lg text-center">
                            <div class="text-3xl font-bold text-blue-600 dark:text-blue-300 mb-2">26°C</div>
                            <div class="text-sm text-gray-600 dark:text-gray-300">Suhu Air</div>
                        </div>
                        <div class="bg-white dark:bg-gray-600 p-4 rounded-lg text-center">
                            <div class="text-3xl font-bold text-green-600 dark:text-green-300 mb-2">7.8</div>
                            <div class="text-sm text-gray-600 dark:text-gray-300">pH</div>
                        </div>
                        <div class="bg-white dark:bg-gray-600 p-4 rounded-lg text-center">
                            <div class="text-3xl font-bold text-purple-600 dark:text-purple-300 mb-2">28 ppt</div>
                            <div class="text-sm text-gray-600 dark:text-gray-300">Salinitas</div>
                        </div>
                        <div class="bg-white dark:bg-gray-600 p-4 rounded-lg text-center">
                            <div class="text-3xl font-bold text-yellow-600 dark:text-yellow-300 mb-2">0.05</div>
                            <div class="text-sm text-gray-600 dark:text-gray-300">Amonia (ppm)</div>
                        </div>
                    </div>
                    <div class="mt-6 p-4 bg-blue-50 dark:bg-blue-900/30 rounded-lg">
                        <div class="flex items-start">
                            <i class="fas fa-info-circle text-blue-500 dark:text-blue-400 mt-1 mr-3"></i>
                            <div class="text-sm text-gray-700 dark:text-gray-300">
                                <strong>Status:</strong> Semua parameter dalam kondisi optimal untuk pertumbuhan kakap putih.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid md:grid-cols-3 gap-6 mt-10">
                <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-xl shadow-md hover:shadow-lg transition duration-300 card-hover">
                    <div class="text-blue-500 dark:text-blue-400 text-3xl mb-4">
                        <i class="fas fa-bell"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Alert System</h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        Notifikasi otomatis via SMS/Email ketika parameter air melebihi threshold yang ditentukan, memungkinkan tindakan cepat.
                    </p>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-xl shadow-md hover:shadow-lg transition duration-300 card-hover">
                    <div class="text-green-500 dark:text-green-400 text-3xl mb-4">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Data Historis</h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        Penyimpanan data jangka panjang untuk analisis tren dan pengambilan keputusan berbasis data.
                    </p>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-xl shadow-md hover:shadow-lg transition duration-300 card-hover">
                    <div class="text-purple-500 dark:text-purple-400 text-3xl mb-4">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Mobile Access</h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        Akses data monitoring dari smartphone melalui aplikasi khusus, memudahkan pengawasan dari mana saja.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Calculator Section -->
    <section id="calculator" class="py-16 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-blue-600 dark:text-blue-400">Kalkulator Budidaya</h2>

            <div class="grid md:grid-cols-2 gap-10">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md fade-in-up">
                    <h3 class="text-xl font-semibold mb-4 flex items-center">
                        <i class="fas fa-calculator text-green-500 mr-3"></i> Kalkulator Biaya Produksi
                    </h3>
                    <form id="cost-calculator" class="space-y-4">
                        <div>
                            <label for="pond-size" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Luas Tambak (m²)</label>
                            <input type="number" id="pond-size" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700" value="100" min="10">
                        </div>
                        <div>
                            <label for="fish-density" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Kepadatan Ikan (ekor/m²)</label>
                            <input type="number" id="fish-density" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700" value="30" min="1">
                        </div>
                        <div>
                            <label for="seed-price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Harga Benih per Ekor (Rp)</label>
                            <input type="number" id="seed-price" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700" value="3000" min="100">
                        </div>
                        <div>
                            <label for="fcr" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">FCR (Feed Conversion Ratio)</label>
                            <input type="number" id="fcr" step="0.1" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700" value="1.8" min="1">
                        </div>
                        <div>
                            <label for="feed-price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Harga Pakan per Kg (Rp)</label>
                            <input type="number" id="feed-price" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700" value="12000" min="1000">
                        </div>
                        <div>
                            <label for="culture-period" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Masa Budidaya (bulan)</label>
                            <input type="number" id="culture-period" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700" value="6" min="1">
                        </div>
                        <button type="button" onclick="calculateCost()" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-300">
                            Hitung Biaya
                        </button>
                    </form>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md fade-in-up">
                    <h3 class="text-xl font-semibold mb-4 flex items-center">
                        <i class="fas fa-chart-bar text-blue-500 mr-3"></i> Hasil Perhitungan
                    </h3>
                    <div id="calculation-result" class="space-y-4">
                        <div class="text-center py-10 text-gray-500 dark:text-gray-400">
                            <i class="fas fa-calculator text-4xl mb-3"></i>
                            <p>Masukkan parameter budidaya untuk melihat perhitungan biaya dan potensi keuntungan</p>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h4 class="font-semibold mb-3">Estimasi Harga Jual</h4>
                        <div class="grid grid-cols-3 gap-2 text-sm">
                            <div class="bg-blue-50 dark:bg-blue-900/30 p-2 rounded text-center">
                                <div>500g</div>
                                <div class="font-bold">Rp 55.000</div>
                            </div>
                            <div class="bg-green-50 dark:bg-green-900/30 p-2 rounded text-center">
                                <div>700g</div>
                                <div class="font-bold">Rp 65.000</div>
                            </div>
                            <div class="bg-purple-50 dark:bg-purple-900/30 p-2 rounded text-center">
                                <div>1kg</div>
                                <div class="font-bold">Rp 80.000</div>
                            </div>
                        </div>
                        <div class="text-xs mt-2 text-gray-500 dark:text-gray-400">
                            *Harga per kg berdasarkan ukuran ikan (Januari 2025)
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-16">
                <h3 class="text-2xl font-semibold mb-6 text-center">📈 Grafik Pertumbuhan Kakap Putih</h3>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md">
                    <div class="h-64 flex items-center justify-center">
                        <canvas id="growthChart"></canvas>
                    </div>
                    <div class="mt-4 text-sm text-gray-600 dark:text-gray-300 text-center">
                        Grafik menunjukkan estimasi pertumbuhan kakap putih dalam budidaya laut dengan pakan berkualitas (protein 42%)
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-16 bg-white dark:bg-gray-800">
        <div class="max-w-3xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-blue-600 dark:text-blue-400">Pertanyaan Umum</h2>

            <div class="space-y-4">
                <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
                    <button class="faq-question w-full flex justify-between items-center p-4 text-left font-medium hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-200">
                        <span>Berapa lama waktu yang dibutuhkan untuk budidaya kakap putih sampai panen?</span>
                        <i class="fas fa-chevron-down transition-transform duration-200"></i>
                    </button>
                    <div class="faq-answer hidden p-4 border-t border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300">
                        <p>Waktu budidaya kakap putih hingga siap panen bervariasi tergantung pada beberapa faktor:</p>
                        <ul class="list-disc list-inside mt-2 space-y-1">
                            <li>Ukuran awal benih: 5-10 cm (3-5 bulan untuk pembesaran)</li>
                            <li>Suhu air: Optimal 28-30°C mempercepat metabolisme</li>
                            <li>Kualitas pakan: Protein 40-45% dengan FCR 1.5-1.8</li>
                        </ul>
                        <p class="mt-2">Rata-rata waktu yang dibutuhkan untuk mencapai ukuran pasar (500-700g) adalah 6-8 bulan di KJA laut.</p>
                    </div>
                </div>

                <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
                    <button class="faq-question w-full flex justify-between items-center p-4 text-left font-medium hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-200">
                        <span>Bagaimana cara mengatasi serangan penyakit pada kakap putih?</span>
                        <i class="fas fa-chevron-down transition-transform duration-200"></i>
                    </button>
                    <div class="faq-answer hidden p-4 border-t border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300">
                        <p>Beberapa strategi pencegahan dan penanganan penyakit:</p>
                        <ol class="list-decimal list-inside mt-2 space-y-2">
                            <li><strong>Pencegahan:</strong>
                                <ul class="list-disc list-inside ml-4">
                                    <li>Pengelolaan kualitas air yang baik</li>
                                    <li>Pemberian pakan berkualitas dengan vitamin C</li>
                                    <li>Kepadatan tebar tidak berlebihan</li>
                                </ul>
                            </li>
                            <li><strong>Pengobatan:</strong>
                                <ul class="list-disc list-inside ml-4">
                                    <li>Untuk penyakit bakteri: Antibiotik dengan resep dokter hewan</li>
                                    <li>Untuk parasit: Perendaman air tawar atau formalin</li>
                                    <li>Untuk virus: Tidak ada obat, fokus pada pencegahan</li>
                                </ul>
                            </li>
                        </ol>
                        <p class="mt-2">Selalu konsultasikan dengan ahli penyakit ikan sebelum melakukan pengobatan.</p>
                    </div>
                </div>

                <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
                    <button class="faq-question w-full flex justify-between items-center p-4 text-left font-medium hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-200">
                        <span>Apakah budidaya kakap putih cocok untuk pemula?</span>
                        <i class="fas fa-chevron-down transition-transform duration-200"></i>
                    </button>
                    <div class="faq-answer hidden p-4 border-t border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300">
                        <p>Budidaya kakap putih membutuhkan pengetahuan dan pengalaman tertentu, namun pemula bisa memulai dengan:</p>
                        <ul class="list-disc list-inside mt-2 space-y-1">
                            <li>Mulai dengan skala kecil (1-2 unit KJA)</li>
                            <li>Bekerja sama dengan pembudidaya berpengalaman</li>
                            <li>Mengikuti pelatihan budidaya laut</li>
                            <li>Memilih benih dari hatchery terpercaya</li>
                            <li>Menggunakan sistem monitoring otomatis</li>
                        </ul>
                        <p class="mt-2">Dengan persiapan yang baik dan bimbingan dari ahli, pemula bisa sukses dalam budidaya kakap putih.</p>
                    </div>
                </div>

                <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
                    <button class="faq-question w-full flex justify-between items-center p-4 text-left font-medium hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-200">
                        <span>Bagaimana prospek pasar kakap putih ke depan?</span>
                        <i class="fas fa-chevron-down transition-transform duration-200"></i>
                    </button>
                    <div class="faq-answer hidden p-4 border-t border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300">
                        <p>Prospek pasar kakap putih cukup cerah dengan beberapa indikator positif:</p>
                        <ul class="list-disc list-inside mt-2 space-y-1">
                            <li>Permintaan domestik meningkat seiring pertumbuhan ekonomi</li>
                            <li>Pasar ekspor ke Singapura, Hong Kong, dan Timur Tengah stabil</li>
                            <li>Harga relatif stabil di kisaran Rp 55.000-80.000/kg</li>
                            <li>Kesadaran konsumen akan gizi ikan laut semakin tinggi</li>
                            <li>Diversifikasi produk olahan (fillet, frozen, dll) memperluas pasar</li>
                        </ul>
                        <p class="mt-2">Dengan kualitas produk yang baik dan sertifikasi yang memadai, pasar kakap putih masih terbuka lebar.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 dark:bg-gray-950 text-gray-300 py-12">
        <div class="max-w-6xl mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4 text-white">SI KAKAP</h3>
                    <p class="text-sm">
                        Sistem Informasi Tambak Kakap Putih untuk budidaya laut penuh. Menyediakan pengetahuan, alat monitoring, dan kalkulator budidaya.
                    </p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4 text-white">Tautan Cepat</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#home" class="hover:text-blue-400 transition duration-200">Beranda</a></li>
                        <li><a href="#about" class="hover:text-blue-400 transition duration-200">Tentang Kakap Putih</a></li>
                        <li><a href="#culture" class="hover:text-blue-400 transition duration-200">Teknik Budidaya</a></li>
                        <li><a href="#monitoring" class="hover:text-blue-400 transition duration-200">Sistem Monitoring</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4 text-white">Kontak Kami</h3>
                    <ul class="space-y-2 text-sm">
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-2 text-blue-400"></i>
                            <span>info@sikakap.id</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone-alt mr-2 text-blue-400"></i>
                            <span>+62 812 3456 7890</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-2 text-blue-400"></i>
                            <span>Gorontalo, Indonesia</span>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4 text-white">Sosial Media</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 transition duration-200">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-8 h-8 bg-blue-400 rounded-full flex items-center justify-center hover:bg-blue-500 transition duration-200">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-8 h-8 bg-pink-600 rounded-full flex items-center justify-center hover:bg-pink-700 transition duration-200">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-8 h-8 bg-red-600 rounded-full flex items-center justify-center hover:bg-red-700 transition duration-200">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                    <div class="mt-4">
                        <h4 class="text-sm font-medium mb-2">Berlangganan Newsletter</h4>
                        <div class="flex">
                            <input type="email" placeholder="Email Anda" class="px-3 py-2 bg-gray-700 text-white rounded-l-md focus:outline-none focus:ring-1 focus:ring-blue-500 w-full">
                            <button class="bg-blue-600 hover:bg-blue-700 px-3 py-2 rounded-r-md text-white">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-sm text-center text-gray-400">
                <p>&copy; 2025 SI KAKAP - Sistem Informasi Tambak Kakap Putih. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Dark mode toggle
        const themeToggle = document.getElementById('theme-toggle');
        const html = document.documentElement;

        // Check for saved user preference or use OS preference
        const userTheme = localStorage.getItem('theme');
        const osTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        const initialTheme = userTheme || osTheme;

        if (initialTheme === 'dark') {
            html.classList.add('dark');
            themeToggle.innerHTML = '<i class="fas fa-sun text-yellow-300"></i>';
        } else {
            html.classList.remove('dark');
            themeToggle.innerHTML = '<i class="fas fa-moon text-gray-700"></i>';
        }

        themeToggle.addEventListener('click', () => {
            html.classList.toggle('dark');
            const isDark = html.classList.contains('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            themeToggle.innerHTML = isDark ?
                '<i class="fas fa-sun text-yellow-300"></i>' :
                '<i class="fas fa-moon text-gray-700"></i>';
        });

        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // FAQ accordion
        const faqQuestions = document.querySelectorAll('.faq-question');
        faqQuestions.forEach(question => {
            question.addEventListener('click', () => {
                const answer = question.nextElementSibling;
                const icon = question.querySelector('i');

                answer.classList.toggle('hidden');
                icon.classList.toggle('transform');
                icon.classList.toggle('rotate-180');
            });
        });

        // Growth chart
        const ctx = document.getElementById('growthChart').getContext('2d');
        const growthChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Bulan 1', 'Bulan 2', 'Bulan 3', 'Bulan 4', 'Bulan 5', 'Bulan 6', 'Bulan 7', 'Bulan 8'],
                datasets: [{
                    label: 'Berat Rata-rata (gram)',
                    data: [5, 50, 150, 300, 450, 600, 750, 900],
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.raw + 'g';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Berat (gram)'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Waktu Budidaya'
                        }
                    }
                }
            }
        });

        // Cost calculator
        function calculateCost() {
            const pondSize = parseFloat(document.getElementById('pond-size').value);
            const fishDensity = parseFloat(document.getElementById('fish-density').value);
            const seedPrice = parseFloat(document.getElementById('seed-price').value);
            const fcr = parseFloat(document.getElementById('fcr').value);
            const feedPrice = parseFloat(document.getElementById('feed-price').value);
            const culturePeriod = parseFloat(document.getElementById('culture-period').value);

            // Calculations
            const totalFish = pondSize * fishDensity;
            const seedCost = totalFish * seedPrice;

            // Assuming average harvest weight of 600g (0.6kg) per fish
            const totalBiomass = totalFish * 0.6;
            const totalFeed = totalBiomass * fcr;
            const feedCost = totalFeed * feedPrice;

            // Other costs estimation (20% of feed cost)
            const otherCosts = feedCost * 0.2;

            // Total cost
            const totalCost = seedCost + feedCost + otherCosts;

            // Revenue (assuming 80% survival rate and price of Rp 60,000 per kg)
            const harvestFish = totalFish * 0.8;
            const harvestBiomass = harvestFish * 0.6;
            const revenue = harvestBiomass * 60000;

            // Profit
            const profit = revenue - totalCost;

            // ROI
            const roi = (profit / totalCost) * 100;

            // Display results
            const resultHTML = `
                <div class="space-y-3">
                    <div class="flex justify-between border-b border-gray-200 dark:border-gray-700 pb-2">
                        <span>Total Biaya Benih</span>
                        <span class="font-medium">Rp ${seedCost.toLocaleString('id-ID')}</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-200 dark:border-gray-700 pb-2">
                        <span>Total Biaya Pakan</span>
                        <span class="font-medium">Rp ${feedCost.toLocaleString('id-ID')}</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-200 dark:border-gray-700 pb-2">
                        <span>Biaya Operasional Lainnya</span>
                        <span class="font-medium">Rp ${otherCosts.toLocaleString('id-ID')}</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-200 dark:border-gray-700 pb-2 font-semibold">
                        <span>Total Biaya Produksi</span>
                        <span class="text-blue-600 dark:text-blue-400">Rp ${totalCost.toLocaleString('id-ID')}</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-200 dark:border-gray-700 pb-2">
                        <span>Estimasi Produksi (kg)</span>
                        <span class="font-medium">${harvestBiomass.toFixed(1)} kg</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-200 dark:border-gray-700 pb-2">
                        <span>Estimasi Pendapatan</span>
                        <span class="font-medium">Rp ${revenue.toLocaleString('id-ID')}</span>
                    </div>
                    <div class="flex justify-between pt-4 text-lg">
                        <span>Keuntungan Bersih</span>
                        <span class="font-bold ${profit >= 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400'}">
                            Rp ${profit.toLocaleString('id-ID')} (${roi.toFixed(1)}%)
                        </span>
                    </div>
                    <div class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                        *Perhitungan berdasarkan asumsi survival rate 80% dan harga jual Rp 60.000/kg
                    </div>
                </div>
            `;

            document.getElementById('calculation-result').innerHTML = resultHTML;
        }
    </script>
</body>

</html>