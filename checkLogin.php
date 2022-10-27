<?php
session_start();

include 'config/connect.php';

$username = $_POST['username'];
$password = md5($_POST['password']);

$login = mysqli_query($con, "SELECT * FROM user WHERE username = '$username' AND password = '$password'");

if (mysqli_num_rows($login)>0) {
    $data = mysqli_fetch_assoc($login);

    if ($data['level']==1) {
        $_SESSION['username'] = $username;
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['level'] = $data['level'];

        // mengalihkan ke halaman dengan level user
        header("location:index.php");

    }

    elseif ($data['level']==0) {
        $_SESSION['username'] = $username;
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['level'] = $data['level'];

         // mengalihkan ke halaman dengan level user
         header("location:product.php");
    }
    else {
        header("location:login.php?pesan=gagal");
    }
}
else {
    header("location:login.php?pesan=gagal");
}
?>