# UAS Pemrograman Web
Nama  : Khairani Bilqis

NIM   : 121140091

Kelas : Pemrograman Web RB

Website (hosting) : https://pendaftaran-121140091.000webhostapp.com/

Username : Khairani

Password : 1101-2003

## Bagian 1: Client-side Programming

Dibuat website dengan dua halaman. Halaman pertama digunakan untuk login (`login.php`), dan halaman kedua untuk manajemen data pendaftaran mahasiswa (`index.php`).

Pada halaman login, disediakan formulir untuk input login pengguna. Pada halaman manajemen, dibuat dua formulir untuk menambah dan mengedit data. Menggunakan DOM JavaScript Form akan muncul ketika tombol "Tambah Data" atau "Edit Data" diklik. Fungsi ini terdapat di dalam file (`functions.php`)
```php
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
```
Formulir pada halaman manajemen memiliki lima input dengan tipe yang berbeda, yaitu teks, number, radio, pilihan, dan date. Setelah input data, data akan ditampilkan dalam tabel yang dilengkapi dengan fitur penghapusan data yang dapat dipilih oleh pengguna berdasarkan data nama mahasiswa yang ingin dihapus.

Sebelum memproses data input ke file PHP, validasi data dengan JavaScript menggunakan fungsi `validateForm()` untuk memastikan tidak ada input yang kosong. Akan ada tampilan peringatan di website jika ada input yang kosong. Penerapan ini diterapkan pada (`login.php`)
```script
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
```

## Bagian 2: Server-side Programming

Dibuat satu file PHP utama untuk menangani proses data antara website dan database:

1. `function.php`: Verifikasi pengguna untuk login dan akses ke halaman manajemen (metode POST), menambahkan user baru ke dalam database (metode POST), tambahkan input data mahasiswa dari website ke database (metode POST), perbarui data yang sudah dimasukkan berdasarkan Nama yang dipilih (metode POST), hapus data berdasarkan ID yang diberikan (metode GET).

## Bagian 3: Manajemen Database

Query konfigurasi database:
```sql
CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL, 
  `jenkel` varchar(12) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `nim` int(9) NOT NULL,
  `prodi` varchar(100) NOT NULL,
  `semester` int(2) NOT NULL,
  `statusk` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `mahasiswa` (`id`, `nama`, `jenkel`, `tgl_lahir`, `nim`, `prodi`, `semester`, `statusk`, `email`) VALUES
(1, 'Khairani Bilqis', 'Perempuan', '2003-01-11', 121140091, 'Teknik Informatika', 5, 'Aktif', 'khairani.121140091@student.itera.ac.id'),
(2, 'Adib Raihan Mudzaky', 'Laki-Laki', '2001-10-06', 121140210, 'Teknik Informatika', 5, 'Aktif', 'adib.121140210@student.itera.ac.id'),
(3, 'Hasna Dhiya Azizah', 'Perempuan', '2003-04-20', 121140029, 'Teknik Informatika', 5, 'Aktif', 'hasna.121140029@student.itera.ac.id'),
(4, 'Andreyan Renaldi', 'Laki-Laki', '2003-04-08', 121140186, 'Teknik Informatika', 5, 'Aktif', 'andreyan.121140186@student.itera.ac.id'),
(5, 'Umy Afifah', 'Perempuan', '2003-10-26', 121140087, 'Teknik Informatika', 5, 'Aktif', 'umy.121140087@student.itera.ac.id');

CREATE TABLE `pengguna` (
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `pengguna` (`username`, `password`) VALUES
('Khairani', '1101-2003');

ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`username`);

ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;
```

## Query Script PHP:

###(`functions.php`)
### Untuk Login pada function login
```php
$result = mysqli_query($conn, "SELECT * FROM pengguna WHERE username = '$username'");
```
### Untuk Tambah pada function tambah
```php
$query = "INSERT INTO mahasiswa (id, nama, jenkel, tgl_lahir, nim, prodi, semester, statusk, email)
                    VALUES
                  ('$id', '$nama', '$jenkel', '$tgl_lahir', '$nim', '$prodi', '$semester', '$statusk', '$email')
                ";
        mysqli_query($conn, $query);
```
### Untuk Edit pada function ubah
```php
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
```
### Untuk Edit pada function edit
```php
$query = "SELECT * FROM mahasiswa WHERE id = $id";
        $result = mysqli_query($conn, $query);
```
### Untuk Hapus pada function hapus
```php
$id = mysqli_real_escape_string($conn, $id); // Hindari SQL injection
        mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = '$id'");
```

### Bagian 4: State Management

Dibuat session pada page (`login.php`), (`index.php`), (`edit.php`), (`tambah.php`), dan (`hapus.php`) dengan menggunakan session_start(), logika untuk penerapan session untuk tiap page dapat dilihat pada tiap code program.

Dibuat juga fungsi-fungsi untuk menetapkan, mendapatkan, dan menghapus cookie pada (`login.php`) dan (`function.php`), berikut kode programnya:
### login.php
```php
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
```
### functions.php
```php
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
            // Cek password tanpa hash
            $row = mysqli_fetch_assoc($result);
            if ($password === $row["password"]) { // Bandingkan password tanpa hash
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
```

## Bagian Bonus: Hosting Aplikasi Web

### 1. Apa langkah-langkah yang Anda lakukan untuk meng-host aplikasi web Anda?
1. Akses 000webhost.com.
2. Buat akun baru.
3. Klik "Create Website" dan pilih plan yang free.
4. Masukkan nama website dan password.
5. Pilih menu "Upload File" dan upload semua file website ke folder public_html.
6. Masuk ke menu "Database Manager", buat database baru, catat nama, user, dan password database, dan update variabel di function.php.
7. Website dapat diakses dengan database yang berfungsi.
   
### 2. Pilih penyedia hosting web yang menurut Anda paling cocok untuk aplikasi web Anda. Berikan alasan Anda.
   Saya melakukan hosting di 000webhost.com dikarenakan mudah untuk diimplementasikan dan tidak memungut biaya apapun, selain itu diberikan layanan database  yang tidak dimiliki pada beberapa hostingan lain yang gratis seperti layanan hosting pada github.
 
### 3. Bagaimana Anda memastikan keamanan aplikasi web yang Anda host?
1. Implementasi HTTPS dengan sertifikat SSL untuk enkripsi data.
2. Penggunaan HTTPS untuk melindungi data sensitif selama transmisi.
3. Penggunaan Web Server Nginx.
4. Menggunakan cookies ketikan login untuk mencegah user yang belum login mengakses page manajemen.
 
### 4. Jelaskan konfigurasi server yang Anda terapkan untuk mendukung aplikasi web Anda.
1. Implementasi sertifikat SSL/TLS untuk koneksi aman.
2. Penggunaan HTTPS untuk enkripsi data transmisi.
3. Menggunakan Web Server Nginx.
