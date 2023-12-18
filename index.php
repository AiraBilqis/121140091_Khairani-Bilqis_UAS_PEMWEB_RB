<!-- by KHAIRANI BILQIS - 121140091 -->
<!-- Pemrograman Web RB - UAS -->
<?php 
session_start();

// Function to handle logout
function logout() {
    // Perform any necessary logout tasks
    // For example, unset session variables and destroy the session
    session_unset();
    session_destroy();
    
    // Redirect to login page or any other page after logout
    header("Location: login.php");
    exit;
}

// Logout jika parameter logout ada pada URL
if (isset($_GET['logout'])) {
    logout();
}

// Periksa jika pengguna belum login, redirect ke halaman login.php
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

// Jika form edit dipost, tampilkan formulir edit dengan data yang sudah ada
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedId = isset($_POST["selectedId"]) ? intval($_POST["selectedId"]) : 0;

    // Periksa apakah ID yang dipilih valid
    if ($selectedId <= 0) {
        echo "
            <script>
                alert('Invalid ID: $selectedId');
                window.location.href = 'index.php';
            </script>
        ";
        exit;
    }

    // Panggil fungsi edit untuk mendapatkan data yang akan diedit
    $dataToEdit = edit($selectedId);

    // Tampilkan formulir edit dengan data yang sudah ada
    include 'edit.php';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tabel | UAS Pemrograman Web</title>
    <style>
        /* Styling untuk tampilan website halaman tabel*/
        @import url("https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap");

        body{
            font-family: 'Roboto', sans-serif;
            background-color: lightgray;
        }

        .box {
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Gunakan setidaknya 100% dari tinggi viewport */
        }

        h2{
            font-size: 30px;
            font-family: Garamond;
        }

        /* Gaya untuk header */
        .header{
            background-color: rgb(44, 44, 44);
            color: white;
            height: 165px;
            border-radius:20px 20px 0px 0px;
            display: flex;
            justify-content: start;
            align-items: center;
        }

        /* Gaya untuk profil gambar di header */
        .headlogo{
            width: 120px;
            height: 120px;
            margin-left: 30px;
            border-radius: 20%;
            transition: 0.20s ease-in-out;
            background-color: white;
            object-fit: cover;
        }

        .headlogo:hover{
            scale: 1.1;
        }

        .sideprofil{
            margin-left: 20px;
            color: white;
        }

        .sideprofil h1{
            margin-bottom: -10px;
            font-family: Garamond;
            font-size: 34px;
        }
        /* Akhir untuk gaya pada header */

        /* Gaya untuk navigasi */
        .navbar{
            display: flex;
            flex-direction: row;
            justify-content: end;
            align-items: center;
            background-color: gray;
            border-radius:0px 0px 20px 20px;
        }
                
        .menu{
            list-style: none;
            padding: 7px 20px 7px 5px;
        }

        .menu button{
            padding: 0px;
            margin-bottom: 2px;
            margin-right: 10px;
            background: none;
            border: none;
            text-decoration: none;
            font-weight: bold;
            color: darkblue;
            font-size: 16px;
            font-family: 'Roboto', sans-serif;
        }

        .menu button:hover{
            text-decoration: underline;
            color: darkmagenta;
        }

        .menu button:active{
            color: indigo;
        }

        .menu a{
            text-decoration: none;
            font-weight: bold;
            color: darkblue;
        }

        .menu a:hover{
            text-decoration: underline;
            color: darkmagenta;
        }

        .menu a:active{
            color: indigo;
        }
        /* Akhir untuk gaya pada navigasi */

        /* Gaya untuk body-content */
        .body-content{
            position: relative;
            display: flex;
            flex: 1;
            justify-content: center;
        }

        /* Gaya untuk content */
        .content{
            margin: 20px 10px 10px;
            padding: 20px;
            border-radius: 20px;
            border: 1px solid #ccc;
            background-color: whitesmoke;
        }

        .main-content{
            padding: 0px 20px;
        }

        /* Gaya untuk table */
        table{
            width: 100%;
            margin-bottom: 20px;
            margin-right: 20px;
            border-collapse: collapse;
            font-size: 15px;
        }

        th{
            background-color: dimgrey;
            color: white;
            text-align: center;
        }

        th,td {
            border: 1px solid #ccc;
            padding: 3px 5px;
        }

        tr{
            text-align: center;
            transition: 0.2s;
            cursor: pointer;
        }

        tr:nth-child(odd){
            background-color: #f2f2f2;
        }

        tr:nth-child(even){
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: rgb(168, 168, 168); /* Warna saat dihover */
        }
        /* Akhir untuk gaya pada table */

        /* Gaya untuk button */
        .tambah_button{
            margin-top: 20px;
            margin-bottom: 20px;
            padding: 10px 15px;
            border-radius: 5px;
            border: none;
            background-color: rgb(31, 155, 31);
            color: white;
            font-family: "Roboto", sans-serif;
            font-weight: bold;
            transition: 0.15s ease-in-out;
            cursor: pointer;
        }

        .tambah_button:hover{
            background-color: darkgreen;
            color: whitesmoke;
        }

        .tambah_button:active {
            -webkit-transform: scale(0.98);
            transform: scale(0.98);
        }

        .edit_button{
            margin-top: 20px;
            margin-bottom: 20px;
            padding: 10px 15px;
            border-radius: 5px;
            border: none;
            background-color: rgb(231, 197, 1);
            color: white;
            font-family: "Roboto", sans-serif;
            font-weight: bold;
            transition: 0.15s ease-in-out;
            cursor: pointer;
        }

        .edit_button:hover{
            background-color: goldenrod;
            color: whitesmoke;
        }

        .edit_button:active {
            -webkit-transform: scale(0.98);
            transform: scale(0.98);
        }

        .hapus_button{
            margin-top: 20px;
            margin-bottom: 20px;
            padding: 10px 15px;
            border-radius: 5px;
            border: none;
            background-color: rgb(209, 0, 0);
            color: white;
            font-family: "Roboto", sans-serif;
            font-weight: bold;
            transition: 0.15s ease-in-out;
            cursor: pointer;
        }

        .hapus_button:hover{
            background-color: darkred;
            color: whitesmoke;
        }

        .hapus_button:active {
            -webkit-transform: scale(0.98);
            transform: scale(0.98);
        }
        /* Akhir untuk gaya pada button */
        /* Akhir untuk gaya pada content */
        /* Akhir untuk gaya pada body-content */

        /* Gaya untuk footer */
        footer{
            padding: 5px;
            margin-top: auto;    
            border-radius: 15px;
            background-color: rgb(44, 44, 44);
            text-align: center;
            color: white;
            font-size: 15px;
        }
        /* Akhir untuk gaya pada footer */

        @media screen and (max-width: 1020px){
            .body-content{
                flex-wrap: wrap;
            }

            .content{
                width: 100%;
                margin: 15px 10px 10px 5px;
                overflow: auto;
            }

            .table-container{
                overflow-x: auto;
            }
        }
    </style>
