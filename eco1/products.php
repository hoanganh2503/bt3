<?php
include("./includes/connect.php");
include("./functions/common_functions.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce Products</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.css" />
    <link rel="stylesheet" href="./assets/css/main.css" />
</head>

<body>
    <?php
        include('header.php');
    ?>
    <div class="all-prod">
        <div class="container">
            <div class="sub-container pt-4 pb-4">
                <div class="row mx-0">
                    <div class="col-md-2 side-nav p-0">
                        <ul class="navbar-nav me-auto ">
                            <li class="nav-item d-flex align-items-center gap-2">
                                <span class="shape"></span>
                                <a href="products.php" class="nav-link fw-bolder nav-title">
                                    <h4>Categories</h4>
                                </a>
                            </li>
                            <?php
                            getCategories();
                            ?>

                        </ul>

                    </div>
                    <div class="col-md-10">
                        <div class="row">
                            <?php
                            getProduct();
                            cart();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        include('footer.php');
    ?>

    <script src="./assets//js/bootstrap.bundle.js"></script>
</body>

</html>