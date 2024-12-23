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
    <title>Chi tiết sản phẩm</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.css" />
    <link rel="stylesheet" href="./assets/css/main.css" />
</head>

<body>
    <?php
        include('header.php');
    ?>

    <div class="prod-details">
        <div class="container">
            <div class="sub-container pt-4 pb-4">

                <?php
                viewDetails();
                ?>
            </div>
        </div>
    </div>

    <div class="products">
        <div class="container">
            <div class="categ-header">
                <div class="sub-title">
                    <span class="shape"></span>
                    <span class="title">Sản phẩm liên quan
                    </span>
                </div>
                <h2>Khám phá thêm sản phẩm
                </h2>
            </div>
            <div class="row mb-3">
                <?php
                getProduct(3);
                cart();
                ?>
            </div>
            <div class="view d-flex justify-content-center align-items-center">
                <button onclick="location.href='./products.php'">Xem thêm sản phẩm</button>
            </div>
        </div>
    </div>

    <?php
    include('footer.php');
    ?>
    <script src="./assets//js/bootstrap.bundle.js"></script>
    <script src="./assets//js/script.js"></script>
</body>

</html>