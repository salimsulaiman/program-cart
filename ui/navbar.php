<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <img src="assets/img/shopping-bag.png" alt="" width="30" class="d-inline-block align-text-top">
            Shopping Cart
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page"
                        href="<?php echo $level==1 ? 'index.php' : 'product.php' ?>">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="cart.php"
                        style="<?php echo $level==1 ? 'display : block' : 'display : none' ?>"><i
                            class="bi bi-cart2"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="order.php"
                        style="<?php echo $level==1 ? 'display : block' : 'display : none' ?>"><i
                            class="bi bi-truck"></i></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $_SESSION['nama'] ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <!-- <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li> -->
                        <!-- <li>
                            <hr class="dropdown-divider">
                        </li> -->
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>