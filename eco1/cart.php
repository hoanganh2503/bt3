<?php
include('./includes/connect.php');
include('./functions/common_functions.php');
session_start();
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
if ($user_id == null) {
    echo "<script>alert('Bạn chưa tiến hành đăng nhập.');</script>";
    echo "<script>window.location.href = 'user_login.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce Cart Details Page</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.css" />
    <link rel="stylesheet" href="./assets/css/main.css" />
</head>

<body>
    <?php
    include('header.php');
    ?>
    <!-- Start Table Section -->
    <div class="landing">
        <div class="container">
            <div class="row py-5 m-0">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <table class="table table-bordered table-hover table-striped table-group-divider text-center">

                        <!-- display data in cart  -->
                        <?php
                        $total_price = 0;
                        $cart_query = "SELECT * FROM `cart` WHERE user_id='$user_id'";
                        $cart_result = mysqli_query($con, $cart_query);
                        $result_count = mysqli_num_rows($cart_result);
                        if ($result_count > 0) {
                            echo "
                                <thead>
                                    <tr class='d-flex flex-column d-md-table-row '>
                                        <th>Tên sản phẩm</th>
                                        <th>Hình ảnh</th>
                                        <th>Số lượng</th>
                                        <th>Giá</th>
                                        <th colspan='2'>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                ";
                            while ($row = mysqli_fetch_array($cart_result)) {
                                $product_id = $row['product_id'];
                                $product_amount = $row['amount'];
                                $select_product_query = "SELECT * FROM `products` WHERE id=$product_id";
                                $select_product_result = mysqli_query($con, $select_product_query);
                                while ($row_product_price = mysqli_fetch_array($select_product_result)) {
                                    $product_price = array($row_product_price['selling_price']);
                                    $price_table = $row_product_price['selling_price'];
                                    $product_id = $row_product_price['id'];
                                    $product_title = $row_product_price['name'];
                                    $product_images = explode( ',', $row_product_price['image']);
                                    $product_image_one = $product_images[0];
                                    $product_values = array_sum($product_price);
                                    $total_price += $product_values * $product_amount;
                        ?>
                                    <tr class="d-flex flex-column d-md-table-row ">
                                        <td>
                                            <?php echo $product_title; ?>
                                        </td>
                                        <td><img src="./admin/product_images/<?php echo $product_image_one; ?>" class="img-thumbnail" alt="<?php echo $product_title; ?>"></td>
                                        <td>
                                            <input type="number" value="<?php echo $product_amount?>" class="form-control w-50 mx-auto" min="1" name="qty_<?php echo $product_id; ?>">
                                        </td>
                                        <?php
                                        if (isset($_POST['update_cart'])) {
                                            $itemsOfProduct = 'qty_' . $product_id;
                                            $quantities = $_POST[$itemsOfProduct];
                                            if (!empty($quantities)) {
                                                $update_cart_query = "UPDATE `cart` SET amount = $quantities WHERE user_id='$user_id' AND product_id=$product_id;";
                                                $update_cart_result = mysqli_query($con, $update_cart_query);
                                            }
                                            echo "<script>window.open('cart.php','_self');</script>";
                                        }
                                        ?>
                                        <td>
                                            <?php echo $price_table; ?>
                                        </td>
                                        <td>
                                            <input type="submit" value="Cập nhật" class="btn btn-dark" name="update_cart">
                                        </td>
                                        <td>
                                            <input type="submit" value="Xóa" class="btn btn-primary" name="remove_cart">
                                            <input type="text" class="d-none" name="removeitem" value="<?php echo $product_id?>">
                                        </td>
                                    </tr>
                        <?php   }
                            }
                        }else{
                            echo "<h2 class='text-center text-danger'>Giỏ hàng trống</h2>";
                        }
                        ?>
                        </tbody>
                    </table>
                    <!-- SubTotal -->
                    <div class="d-flex align-items-center gap-4 flex-wrap">
                        <?php
                        $cart_query = "SELECT * FROM `cart` WHERE user_id='$user_id'";
                        $cart_result = mysqli_query($con, $cart_query);
                        $result_count = mysqli_num_rows($cart_result);
                        if ($result_count > 0) {
                            echo "
                        <h4>Tổng tiền: <strong class='text-2'> $total_price</strong></h4>
                        <input type='submit' value='Tiếp tục mua sắm' class='btn btn-dark' name='continue_shopping'>
                        ";
                        }else{
                            echo "<input type='submit' value='Tiếp tục mua sắm' class='btn btn-dark' name='continue_shopping'>";
                        }
                        if(isset($_POST['continue_shopping'])){
                            echo "<script>window.open('products.php','_self');</script>";
                        }
                        ?>
                    </div>
                    <!-- SubTotal -->
                </form>
                <!-- function to remove items  -->
                <?php
                function remove_cart_item()
                {
                    global $con;
                    if (isset($_POST['remove_cart'])) {
                        $remove_id = $_POST['removeitem'];
                            $delete_query = "DELETE FROM `cart` WHERE product_id=$remove_id";
                            $delete_run_result = mysqli_query($con, $delete_query);
                            if ($delete_run_result) {
                                echo "<script>alert('Xóa sản phẩm khỏi giỏ hàng thành công.')</script>";
                                echo "<script>window.open('cart.php','_self');</script>";
                            }
                    }
                }
                echo $remove_item = remove_cart_item();
                ?>
                <!-- function to remove items  -->
            </div>
        </div>
        <!-- put it here -->
    </div>
    <?php
        include('footer.php');
    ?>
    <script src="./assets//js/bootstrap.bundle.js"></script>
</body>

</html>