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
```
