<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        try
        {
            $db = new PDO("mysql:host=localhost;dbname=tugas_login", "root", "");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        if(empty($username))
        {
            header("Location:{$_SERVER['REQUEST_URI']}");
            die();
        }
        $query = $db->prepare("select password, nama from users where username = ?");
        $query->execute(array($username));
        $hasil = $query->fetch(PDO::FETCH_ASSOC);
        $correct_password = $hasil['password'];

        if ($correct_password == $password)
        {
            session_start();

            $_SESSION['nama'] = $hasil['nama'];
            
            if (!isset($_COOKIE['pertama_login']))
            {
                setcookie("pertama_login", date("Y-m-d"), time() + (86400 * 30), "/");
            }

            header('Location:main.php');
        }

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <style>
        body {background-image: url('foto1.jpg');
        background-size : cover;
        }
        .container {
            height : 100vh;
        }
        form {padding : 20px;
        }
    </style>
</head>
<body>
<div class="container d-flex justify-content-center align-items-center"'>
    <form class="bg-white rounded" action='' method='POST'>
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name='username'>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name='password'>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>