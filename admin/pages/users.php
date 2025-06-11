<?php
include_once __DIR__ . '/../../config/koneksi.php';


// Cek apakah form update dikirim
if (isset($_POST['update_id'])) {
  $id = $_POST['update_id'];
  $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
  $email = mysqli_real_escape_string($koneksi, $_POST['email']);
  $kategori = $_POST['update_kategori'];
  $password_baru = $_POST['update_password'];

  // Cek apakah password baru diisi
  if (!empty($password_baru)) {
    $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);
    $query_update = mysqli_query($koneksi, "UPDATE users SET nama='$nama', email='$email', kategori='$kategori', password='$password_hash' WHERE usersId='$id'");
  } else {
    $query_update = mysqli_query($koneksi, "UPDATE users SET nama='$nama', email='$email', kategori='$kategori' WHERE usersId='$id'");
  }

  if ($query_update) {
    echo "<script>
      const notyf = new Notyf({ duration: 3000, position: { x: 'right', y: 'bottom' } });
      notyf.success('Data pengguna berhasil diperbarui!');
      setTimeout(() => { window.location.href = ''; }, 1500);
    </script>";
  } else {
    echo "<script>
      const notyf = new Notyf({ duration: 3000, position: { x: 'right', y: 'top' } });
      notyf.error('Gagal memperbarui data pengguna!');
    </script>";
  }
}

// Cek jika form tambah pengguna dikirim
if (isset($_POST['nama'], $_POST['email'], $_POST['password'], $_POST['password_confirm'], $_POST['kategori']) && !isset($_POST['update_id'])) {
  $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
  $email = mysqli_real_escape_string($koneksi, $_POST['email']);
  $password = $_POST['password'];
  $password_confirm = $_POST['password_confirm'];
  $kategori = $_POST['kategori'];

  // Validasi password
  if ($password !== $password_confirm) {
    echo "<script>
      alert('Konfirmasi password tidak cocok!');
      window.location.href = '';
    </script>";
    exit;
  }

  $password_hash = password_hash($password, PASSWORD_DEFAULT);
  $query_insert = mysqli_query($koneksi, "INSERT INTO users (nama, email, password, kategori) VALUES ('$nama', '$email', '$password_hash', '$kategori')");

  if ($query_insert) {
    echo "<script>
      const notyf = new Notyf({ duration: 3000, position: { x: 'right', y: 'bottom' } });
      notyf.success('Pengguna berhasil ditambahkan!');
      setTimeout(() => { window.location.href = ''; }, 1500);
    </script>";
  } else {
    echo "<script>
      alert('Gagal menambahkan pengguna!');
      window.location.href = '';
    </script>";
  }
}


// Ambil data pengguna untuk ditampilkan
$query = mysqli_query($koneksi, "SELECT * FROM users");
$no = 1;
?>


