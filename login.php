<!-- by KHAIRANI BILQIS - 121140091 -->
<!-- Pemrograman Web RB - UAS -->
<?php
session_start();
require 'functions.php';

// Fungsi untuk menetapkan cookie jika belum ada
function setLoginCookie($username) {
    setcookie('key', hash('sha256', $username), time() + 60); // Set cookie 'key' dengan hash SHA-256 dari username
}

// Fungsi untuk mendapatkan nilai cookie 'key'
function getLoginKeyCookie() {
    return isset($_COOKIE['key']) ? $_COOKIE['key'] : null;
}

// Fungsi untuk menghapus cookie 'key'
function removeLoginCookies() {
    setcookie('key', '', time() - 3600); // Set waktu kadaluarsa cookie ke waktu yang sudah lewat
}

// Cek cookie
$keyFromCookie = getLoginKeyCookie();

if ($keyFromCookie) {
    // Ambil username berdasarkan cookie 'key'
    $result = mysqli_query($conn, "SELECT * FROM pengguna WHERE username = '$keyFromCookie'");
    $row = mysqli_fetch_assoc($result);

    // Cek cookie dan username
    if ($row) {
        $_SESSION['login'] = true;
        header("Location: index.php"); // Redirect ke halaman index.php jika login berhasil
        exit();
    }
}

// Cek jika pengguna sudah login, redirect ke halaman utama
if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Panggil fungsi login
    if (login($username, $password)) {
        header("Location: index.php"); // Redirect ke halaman index.php jika login berhasil
        exit;
    } else {
        $error = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style-login.css">
	<title>Login | UAS Pemrograman Web</title>
</head>

<body>
    <div class="login">
        <img class="logo" src="img/logo-itera.png"/>
        <h1>Login</h1>

        <?php if (isset($error)) : ?>
            <!-- Tampilkan notifikasi kesalahan jika ada -->
            <p style="color: red; font-style: italic;">Username atau Password salah. Silakan coba lagi.</p>
        <?php endif; ?>

        <form action="login.php" method="post" onsubmit="return validateForm()">
            <input type="text" name="username" id="username" placeholder="Username" required>
            <br>

            <input type="password" name="password" id="password" placeholder="Password" required>
            <br><br>
        
            <label for="remember" class="remember">
                <input type="checkbox" name="remember" id="remember"> Remember me
            </label>
            <br>
        
            <button type="submit" name="login"><a href="index.php">Login</a></button>
        </form>

        <p>Belum punya akun? <a href="register.php">Register</a></p>
    </div>

    <script>
        // Fungsi untuk validasi form sebelum submit
        function validateForm() {
            var username = document.getElementById('username').value;
            var password = document.getElementById('password').value;

            // Validasi username dan password
            if (username.trim() === '') {
                alert('Username tidak boleh kosong');
                return false;
            }

            if (password.trim() === '') {
                alert('Password tidak boleh kosong');
                return false;
            }

            return true;
        }

        // Event untuk menangani klik pada tombol submit
        document.querySelector('form').addEventListener('submit', function () {
            // Implementasikan logika sesuai kebutuhan
            console.log('Form submitted');
        });

        // Event untuk menangani perubahan pada input username
        document.getElementById('username').addEventListener('input', function () {
            // Implementasikan logika sesuai kebutuhan
            console.log('Username input changed:', this.value);
        });
    </script>
</body>
</html>
