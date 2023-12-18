<!-- by KHAIRANI BILQIS - 121140091 -->
<!-- Pemrograman Web RB - UAS -->
<?php 
session_start();

if(!isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'functions.php';

// cek apakah tombol submit sudah ditekan atau belum
if(isset($_POST["submit"])) {
	
	// cek apakah data berhasil di tambahkan atau tidak
	if( tambah($_POST) > 0 ) {
		echo "
			<script>
				alert('Data Berhasil Ditambahkan!');
				document.location.href = 'index.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('Data Gagal Ditambahkan!');
				document.location.href = 'index.php';
			</script>
		";
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Form | UAS Pemrograman Web</title>
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

        /* Gaya untuk pengaturan form dengan table */
        table {
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th, table td {
            padding: 5px;
            text-align: left;
        }
        /* Akhir untuk gaya pengaturan form dengan table */

        /* Gaya untuk form */
        .text{
            width: 300px;
        }

        .submit{
            margin-top: 20px;
            padding: 10px 15px;
            border-radius: 5px;
            border: none;
            background-color: rgb(0, 0, 150);
            color: white;
            font-family: "Roboto", sans-serif;
            font-weight: bold;
            transition: 0.15s ease-in-out;
            cursor: pointer;
        }

        .submit:hover{
            background-color: rgb(0, 0, 100);
            color: whitesmoke;
        }

        .submit:active {
            -webkit-transform: scale(0.98);
            transform: scale(0.98);
        }
        /* Akhir untuk gaya pada form */
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
                <h3>Halaman Formulir</h3>
            </div>
        </header>

        <!-- navbar -->
        <nav class="navbar">
            <li class="menu"><a href="tambah.php">Halaman Formulir</a></li>
            <li class="menu"><a href="index.php">Halaman Tabel</a></li>
        </nav>

        <!-- body -->
        <div class="body-content">
            <!-- content -->
            <div class="content">
                <main class="main-content">
                    <h2>Formulir Pendataan</h2>
                    <p>Isilah formulir di bawah ini dengan informasi yang sesuai:</p>
                    <table width="500">
                        <form class="formulir" action="" method="post">
                            <tr>
                                <td>No.</td>
                                <td>: <input required class="text" name="id" type="number"></td>
                            </tr>

                            <tr>
                                <td>Nama</td>
                                <td>: <input required class="text" name="nama" type="text"></td>
                            </tr>

                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>: 
                                    <input required type="radio" id="laki-laki" name="jenkel" class="jnskel" value="Laki-Laki"> <label for="laki-laki">Laki-Laki</label>  
                                    <input required type="radio" id="perempuan" name="jenkel" class="jnskel" value="Perempuan"> <label for="perempuan">Perempuan</label> 
                                </td>
                            </tr>

                            <tr>
                                <td>Tanggal Lahir</td>
                                <td>: <input required name="tgl_lahir" class="tanggal" type="date"></td>
                            </tr>

                            <tr>
                                <td>NIM</td>
                                <td>: <input required class="text" name="nim" type="text"></td>
                            </tr>
            
                            <tr>
                                <td>Program Studi</td>
                                <td>: <input required class="text" name="prodi" type="text"></td>
                            </tr>

                            <tr>
                                <td>Semester</td>
                                <td>: <input required class="semester" name="semester" type="number"></td>
                            </tr>
                            
                            <tr>  
                                <td>Status</td>
                                <td> : <select name="statusk">
                                            <option disabled hidden selected></option>
                                            <option value="Aktif">Aktif</option>
                                            <option value="Cuti">Cuti</option>
                                            <option value="Mengundurkan Diri">Mengundurkan Diri</option>
                                        </select>
                                </td>                                    
                            </tr>    

                            <tr>
                                <td>Email</td>
                                <td>: <input required class="text-email" name="email" type="email"></td>
                            </tr>

                            <tr>
                                <td colspan="2"><button type="submit" name="submit" class="submit">Submit</button></td>
                            </tr>
                        </form>
                    </table>
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