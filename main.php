<?php 
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        session_unset();

        session_destroy();

        header('Location:login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama</title>
    
</head>
<body>
    <h1>Selamat Datang <?= $_SESSION['nama'] ?></h1>
    <h1>Anda pertama kali login pada <?= $_COOKIE['pertama_login'] ?></h1>

    <form action="" method="POST">
        <button type="submit">Logout</button>
    </form>
    
</body>
</html>