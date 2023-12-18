<!-- by KHAIRANI BILQIS - 121140091 -->
<!-- Pemrograman Web RB - UAS -->
<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "data_web");


if (!function_exists('setLoginCookie')) {
    function setLoginCookie($username) {
        setcookie('key', hash('sha256', $username), time() + 60); // Set cookie 'key' dengan hash SHA-256 dari username
    }
}

if (!function_exists('getLoginKeyCookie')) {
    function getLoginKeyCookie() {
        return isset($_COOKIE['key']) ? $_COOKIE['key'] : null;
    }
}

if (!function_exists('login')) {
    function login($username, $password) {
        global $conn;

        $result = mysqli_query($conn, "SELECT * FROM pengguna WHERE username = '$username'");

        // Cek username
        if (mysqli_num_rows($result) === 1) {
            // Cek password
            $row = mysqli_fetch_assoc($result);
            // Perbaikan: tambahkan tanda kutip pada $password di dalam password_verify
            if (password_verify($password, $row["password"])) {
                // Set session
                $_SESSION["login"] = true;

                // Cek remember me
                if (isset($_POST['remember'])) {
                    // Buat cookie
                    setLoginCookie($row['username']);
                }

                return true;
            } else {
                echo "Password tidak cocok. Password yang dimasukkan: $password, Password di database: {$row['password']}";
            }
        } else {
            echo "Username tidak ditemukan. Username yang dimasukkan: $username";
        }

        return false;
    }
}


if (!function_exists('query')) {
    function query($query) {
        global $conn;
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Query error: " . mysqli_error($conn) . " Query: " . $query);
    }
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
    }
}

if (!function_exists('tambah')) {
    function tambah($data) {
        global $conn;

        $id = htmlspecialchars($data["id"]);
        $nama = htmlspecialchars($data["nama"]);
        $jenkel = htmlspecialchars($data["jenkel"]);
        $tgl_lahir = htmlspecialchars($data["tgl_lahir"]);
        $nim = htmlspecialchars($data["nim"]);
        $prodi = htmlspecialchars($data["prodi"]);
        $semester = htmlspecialchars($data["semester"]);
        $statusk = htmlspecialchars($data["statusk"]);
        $email = htmlspecialchars($data["email"]);

        $query = "INSERT INTO mahasiswa (id, nama, jenkel, tgl_lahir, nim, prodi, semester, statusk, email)
                    VALUES
                  ('$id', '$nama', '$jenkel', '$tgl_lahir', '$nim', '$prodi', '$semester', '$statusk', '$email')
                ";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }
}

if (!function_exists('hapus')) {
    function hapus($id) {
        global $conn;
        $id = mysqli_real_escape_string($conn, $id); // Hindari SQL injection
        mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = '$id'");
        return mysqli_affected_rows($conn);
    }
}

if (!function_exists('ubah')) {
    function ubah($data) {
        global $conn;

        $id = htmlspecialchars($data["id"]);
        $nama = htmlspecialchars($data["nama"]);
        $jenkel = htmlspecialchars($data["jenkel"]);
        $tgl_lahir = htmlspecialchars($data["tgl_lahir"]);
        $nim = htmlspecialchars($data["nim"]);
        $prodi = htmlspecialchars($data["prodi"]);
        $semester = htmlspecialchars($data["semester"]);
        $statusk = htmlspecialchars($data["statusk"]);
        $email = htmlspecialchars($data["email"]);

        $query = "UPDATE mahasiswa SET
                    nama = '$nama',
                    jenkel = '$jenkel',
                    tgl_lahir = '$tgl_lahir',
                    nim = '$nim',
                    prodi = '$prodi',
                    semester = '$semester',
                    statusk = '$statusk',
                    email = '$email'
                  WHERE id = $id
                ";

        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Query error: " . mysqli_error($conn));
        }

        return mysqli_affected_rows($conn);
    }
}

if (!function_exists('edit')) {
    function edit($id) {
        global $conn;
        $id = mysqli_real_escape_string($conn, $id);

        $query = "SELECT * FROM mahasiswa WHERE id = $id";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Query error: " . mysqli_error($conn));
        }

        $data = mysqli_fetch_assoc($result);
        return $data;
    }
}

if (!function_exists('registrasi')) {
    function registrasi($data) {
        global $conn;

        $username = strtolower(stripslashes($data["username"]));
        $password = mysqli_real_escape_string($conn, $data["password"]);
        $password2 = mysqli_real_escape_string($conn, $data["password2"]);

        // cek username sudah ada atau belum
        $result = mysqli_query($conn, "SELECT username FROM pengguna WHERE username = '$username'");

        if (mysqli_fetch_assoc($result)) {
            echo "<script>
                alert('Username Sudah Terdaftar!');
              </script>";
            return false;
        }

        // cek konfirmasi password
        if ($password !== $password2) {
            echo "<script>
                alert('Konfirmasi Password Tidak Sesuai!');
              </script>";
            return false;
        }

        // enkripsi password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // tambahkan user baru ke database
        mysqli_query($conn, "INSERT INTO pengguna VALUES('$username', '$password')");

        return mysqli_affected_rows($conn);
    }
}

if (!function_exists('logout')) {
    function logout() {
        session_start();
        $_SESSION = [];
        session_unset();
        session_destroy();

        // Hapus cookie 'key' jika ada
        if (isset($_COOKIE['key'])) {
            setcookie('key', '', time() - 3600);
        }

        header("Location: login.php");
        exit;
    }
}
?>