<?php
include('../includes/connect.php');
$response = [];

try {
    if (isset($_POST['ids']) && is_array($_POST['ids']) && count($_POST['ids']) > 0) {
        $product_id = $_POST['ids'];
        $product_id = array_unique($product_id);
        $product_ids = implode(',', $product_id); 
        $start_time = $_POST['start_time'];
        $end_time = $_POST['end_time'];

    } else {
        throw new Exception('Vui lòng chọn ít nhất một sản phẩm.');
    }

    if (empty($_POST['start_time']) || empty($_POST['end_time'])) {
        throw new Exception('Thời gian bắt đầu và kết thúc không được để trống.');
    }
    

    if (empty($_POST['percent']) || !is_numeric($_POST['percent']) || $_POST['percent'] < 0 || $_POST['percent'] > 100) {
        throw new Exception('Giá trị khuyến mãi phải là số trong khoảng 0-100.');
    }

    $percent = $_POST['percent'];

    $checkQuery = "SELECT * FROM flashsale";
    $checkResult = mysqli_query($con, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        $updateQuery = "UPDATE flashsale SET start_time = '$start_time', end_time = '$end_time', percent = '$percent', product_id = '$product_ids' ";
        if (!mysqli_query($con, $updateQuery)) {
            throw new Exception('Cập nhật flashsale không thành công.');
        }
    } else {
        $insertQuery = "INSERT INTO flashsale (product_id, start_time, end_time, percent) VALUES ('$product_ids', '$start_time', '$end_time', '$percent')";
        if (!mysqli_query($con, $insertQuery)) {
            throw new Exception('Thêm mới flashsale không thành công.');
        }
    }

    $response = ['status' => 'success', 'message' => 'Cập nhật chương trình khuyến mãi thành công.'];

} catch (Exception $e) {
    $response = ['status' => 'error', 'message' => $e->getMessage()];
}

echo json_encode($response);
exit;
?>
