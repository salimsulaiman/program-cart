<?php
    session_start();
    $level = $_SESSION['level'];
    // cek apakah yang mengakses halaman ini sudah login
    if($_SESSION['level']==""){
        header("location:login.php");
    }
    include 'config/connect.php';
    if (isset($_POST['order'])) {
        $id_user = $_POST['id_user'];
        $nama_user = $_POST['nm_user'];
        $nama_product = $_POST['nm_product'];
        $total_hrg = $_POST['totalHarga'];
        $nama_kota = $_POST['nm_kota'];
        $nama_provinsi = $_POST['nm_provinsi'];
        $kode_pos = $_POST['kode_pos'];
        $alamat = $nama_kota . ", " . $kode_pos . ", " . $nama_provinsi;
        $ekspedisi = $_POST['nm_ekspedisi'];
        $estimasi = $_POST['estimasi'];
        $ongkir = $_POST['ongkir'];

        
        $order = mysqli_query($con, "UPDATE cart SET stat = 1 WHERE id_user = '$id_user'");
        if ($order) {
            $addOrder = mysqli_query($con,"INSERT INTO `order`(`id_order`, `nama_user`, `nama_produk`, `total_hrg`, `alamat`, `ekspedisi`, `estimasi`, `ongkir`, `tgl_order`) VALUES (null,'$nama_user','$nama_product','$total_hrg','$alamat','$ekspedisi','$estimasi','$ongkir',NOW())");
            if ($order) {
                echo '<script>window.location.href="order.php";</script>';   
            }
            else {
                echo '<script>alert("Gagal")</script>';
            }

        }
        else {
            echo '<script>alert("error");window.location.href="order.php";</script>';
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
    <div class="container" style="margin-top: 100px;">
        <h3>Keranjang anda</h3>
        <table class="table">
            <tbody>
                <?php
                    include 'config/connect.php';
                    $id_user = $_SESSION['id_user'];
                    $no = 1;
                    $get = mysqli_query($con,"SELECT * FROM cart WHERE id_user = '$id_user' and stat = '0'");
                    while ($productCart = mysqli_fetch_assoc($get)) {
                ?>
                <tr class="align-middle">
                    <th scope="row"><?php echo $no++ ?></th>
                    <td><?php echo $productCart['nm_product'] ?></td>
                    <td><img src="assets/img/<?php echo $productCart['img_product'] ?>" alt="" width="100px"></td>
                    <td><?php echo $productCart['qty'] ?></td>
                    <td><?php echo $productCart['weight'] ?></td>
                    <td>Rp. <?php echo $productCart['price'] ?></td>
                    <td>
                        <a href="deletecart.php?id=<?php echo $productCart['id_cart'] ?>" class="btn-close"></a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <form action="" method="post">
            <div class="row my-4">
                <div class="col-md-3">
                    <label for="">Provinsi</label>
                    <select class="form-select" aria-label="Default select example" name="provinsi" required>
                      
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="">Kota</label>
                    <select class="form-select" aria-label="Default select example" name="kota" required>
            
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="">Ekspedisi</label>
                    <select class="form-select" aria-label="Default select example" name="ekspedisi" required>
            
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="">Paket</label>
                    <select class="form-select" aria-label="Default select example" name="paket" required>
            
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card ms-auto" style="width: 18rem;">
                        <div class="card-body">
                            <?php
                                include 'config/connect.php';
                                $getdatauser = mysqli_query($con,"SELECT * FROM user WHERE id_user = '$id_user'");
                                $user = mysqli_fetch_assoc($getdatauser);
                                $nama_user = $user['nama'];
                                $getdatacart = mysqli_query($con, "SELECT * FROM cart WHERE id_user = '$id_user' and stat = 0");
                                $result = mysqli_query($con,"select * from cart WHERE id_user = '$id_user' and stat = 0");
                                $datacart = mysqli_fetch_assoc($getdatacart);
                                $showtotal = mysqli_query($con,"SELECT SUM(price) AS totalPrice FROM cart WHERE id_user = '$id_user' and stat = 0");
                                $showweight = mysqli_query($con,"SELECT SUM(weight) AS totalWeight FROM cart WHERE id_user = '$id_user' and stat = 0");
                                $a = mysqli_fetch_assoc($showtotal);
                                $b = mysqli_fetch_assoc($showweight);
                                $totalWeight = $b['totalWeight'];
                                $datas = array();
                                if (mysqli_num_rows($result)>0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $datas[] = $row;
                                    }
                                }

                            ?>
                            <h5 class="card-title text-muted">Total</h5>
                            <h4 class="card-subtitle mb-2 text-center">Rp. <?php echo $a['totalPrice'] ?></h4>
                                <div class="d-grid">
                                    <input type="hidden" value="<?php echo $datacart['id_user'] ?>" name="id_user">
                                    <input type="hidden" value="<?php echo $datacart['qty'] ?>" name="qty">
                                    <input type="hidden" value="<?= $totalWeight; ?>" name="berat">
                                    <input type="hidden" value="<?php  
                                    foreach ($datas as $data){
                                    echo $data['nm_product'].", ";
                                    } ?>" name="nm_product">
                                    <input type="hidden" name="totalHarga" value="<?php echo $a['totalPrice'] ?>">
                                    <input type="hidden" name="nm_user" value="<?php echo $nama_user ?>">
                                    <input type="hidden" name="nm_provinsi">
                                    <input type="hidden" name="nm_kota">
                                    <input type="hidden" name="tipe" id="">
                                    <input type="hidden" name="kode_pos">
                                    <input type="hidden" name="nm_ekspedisi">
                                    <input type="hidden" name="nm_paket">
                                    <input type="hidden" name="ongkir">
                                    <input type="hidden" name="estimasi">
                                    <button type="submit" name="order" class="btn btn-outline-primary">Check out</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </div>
    <?php include 'ui/footer.php' ?>



    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $.ajax({
                type:'post',
                url:'dataProvinsi.php',
                success:function(hasil_provinsi){
                   $("select[name=provinsi]").html(hasil_provinsi);
                }
            });
            $("select[name=provinsi]").on("change",function(){
                //ambil id provinsi yang dipilih dri atribut id_provinsi(buatan)
                var selectedProvinceId = $("option:selected",this).attr("id_provinsi");
                $.ajax({
                    type:'post',
                    url:'dataKota.php',
                    data:'id_provinsi='+selectedProvinceId,
                    success:function(hasil_kota){
                        $("select[name=kota]").html(hasil_kota);
                    }
                })
            });
            $.ajax({
                type:'post',
                url:'dataEkspedisi.php',
                success:function(hasil_ekspedisi){
                    $("select[name=ekspedisi]").html(hasil_ekspedisi);
                }
            })
            $("select[name=ekspedisi]").on("change",function(){
                // mendapatkan data ongkos kirim

                // mendapatkan ekspedisi yang dipilih
                var ekspedisi_terpilih = $("select[name=ekspedisi]").val();
                // mendapatkan id kota yang dipilih pengguna
                var kota_terpilih = $("option:selected", "select[name=kota]").attr("id_distrik");
                // mendapatkan total_berat dri inputan
                var total_berat = $("input[name = berat]").val();
                $.ajax({
                    type:'post',
                    url:'dataPaket.php',
                    data:'ekspedisi='+ekspedisi_terpilih+'&kota='+kota_terpilih+'&berat='+total_berat,
                    success:function(hasil_paket){
                        // console.log(hasil_paket);
                        $("select[name=paket]").html(hasil_paket);

                        // letakan nama ekspedisi terpilih di input ekspedisi
                        $("input[name=nm_ekspedisi]").val(ekspedisi_terpilih);
                    }
                })
            });
            $("select[name=kota]").on("change",function(){
                var prov = $("option:selected",this).attr("nama_provinsi");
                var dist = $("option:selected",this).attr("nama_kota");
                var tipe = $("option:selected",this).attr("tipe_distrik");
                var kodepos = $("option:selected",this).attr("kodepos");

                $("input[name=nm_provinsi]").val(prov);
                $("input[name=nm_kota]").val(dist);
                $("input[name=tipe]").val(tipe);
                $("input[name=kode_pos]").val(kodepos);
            })
            $("select[name=paket]").on("change",function(){
                var paket = $("option:selected",this).attr("paket");
                var ongkir = $("option:selected",this).attr("ongkir");
                var etd = $("option:selected",this).attr("etd");

                $("input[name=nm_paket]").val(paket);
                $("input[name=ongkir]").val(ongkir);
                $("input[name=estimasi]").val(etd);
            })
        });
    </script>
</body>

</html>