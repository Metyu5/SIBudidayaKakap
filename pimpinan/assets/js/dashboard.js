// pimpinan/assets/js/pimpinan_dashboard.js
document.addEventListener('alpine:init', () => {
  Alpine.data('dashboard', () => ({
    isSidebarOpen: window.innerWidth >= 1024, // Sidebar terbuka secara default di desktop
    isSidebarCollapsed: false, // Tidak collapsed secara default
    openSubmenu: null, // Untuk mengontrol submenu yang terbuka
    currentPath: window.location.search, // Untuk menandai menu aktif

    init() {
      window.addEventListener('resize', () => {
        // Saat resize, jika lebar layar kurang dari 1024px, sidebar harus tertutup
        // Jika lebar layar >= 1024px, sidebar harus terbuka (sesuai desktop mode)
        this.isSidebarOpen = window.innerWidth >= 1024;
        // Saat kembali ke desktop, pastikan sidebar tidak collapsed jika sebelumnya collapsed di mobile
        if (window.innerWidth >= 1024 && !this.isSidebarOpen) {
          this.isSidebarCollapsed = false; // Reset collapsed state
        }
        // Tutup submenu jika sidebar collapse di desktop
        if (window.innerWidth >= 1024 && this.isSidebarCollapsed) {
          this.openSubmenu = null;
        }
      });

      // Set currentPath saat inisialisasi untuk menandai menu aktif
      this.currentPath = window.location.search;
      // Buka submenu jika link aktif ada di dalamnya saat dimuat
      this.initializeActiveSubmenu();
    },

    initializeActiveSubmenu() {
      // Logika untuk membuka submenu berdasarkan URL saat ini
      if (this.currentPath.includes('kelola_teknisi')) {
        this.openSubmenu = 'manajemen_pengguna';
      } else if (this.currentPath.includes('laporan_kualitas_air_global') || this.currentPath.includes('laporan_pakan_global') || this.currentPath.includes('laporan_kesehatan_global')) {
        this.openSubmenu = 'laporan_global';
      }
      // Tambahkan kondisi lain jika ada submenu lain yang perlu dibuka secara otomatis
    },

    toggleSidebar() {
      this.isSidebarOpen = !this.isSidebarOpen;
      // Jika sidebar dibuka di mobile, pastikan tidak dalam mode collapsed
      if (window.innerWidth < 1024 && this.isSidebarOpen) {
        this.isSidebarCollapsed = false; // Pastikan collapse mode off di mobile
      }
    },

    closeSidebar() {
      this.isSidebarOpen = false;
    },

    toggleSidebarCollapse() {
      this.isSidebarCollapsed = !this.isSidebarCollapsed;
      // Saat beralih collapse di desktop, pastikan sidebar tetap 'open'
      if (window.innerWidth >= 1024) {
        this.isSidebarOpen = true;
      } else {
        // Jika tombol collapse diklik di mobile (meskipun seharusnya hidden),
        // pastikan sidebar ditutup sepenuhnya
        this.isSidebarOpen = false;
      }

      // Tutup submenu jika sidebar di-collapse
      if (this.isSidebarCollapsed) {
        this.openSubmenu = null;
      }
    },

    confirmLogout() {
      if (confirm('Apakah Anda yakin ingin logout?')) {
        window.location.href = '../logout.php'; // Sesuaikan dengan URL logout Anda
      }
    },
  }));
});