</head>

<body>
    <div class="box">
        <!-- header -->
        <header class="header">
            <img 
                src="https://upload.wikimedia.org/wikipedia/commons/e/ef/Logo_ITERA.png" 
                alt="Logo ITERA" 
                class="headlogo"
            >
                
            <div class="sideprofil">
                <h1>UTS Pemrograman Web</h1>
                <h3>Halaman Tabel</h3>
            </div>
        </header>

        <!-- navbar -->
        <nav class="navbar">
            <li class="menu"><a href="tambah.php">Halaman Formulir</a></li>
            <li class="menu"><a href="index.php">Halaman Tabel</a></li>
            <li class="menu">
                <!-- Logout Button -->
                <form action="?logout" method="post">
                    <button type="submit">Logout</button>
                </form>
            </li>
        </nav>

        <!-- body -->
        <div class="body-content">
            <!-- content -->
            <div class="content">
                <main class="main-content">
                    <h2>Tabel Data Mahasiswa</h2>
                    <p>Di bawah ini terdapat tabel yang menampilkan daftar mahasiswa beserta informasi mereka.</p>
                    <div class="table-container">
                        <?php
                            include("functions.php");
                            $sql = "SELECT * FROM mahasiswa";
                            $result = $conn->query($sql);
                                        
                            if ($result->num_rows > 0) {
                                // Menampilkan data baris per baris
                                echo
                                "<table border='1'>
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Tanggal Lahir</th>
                                            <th>NIM</th>
                                            <th>Program Studi</th>
                                            <th>Semester</th>
                                            <th>Status</th>
                                            <th>Email</th>
                                        </tr>
                                    </thead>
        
                                    <tbody>
                                    </tbody>";
                                // Tampilkan setiap baris data
                                while ($row = $result->fetch_assoc()) {
                                        echo 
                                        "<tr>
                                            <td>" . $row["id"] . "</td>
                                            <td>" . $row["nama"] . "</td>
                                            <td>" . $row["jenkel"] . "</td>
                                            <td>" . $row["tgl_lahir"] . "</td>
                                            <td>" . $row["nim"] . "</td>
                                            <td>" . $row["prodi"] . "</td>
                                            <td>" . $row["semester"] . "</td>
                                            <td>" . $row["statusk"] . "</td>
                                            <td>" . $row["email"] . "</td>
                                        </tr>";
                                }
                                echo "</table>";
                            } else {
                                echo "Tidak ada data dalam tabel.";
                            }
                        ?>
                    </div>
                    <button class="tambah_button" onclick="window.location.href='tambah.php'">
                        Tambah
                    </button>

                    <!-- Form untuk memilih mahasiswa yang akan diedit -->
                    <form action="edit.php" method="POST">
                        <label for="selectedId">Pilih Nama Mahasiswa:</label>
                        <select name="selectedId" id="selectedId">
                            <?php
                            // Tampilkan opsi ID yang dapat dipilih
                            $mahasiswaList = query("SELECT id, nama FROM mahasiswa");
                            foreach ($mahasiswaList as $mahasiswa) {
                                echo "<option value='" . $mahasiswa['id'] . "'>" . $mahasiswa['nama'] . "</option>";
                            }
                            ?>
                        </select>
                        <button type="submit" class="edit_button">Edit</button>
                    </form>
            
                    <form action="hapus.php" method="get">
                        <label for="hapus_id">Masukkan ID yang Ingin Dihapus:</label>
                        <input type="text" name="id" id="hapus_id" required>
                        <button type="submit" class="hapus_button">Hapus</button>
                    </form>
                </main>
            </div>
        </div>

        <!-- footer -->
        <footer class="footer">
            <p><strong>KHAIRANI BILQIS &copy; 2023</strong></p>
        </footer>
    </div>
</body>
</html>