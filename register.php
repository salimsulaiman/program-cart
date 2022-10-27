<?php
    include 'config/connect.php';

    if (isset($_POST['register'])) {
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $cek = mysqli_query($con, "SELECT * FROM user WHERE username = '$username'");
        if (mysqli_num_rows($cek)>0) {
            echo '<script>alert("Username telah digunakan");</script>';
        }
        else{
            $register = mysqli_query($con, "INSERT INTO user VALUE (null,'$username','$password','$name',1)");

            if ($register) {
                echo '<script>alert("Berhasil membuat akun");window.location.href="login.php";</script>';
        }
        }
    }

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <title>EiShopping</title>
</head>

<body class="py-5">
    <div class="container" style="margin-top: 100px; width: 500px;">
        <center><img src="assets/img/shopping-bag-dark.png" alt="" width="100px"></center>
        <h2 class="text-center">Shopping Cart</h2>
        <h4 class="text-center mb-4 color-primary" style="color: #0275db;">Register</h4>
        <form method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    name="name">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Username</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    name="username">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary mx-auto my-2" name="register">Register</button>
            </div>
            <a href="login.php">
                <p class="text-center my-2">Sudah punya akun?</p>
            </a>
        </form>
    </div>
    <?php include 'ui/footer.php' ?>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>