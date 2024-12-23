<?php
include('../includes/connect.php'); 

if (isset($_GET['id'])) {
    $delete_id = $_GET['id'];
    
    $delete_query = "DELETE FROM `products` WHERE id = $delete_id";
    $delete_result = mysqli_query($con, $delete_query);

    if (!$delete_result) {
        echo "<script>alert('Lỗi khi xóa sản phẩm.');</script>";
    }else{
        echo "<script>window.open('view_products.php', '_self');</script>";
    }
} else {
    echo "<script>alert('Không tìm thấy sản phẩm để xóa.');</script>";
    echo "<script>window.open('index.php?view_products', '_self');</script>";
}
?>
