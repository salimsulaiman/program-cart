<?php
    include 'config/connect.php';
    $id = $_GET['id'];

    $get_var = mysqli_query($con, "SELECT * FROM cart WHERE id_cart = '$id' and stat = 0");
    $a = mysqli_fetch_assoc($get_var);
    $id_product = $a['id_product'];
    $qtyCart = $a['qty'];

    $get_var_product = mysqli_query($con, "SELECT * FROM product WHERE id_product = '$id_product'");
    $b = mysqli_fetch_assoc($get_var_product);
    $qtyProduct = $b['qty'];

    $qty_productNow = $qtyCart + $qtyProduct;

    $update = mysqli_query($con, "UPDATE product set qty = '$qty_productNow' WHERE id_product = '$id_product'");
    if ($update) {
        $delete = mysqli_query($con, "DELETE FROM cart WHERE id_cart = '$id'");
        if ($delete) {
            echo '<script>window.location.href="cart.php";</script>';
        }
    }

?>