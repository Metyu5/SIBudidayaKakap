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
                  <img src="https://picsum.photos/100" alt="Admin" class="h-10 w-10 rounded-full">
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

              <!-- Menu Dropdown -->
              <div x-data="{ open: !isSidebarCollapsed }">
                  <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 text-sm font-medium rounded-lg hover:bg-blue-700 text-white sidebar-item">
                      <div class="flex items-center">
                          <i class="fas fa-table mr-3 text-blue-300"></i>
                          <span class="sidebar-item-text">Master Data</span>
                      </div>
                      <i class="fas fa-chevron-down text-xs transition-transform duration-200 sidebar-dropdown-icon"
                          :class="open ? 'transform rotate-180' : ''"></i>
                  </button>
                  <div x-show="open" x-collapse class="ml-8 mt-1 space-y-1 sidebar-dropdown-items">
                      <a href="dashboard.php?page=users" class="flex items-center px-3 py-2 text-sm rounded-lg hover:bg-blue-700 text-blue-200">
                          <i class="fas fa-user mr-2 w-4 text-blue-300"></i> Pengguna
                      </a>
                      <a href="#" class="flex items-center px-3 py-2 text-sm rounded-lg hover:bg-blue-700 text-blue-200">
                          <i class="fas fa-seedling mr-2 w-4 text-blue-300"></i> Bibit
                      </a>
                      <a href="#" class="flex items-center px-3 py-2 text-sm rounded-lg hover:bg-blue-700 text-blue-200">
                          <i class="fas fa-fish mr-2 w-4 text-blue-300"></i> Pakan
                      </a>
                      <a href="#" class="flex items-center px-3 py-2 text-sm rounded-lg hover:bg-blue-700 text-blue-200">
                          <i class="fas fa-water mr-2 w-4 text-blue-300"></i> Kolam
                      </a>
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