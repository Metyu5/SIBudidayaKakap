function dashboard() {
  return {
    isSidebarOpen: window.innerWidth >= 1024,
    isSidebarCollapsed: false,

    init() {
      window.addEventListener('resize', () => {
        this.isSidebarOpen = window.innerWidth >= 1024;
      });
    },

    toggleSidebar() {
      this.isSidebarOpen = !this.isSidebarOpen;
    },

    closeSidebar() {
      this.isSidebarOpen = false;
    },

    toggleSidebarCollapse() {
      this.isSidebarCollapsed = !this.isSidebarCollapsed;
      if (window.innerWidth < 1024) {
        this.isSidebarOpen = false;
      }
    },
  };
}

function confirmLogout() {
  const notyf = new Notyf({
    duration: 2000,
    position: {
      x: 'right',
      y: 'bottom',
    },
  });

  if (confirm('Yakin mau keluar?')) {
    notyf.success('Berhasil logout!');
    setTimeout(() => {
      window.location.href = '../index.php';
    }, 1000);
  } else {
    notyf.error('Logout dibatalkan.');
  }
}
