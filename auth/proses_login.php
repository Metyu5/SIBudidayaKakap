<?php
include '../config/koneksi.php';

$email = $_POST['email'];
$password = $_POST['password'];
$kategori_form = $_POST['kategori'];

$query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
$result = mysqli_query($koneksi, $query);
$user = mysqli_fetch_assoc($result);

if ($user && $password === $user['password']) {
    if ($kategori_form === $user['kategori']) {
        session_start();
        $_SESSION['usersId'] = $user['usersId'];
        $_SESSION['nama'] = $user['nama'];
        $_SESSION['kategori'] = $user['kategori'];

        if ($user['kategori'] === 'administrator') {
            $_SESSION['success'] = "Welcome Back, " . $user['nama'] ;
            header("Location: ../admin/dashboard.php");
        } elseif ($user['kategori'] === 'pimpinan') {
            $_SESSION['success'] = "Welcome Back, " . $user['nama'];
            header("Location: ../pimpinan/dashboard.php");
        } elseif ($user['kategori'] === 'teknisi') {
            $_SESSION['success'] = "Welcome Back, " . $user['nama'];
            header("Location: ../teknisi/dashboard.php");
        } else {
            header("Location: ../index.php?error=kategori_tidak_dikenal");
        }
    } else {
        header("Location: ../index.php?error=kategori_salah");
    }
} else {
    header("Location: ../index.php?error=login_gagal");
}
?>