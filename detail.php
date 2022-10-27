<?php
   session_start();
   $level = $_SESSION['level'];
   // cek apakah yang mengakses halaman ini sudah login
   if($_SESSION['level']==""){
       header("location:login.php");
   }
   include 'config/connect.php';
   if (isset($_POST['addcart'])) {
       $id_product = $_POST['id_product'];
       $nm_product = $_POST['nm_product'];
       $img_product = $_POST['img_product'];
       $qty = $_POST['qty'];
       $weight = $_POST['weight'];
       $price = $_POST['price'];
       $total = $qty*$price;
       $id_user = $_SESSION['id_user'];

       $cek = mysqli_query($con, "SELECT * FROM product WHERE id_product = '$id_product'");
       $get_var = mysqli_fetch_assoc($cek);
       if ($qty > $get_var['qty']) {
           echo '<script>alert("Stock tidak mencukupi ");</script>';
       }
       else {
           $get_varCart = mysqli_query($con, "SELECT * FROM cart WHERE id_product = '$id_product' and stat = '0' and id_user = '$id_user'");
           $a = mysqli_fetch_assoc($get_varCart);
           $qtyBefore = $a['qty'];
           $weightFormCart = $a['weight'];
           $weightTotal = $qty * $weight;
           $weightAfter = $weightFormCart + $weightTotal;

           if (mysqli_num_rows($get_varCart)>0) {
               $qtyNow = $qtyBefore + $qty;
               $priceNow = $price * $qtyNow;
               $addcart = mysqli_query($con, "UPDATE cart set qty = '$qtyNow', price = '$priceNow', weight = '$weightAfter' WHERE id_product = '$id_product' and stat = '0' and id_user = '$id_user'");   
               if ($addcart) {
                   $stockproduct = $get_var['qty'] - $qty;
                   $update = mysqli_query($con, "UPDATE product SET qty = '$stockproduct' WHERE id_product = '$id_product'");
                   echo '<script>alert("Berhasil menambah stock");window.location.href="index.php";</script>';
               }
               else{
                   echo '<script>alert("Gagal menambahkan Stock");window.location.href="index.php";</script>';
               }   
               
           }
           else{
               $addcart = mysqli_query($con, "INSERT INTO cart VALUE ('','$id_user','$id_product','$nm_product','$img_product','$qty', '$weightTotal',0,'$total')");
               if ($addcart) {
                   $stockproduct = $get_var['qty'] - $qty;
                   $update = mysqli_query($con, "UPDATE product SET qty = '$stockproduct' WHERE id_product = '$id_product'");
                   echo '<script>alert("Berhasil menambahkan ke keranjang");window.location.href="index.php";</script>';
               }
               else{
                   echo '<script>alert("Gagal menambahkan ke keranjang");window.location.href="index.php";</script>';
               }   
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
    <link rel="stylesheet" href="style/style.css">

    <title>EiShopping</title>
</head>

<body>
    <?php include 'ui/navbar.php' ?>
    <div class="container" style="margin-top: 150px;">
        <?php
            include 'config/connect.php';
            $id = $_GET['id'];
            $get = mysqli_query($con,"SELECT * FROM product WHERE id_product = '$id'");
            $a = mysqli_fetch_assoc($get);
        ?>
        <div class="row justify-content-center align-midle">
            <div class="col-md-6 my-3">
                <img src="assets/img/<?php echo $a['img_product'] ?>" alt="">
            </div>
            <div class="col-md-6 my-3">
                <h3><?php echo $a['nm_product'] ?></h3>
                <p><?php echo $a['description'] ?>
                </p>
                <p class="text-muted">Weight : <?php echo $a['weight'] ?> g</p>
                <h3>Rp. <?php echo $a['price'] ?></h3>
                <h6 class="text-muted">Stok Ready : <?php echo $a['qty'] ?></h6>
                <div class="d-grid">
                    <button class="btn btn-outline-primary bi bi-cart2" type="button" data-bs-toggle="modal"
                        data-bs-target="#addcart<?php echo $id ?>"></button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal-cart -->
    <div class="modal fade text-center" id="addcart<?php echo $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo $a['nm_product'] ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Quantitiy</label>
                            <input type="hidden" value="<?php echo $a['id_product'] ?>" name="id_product">
                            <input type="hidden" value="<?php echo $a['nm_product'] ?>" name="nm_product">
                            <input type="hidden" value="<?php echo $a['img_product'] ?>" name="img_product">
                            <input type="hidden" value="<?php echo $a['price'] ?>" name="price">
                            <input type="hidden" value="<?php echo $a['weight'] ?>" name="weight">
                            <input type="number" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" name="qty" required>
                            <div id="emailHelp" class="form-text">Stok Ready : <?php echo $a['qty'] ?>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="addcart">Add to
                            Cart</button>
                    </div>
                </form>
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