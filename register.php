<!-- by KHAIRANI BILQIS - 121140091 -->
<!-- Pemrograman Web RB - UAS -->
<?php 
require 'functions.php';

if(isset($_POST["register"]) ) {

	if( registrasi($_POST) > 0 ) {
		echo "<script>
				alert('User Baru Berhasil Ditambahkan!');
			  </script>";
	} else {
		echo mysqli_error($conn);
	}

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style-register.css">
	<title>Registrasi | UAS Pemrograman Web</title>
	<style>
		label {
			display: block;
		}
	</style>
</head>

<body>
    <div class="register">
        <img class="logo" src="img/logo-itera.png"/>
        <h1>Registrasi</h1>

        <?php if (isset($error)) : ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

        <form action="" method="post" onsubmit="return validateForm()">
            <input type="text" name="username" id="username" placeholder="Username" required>
            <br>

            <input type="password" name="password" id="password" placeholder="Password" required>
            <br>

            <input type="password" name="password2" id="password2" placeholder="Confirm Password" required>
            <br><br>
        
            <button type="submit" name="register">Register</button>
        </form>

        <p>Sudah punya akun? <a href="login.php">Login disini</a></p>
    </div>
</body>
</html>