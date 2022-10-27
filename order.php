<?php
    // error_reporting(0);
    // ini_set('display_errors', 0);
    function price($number){
        $price = "Rp " . number_format($number,2,',','.');
        return $price;
    }
     session_start();
     $level = $_SESSION['level'];
     // cek apakah yang mengakses halaman ini sudah login
     if($_SESSION['level']==""){
         header("location:login.php");
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

<body>
    <?php include 'ui/navbar.php' ?>
    <div class="container" style="margin-top: 100px;">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Terimakasih, </strong> Produk anda akan kami siapkan.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <h3>Pesanan anda</h3>
        <table class="table">
            <tbody>
                <?php
                    include 'config/connect.php';
                    $id_user = $_SESSION['id_user'];
                    $nama_user = $_SESSION['nama'];
                    $no = 1;
                    $get = mysqli_query($con,"SELECT * FROM `order` WHERE nama_user = '$nama_user'");
                    while ($a = mysqli_fetch_assoc($get)) {
                ?>
                <tr class="align-middle">
                    <th scope="row"><?php echo $no++ ?></th>
                    <td><?php echo $a['nama_user'] ?></td>
                    <td><?php echo $a['alamat'] ?></td>
                    <td><?php echo $a['nama_produk'] ?></td>
                    <td><?php echo $a['total_hrg'] ?></td>
                    <td><?php echo $a['ekspedisi'] ?></td>
                    <td><?php echo $a['estimasi'] ?></td>
                    <td><?php echo $a['ongkir'] ?></td>
                    <td><?php echo $a['tgl_order'] ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="row">
            <div class="col">
                <div class="card ms-auto" style="width: 18rem;">
                    <div class="card-body">
                        <?php
                            include 'config/connect.php';
                            $getdatauser = mysqli_query($con, "SELECT * FROM user WHERE id_user = '$id_user'");
                            $datauser = mysqli_fetch_assoc($getdatauser);
                            $getdatacart = mysqli_query($con, "SELECT * FROM `order` WHERE nama_user = '$nama_user'");
                            $datacart = mysqli_fetch_assoc($getdatacart);
                            $showtotal = mysqli_query($con,"SELECT SUM(total_hrg) AS totalPrice FROM `order` WHERE `nama_user` = '$nama_user'");
                            $getdataTotal = mysqli_fetch_assoc($showtotal);
                            $getTotal = $getdataTotal['totalPrice'];
                            $showtotalongkir = mysqli_query($con,"SELECT SUM(ongkir) AS totalongkir FROM `order` WHERE `nama_user` = '$nama_user'");
                            $getdataongkir = mysqli_fetch_assoc($showtotalongkir);
                            $getOngkir = $getdataongkir['totalongkir'];
                            $total = $getTotal + $getOngkir;
                        ?>
                        <h5 class="card-title text-muted">Total</h5>
                        <h4 class="card-subtitle mb-2 text-center"><?php echo price($total) ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'ui/footer.php' ?>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>