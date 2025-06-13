// teknisi/assets/js/dashboard.js
function dashboard() {
  return {
    isSidebarOpen: window.innerWidth >= 1024,
    isSidebarCollapsed: false,

    init() {
      window.addEventListener('resize', () => {
        // Saat resize, jika lebar layar kurang dari 1024px, sidebar harus tertutup
        // Jika lebar layar >= 1024px, sidebar harus terbuka (sesuai desktop mode)
        this.isSidebarOpen = window.innerWidth >= 1024;
        // Saat kembali ke desktop, pastikan sidebar tidak collapsed jika sebelumnya collapsed di mobile (optional, tapi good UX)
        if (window.innerWidth >= 1024 && !this.isSidebarOpen) {
          // this.isSidebarOpen akan true di desktop
          this.isSidebarCollapsed = false; // Reset collapsed state
        }
      });
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
    },
  };
}

function confirmLogout() {
  const notyf = new Notyf({
    duration: 2000,
    position: { x: 'right', y: 'bottom' },
  });

  if (confirm('Anda yakin ingin keluar dari sesi ini?')) {
    notyf.success('Berhasil logout! Anda akan diarahkan ke halaman login.');
    setTimeout(() => {
      window.location.href = '../index.php';
    }, 1000);
  } else {
    notyf.error('Logout dibatalkan.');
  }
}
