<?php
    function price($number){
        $price = "Rp " . number_format($number,2,',','.');
        return $price;
    }
    session_start();
    $level = $_SESSION['level'];
    include 'config/connect.php';
    if($_SESSION['level']==""){
        header("location:login.php");
    }
    else if($_SESSION['level']=="1"){
        header("location:index.php");
    }
    // else if($_SESSION['level']==1){
    //     header("location:../login.php");
    // }

    //add product
    if (isset($_POST['addProduct'])) {

        //image
        $extension_format = array('png','jpg','jpeg');
        $name = $_FILES['img_product']['name'];
        $x = explode('.', $name);
        $extension = strtolower(end($x));
        $size	= $_FILES['img_product']['size'];
        $file_tmp = $_FILES['img_product']['tmp_name'];	

        $nm_product = $_POST['nm_product'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $qty = $_POST['qty'];
        $weight = $_POST['weight'];
        if (in_array($extension,$extension_format)==true) {
            if ($size < 1044070) {
                move_uploaded_file($file_tmp, 'assets/img/'.$name);
                $add = mysqli_query($con, "INSERT INTO product VALUE (null, '$nm_product', '$description','$name','$price','$qty','$weight')");
                if ($add) {
                    echo '<script>alert("Product berhasil ditambahkan")</script>';
                }
                else {
                    echo '<script>alert("Product gagal ditambahkan")</script>';
                }
            }
            else {
                echo '<script>alert("Ukuran foto terlalu besar")</script>';
            }
        }
        else {
            echo '<script>alert("Harap upload foto dengan ekstensi png, jpg, ataupun jpeg")</script>';
        }
    }

    //edit product
    if (isset($_POST['editProduct'])) {

        //image
        $extension_format = array('png','jpg','jpeg');
        $name = $_FILES['img_product']['name'];
        $x = explode('.', $name);
        $extension = strtolower(end($x));
        $size	= $_FILES['img_product']['size'];
        $file_tmp = $_FILES['img_product']['tmp_name'];	

        $id_product = $_POST['id_product'];
        $nm_product = $_POST['nm_product'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $qty = $_POST['qty'];
        $weight = $_POST['weight'];
        if (in_array($extension,$extension_format)==true) {
            if ($size < 1044070) {
                move_uploaded_file($file_tmp, 'assets/img/'.$name);
                $edit = mysqli_query($con, "UPDATE product SET nm_product = '$nm_product', description = '$description', img_product = '$name', price = '$price', qty = '$qty', weight = '$weight' WHERE id_product = '$id_product'");
                if ($edit) {
                    $editChart =  mysqli_query($con, "UPDATE cart SET nm_product = '$nm_product', img_product = '$name' WHERE id_product = '$id_product'");
                    echo '<script>alert("Product berhasil diedit")</script>';
                }
                else {
                    echo '<script>alert("Product gagal diedit")</script>';
                }
            }
            else {
                echo '<script>alert("Ukuran foto terlalu besar")</script>';
            }
        }
        else {
            echo '<script>alert("Harap upload foto dengan ekstensi png, jpg, ataupun jpeg")</script>';
        }
    }

    //delete product
    if (isset($_POST['deleteProduct'])) {
        $id_product = $_POST['id_product'];

        $delete = mysqli_query($con, "DELETE FROM product WHERE id_product = '$id_product'");
        if ($delete) {
            echo '<script>alert("Product berhasil dihapus")</script>';
        }
        else{
            echo '<script>alert("Product gagal dihapus")</script>';
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

<body>
    <?php include 'ui/navbar.php' ?>
    <div class="container" style="margin-top: 100px;">
        <button class="btn btn-outline-primary my-3" type="button" data-bs-toggle="modal"
            data-bs-target="#addProduct">Add Product</button>
        <!-- Modal add -->
        <div class="modal fade" id="addProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Product
                                    Name</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="nm_product">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                    name="description"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Product Image</label>
                                <input class="form-control" type="file" id="formFile" name="img_product">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Price</label>
                                <input type="int" class="form-control" id="exampleFormControlInput1" name="price">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Quantity</label>
                                <input type="number" class="form-control" id="exampleFormControlInput1" name="qty">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Weight (gram)</label>
                                <input type="number" class="form-control" id="exampleFormControlInput1" name="weight">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="addProduct">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end modal add -->
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Product Image</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantitiy</th>
                    <th scope="col">Weight</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include 'config/connect.php';
                    $no = 1;
                    $show = mysqli_query($con, "SELECT * FROM product");
                    while ($a = mysqli_fetch_array($show)) {
                        
                ?>
                <tr>
                    <th scope="row"><?php echo $no++; ?></th>
                    <td><?php echo $a['nm_product'] ?></td>
                    <td><?php echo $a['description'] ?></td>
                    <td><img src="assets/img/<?php echo $a['img_product'] ?>" alt="" width="100px"></td>
                    <td><?php echo price($a['price']) ?></td>
                    <td><?php echo $a['qty'] ?></td>
                    <td><?php echo $a['weight'] ?> g</td>
                    <td>
                        <button type="button" data-bs-toggle="modal"
                            data-bs-target="#editProduct<?php echo $a['id_product'] ?>"
                            class="btn btn-outline-success bi bi-pencil"></button>
                        <button type="button" data-bs-toggle="modal"
                            data-bs-target="#deleteProduct<?php echo $a['id_product'] ?>"
                            class="btn btn-outline-danger bi bi-trash"></button>
                    </td>
                    <!-- Modal edit -->
                    <div class="modal fade" id="editProduct<?php echo $a['id_product'] ?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <input type="hidden" value="<?php echo $a['id_product'] ?>" name="id_product">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Product
                                                Name</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                                value="<?php echo $a['nm_product'] ?>" name="nm_product">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1"
                                                class="form-label">Description</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                                name="description"><?php echo $a['description'] ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="formFile" class="form-label">Product Image</label>
                                            <input class="form-control" type="file" id="formFile" name="img_product">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Price</label>
                                            <input type="int" class="form-control" id="exampleFormControlInput1"
                                                value="<?php echo $a['price'] ?>" name="price">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Quantity</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                                value="<?php echo $a['qty'] ?>" name="qty">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Weight (gram)</label>
                                            <input type="number" class="form-control" id="exampleFormControlInput1" name="weight" value="<?php echo $a['weight'] ?>">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="editProduct">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- end modal edit -->
                    <!-- Modal delete -->
                    <div class="modal fade" id="deleteProduct<?php echo $a['id_product'] ?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <input type="hidden" value="<?php echo $a['id_product'] ?>" name="id_product">
                                        <p>Yakin ingin menghapus <?php echo $a['nm_product'] ?>?. </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger"
                                            name="deleteProduct">Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- end modal delete -->
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php include 'ui/footer.php' ?>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>