<body class="bg-gray-50 font-sans antialiased">
  <!-- Alpine.js scope untuk modal -->
  <div x-data="{ showModal: false, showEditModal: false, editUser: {} }" x-cloak>

    <main class="p-3 w-full max-w-screen-2xl mx-auto">
      <!-- Header & Tombol Tambah -->
      <div class="flex justify-between items-center mb-8">
        <div>
          <h1 class="text-2xl font-bold text-gray-900">Manajemen Pengguna</h1>
          <p class="text-gray-500 mt-2">Manage system user accounts and permissions</p>
        </div>
        <button
          @click="showModal = true"
          class="bg-indigo-600 hover:bg-indigo-700 active:scale-95 active:shadow-inner text-white text-sm font-medium px-2 py-2.5 rounded-md shadow-md flex items-center transition-all duration-150 ease-in-out">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
          </svg>
          Tambah Pengguna
        </button>

      </div>

      <!-- Tabel Pengguna -->
      <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
          <table class="w-full">
            <thead class="bg-gray-50">
              <tr class="text-left text-sm font-medium text-gray-500 tracking-wider">
                <th class="px-6 py-3">No</th>
                <th class="px-6 py-3">Nama</th>
                <th class="px-6 py-3">Email</th>
                <th class="px-6 py-3">Kategori</th>
                <th class="px-6 py-3 text-right">Aksi</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
              <?php while ($row = mysqli_fetch_assoc($query)): ?>
                <?php
                // Tentukan warna badge kategori
                $kategori = $row['kategori'];
                $warna = match ($kategori) {
                  'administrator' => 'bg-red-100 text-red-800',
                  'teknisi'       => 'bg-yellow-100 text-yellow-800',
                  'pimpinan'      => 'bg-green-100 text-green-800',
                  default         => 'bg-gray-100 text-gray-800',
                };
                ?>
                <tr class="hover:bg-gray-50">
                  <td class="px-6 py-4 text-sm font-medium text-gray-900"><?= str_pad($no++, 2, '0', STR_PAD_LEFT) ?></td>
                  <td class="px-6 py-4 flex items-center">
                    <div class="h-10 w-10 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 font-medium mr-3">
                      <?= strtoupper(substr($row['nama'], 0, 1)) ?>
                    </div>
                    <div>
                      <div class="font-medium text-gray-900"><?= htmlspecialchars($row['nama']) ?></div>
                      <div class="text-gray-500 text-xs">Last active unknown</div>
                    </div>
                  </td>
                  <td class="px-6 py-4 text-sm text-gray-500"><?= htmlspecialchars($row['email']) ?></td>
                  <td class="px-6 py-4">
                    <span class="px-2 py-1 text-xs font-semibold rounded-full <?= $warna ?>">
                      <?= htmlspecialchars($kategori) ?>
                    </span>
                  </td>
                  <td class="px-6 py-4 text-right text-sm flex justify-end space-x-2">
                    <!-- Edit & Hapus -->
                    <button
                      class="text-indigo-600 hover:text-indigo-900 p-2 rounded bg-indigo-500/10 hover:bg-indigo-500/20"
                      title="Edit"
                      @click="editUser = <?= htmlspecialchars(json_encode($row)) ?>; showEditModal = true">
                      <i class="fas fa-edit"></i>
                    </button>

                    <a href="" class="text-red-600 hover:text-red-900 p-2 rounded bg-red-500/10 hover:bg-red-500/20" title="Hapus" onclick="return confirm('Yakin ingin menghapus?')">
                      <i class="fas fa-trash-alt"></i>
                    </a>
                  </td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      </div>
    </main>

    <!-- Modal Tambah Pengguna -->
    <div
      x-show="showModal"
      x-cloak
      class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 px-4">
      <div
        @click.away="showModal = false"
        class="bg-white rounded-xl shadow-xl w-full max-w-lg mx-auto overflow-hidden">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200">
          <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Tambah Pengguna</h2>
            <button @click="showModal = false" class="text-gray-400 hover:text-gray-600">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
        </div>

        <!-- Body / Form -->
        <form action="" method="POST" class="px-6 py-5 space-y-5">
          <!-- Nama -->
          <div class="relative">
            <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
            <i class="fas fa-user absolute left-3 mt-3 text-gray-400"></i>
            <input id="nama" name="nama" type="text" required placeholder="Masukan Nama..."
              class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-300 rounded-lg text-gray-800 text-sm
                   focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400" />
          </div>

          <!-- Email -->
          <div class="relative">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <i class="fas fa-envelope absolute left-3 mt-3 text-gray-400"></i>
            <input id="email" name="email" type="email" required placeholder="Masukan Email..."
              class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-300 rounded-lg text-gray-800 text-sm
                   focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400" />
          </div>

          <!-- Password -->
          <div class="relative">
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <i class="fas fa-lock absolute left-3 mt-3 text-gray-400"></i>
            <input id="password" name="password" type="password" required placeholder="Masukan Password..."
              class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-300 rounded-lg text-gray-800 text-sm
                   focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400" />
          </div>

          <!-- Konfirmasi Password -->
          <div class="relative">
            <label for="password_confirm" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
            <i class="fas fa-lock absolute left-3 mt-3 text-gray-400"></i>
            <input id="password_confirm" name="password_confirm" type="password" required placeholder="Ulangi Password..."
              class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-300 rounded-lg text-gray-800 text-sm
                   focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400" />
          </div>

          <!-- Kategori -->
          <div class="relative">
            <label for="kategori" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
            <i class="fas fa-users-cog absolute left-3 mt-3 text-gray-400"></i>
            <select id="kategori" name="kategori"
              class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-300 rounded-lg text-gray-800 text-sm
                   focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400">
              <option value="administrator">Administrator</option>
              <option value="teknisi">Teknisi</option>
              <option value="pimpinan">Pimpinan</option>
            </select>
          </div>

          <!-- Buttons -->
          <div class="flex justify-end space-x-3 pt-2 border-t border-gray-200">
            <button type="button" @click="showModal = false"
              class="px-5 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
              Batal
            </button>
            <button type="submit"
              class="px-5 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
              Simpan
            </button>
          </div>
        </form>
      </div>
    </div>


    <!-- Modal Edit Pengguna -->
    <div
      x-show="showEditModal"
      x-cloak
      class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 px-4">
      <div
        @click.away="showEditModal = false"
        class="bg-white rounded-xl shadow-xl w-full max-w-lg mx-auto overflow-hidden">

        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200">
          <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Edit Pengguna</h2>
            <button @click="showEditModal = false" class="text-gray-400 hover:text-gray-600">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
        </div>

        <!-- Form Edit -->
        <form action="" method="POST" class="px-6 py-5 space-y-5">
          <!-- Hidden ID -->
          <input type="hidden" name="update_id" :value="editUser.usersId">

          <!-- Nama -->
          <div class="relative">
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
            <i class="fas fa-user absolute left-3 mt-3 text-gray-400"></i>
            <input type="text" name="nama" required placeholder="Masukan Nama..."
              class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-300 rounded-lg text-gray-800 text-sm
                 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400"
              :value="editUser.nama" />
          </div>

          <!-- Email -->
          <div class="relative">
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <i class="fas fa-envelope absolute left-3 mt-3 text-gray-400"></i>
            <input type="email" name="email" required placeholder="Masukan Email..."
              class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-300 rounded-lg text-gray-800 text-sm
                 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400"
              :value="editUser.email" />
          </div>

          <!-- Kategori -->
          <div class="relative">
            <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
            <i class="fas fa-users-cog absolute left-3 mt-3 text-gray-400"></i>
            <select name="update_kategori"
              class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-300 rounded-lg text-gray-800 text-sm
                 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400">
              <option value="administrator" :selected="editUser.kategori === 'administrator'">Administrator</option>
              <option value="teknisi" :selected="editUser.kategori === 'teknisi'">Teknisi</option>
              <option value="pimpinan" :selected="editUser.kategori === 'pimpinan'">Pimpinan</option>
            </select>
          </div>

          <!-- Optional: Ganti Password -->
          <div class="relative">
            <label class="block text-sm font-medium text-gray-700 mb-1">Ganti Password</label>
            <i class="fas fa-lock absolute left-3 mt-3 text-gray-400"></i>
            <input type="password" name="update_password" placeholder="Kosongkan jika tidak ingin mengubah"
              class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-300 rounded-lg text-gray-800 text-sm
                 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400" />
          </div>

          <!-- Tombol -->
          <div class="flex justify-end space-x-3 pt-2 border-t border-gray-200">
            <button type="button" @click="showEditModal = false"
              class="px-5 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
              Batal
            </button>
            <button type="submit"
              class="px-5 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
              Perbarui
            </button>
          </div>
        </form>
      </div>
    </div>


    <!-- Hanya script dashboard.js, Alpine di-load di header.php -->
    <script src="../assets/js/dashboard.js"></script>
</body>