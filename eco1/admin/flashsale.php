<?php
include('../includes/connect.php');

$query = "SELECT id, name, image, selling_price FROM products";
$result = mysqli_query($con, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($con));
}

$query_flashsale = "select * from flashsale";
$flashsale_result = mysqli_query($con, $query_flashsale);
$flashsale = mysqli_fetch_array($flashsale_result);
$start_time = isset($flashsale['start_time']) ? $flashsale['start_time'] : '';
$end_time = isset($flashsale['end_time']) ? $flashsale['end_time'] : '';
$percent = isset($flashsale['percent']) ? $flashsale['percent'] : '';
$product_id = isset($flashsale['product_id']) ? $flashsale['product_id'] : '';
$product_ids = explode(',', $product_id);
$product_ids_str = implode(',', array_map('intval', $product_ids));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css" />
    <link rel="stylesheet" href="../assets/css/main.css" />
</head>
<style>
        #sidebar{
            height: auto !important;
        }
</style>
<body>
    <div class="wrapper">
        <?php
        include('./sidebar.php');
        ?>
        <div id="wrapper" class="w-100">
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    
                    <?php
                    include('./header.php');
                    ?>
                    
                    <div class="container row">
                        <div class="categ-header">
                            <div class="sub-title">
                                <span class="shape"></span>
                                <h2>Flash sale</h2>
                            </div>
                        </div>
                        <form id="flashsaleForm" class="row">
                            <div class="col-6">
                                <select class="form-select" aria-label="Chọn sản phẩm" id="productSelect">
                                    <option selected>Chọn sản phẩm</option>
                                    <?php
                                    // Lặp qua các sản phẩm và thêm chúng vào dropdown
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $productName = $row['name'];
                                        $productImage = $row['image'];
                                        $productImages = explode(',', $productImage);
                                        $productImage = $productImages[0];
                                        $productPrice = $row['selling_price'];
                                        $productId = $row['id'];
                                        // Thêm sản phẩm vào thẻ <select>
                                        echo '<option value="' . $row['id'] . '" data-name="' . $productName . '" data-image="./product_images/'. $productImage . '" data-price="' . $productPrice . '" data-id="' . $productId . '" >
                                                ' . $productName . '
                                            </option>';
                                    }
                                    ?>
                                </select>
                                <div class="row mt-4">
                                    <div class="col-6">
                                        <label for="productTime">Thời gian bắt đầu:</label>
                                        <input value="<?php echo $start_time?>" type="datetime-local" name="start_time" class="form-control" id="productTime">
                                    </div>
                                    <div class="col-6">
                                        <label for="productTime">Thời gian kết thúc:</label>
                                        <input value="<?php echo $end_time?>" type="datetime-local" name="end_time" class="form-control" id="productTime">
                                    </div>
                                </div>
                                <label for="productTime" class="mt-4">Giá trị khuyến mãi(%)</label>
                                <input value="<?php echo $percent?>" type="number" name="percent" class="form-control" id="productTime">
                                <div class="col-12 mt-3">
                                <input type="submit" value="Lưu" class="btn btn-primary">
                                </div>
                                
                            </div>
                            <div class="col-6">
                                <div id="productInfo" class="row">
                                    <h3>Các sản phẩm khuyến mãi.</h3>
                                    <?php
                                    $query = "SELECT id, name, image, selling_price FROM products WHERE id IN ($product_ids_str)";
                                    $result = mysqli_query($con, $query);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $productName = $row['name'];
                                            $productImage = $row['image'];
                                            $productImages = explode(',', $productImage);
                                            $productImage = $productImages[0];
                                            $productPrice = $row['selling_price'];
                                            $productId = $row['id'];
                                    
                                            // Hiển thị thông tin sản phẩm
                                            echo '
                                            <div class="product-info col-12 d-flex justify-content-between mt-4">
                                                <div class="d-flex">
                                                    <img src="./product_images/' . $productImage . '" alt="' . $productName . '" width="100" height="100">
                                                    <div class="ms-3">
                                                        <h5>Tên sản phẩm: ' . $productName . '</h5>
                                                        <p><strong>Giá bán: </strong>' . number_format($productPrice, 0, ',', '.') . ' VND</p>
                                                    </div>
                                                </div>
                                                <button style="width: 30px; height: 30px" class="btn btn-danger btn-sm" onclick="removeProductInfo(this)">X</button>
                                                <input type="hidden" name="ids[]" value="' . $productId . '" >
                                            </div>';
                                        }
                                    } 
                                    ?>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="flashMessage" style="position: fixed; top: 20px; right: 20px; z-index: 9999;"></div>

</body>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<script>
    document.getElementById('productSelect').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var productName = selectedOption.getAttribute('data-name');
        var productImage = selectedOption.getAttribute('data-image');
        var productPrice = selectedOption.getAttribute('data-price');
        var productid = selectedOption.getAttribute('data-id');

        var productInfoDiv = document.getElementById('productInfo');
        let addedProductIds = [];

        if (productName && !addedProductIds.includes(productid)) {
            var newProductInfo = `
            <div class="product-info col-12 d-flex justify-content-between mt-4">
                <div class="d-flex">            
                    <img src="${productImage}" alt="${productName}" width="100" height="100">
                    <div class="ms-3">
                        <h5>Tên sản phẩm: ${productName}</h5>
                        <p><strong>Giá bán: </strong>${productid} VND</p>
                    </div>
                </div>
                <button style="width: 30px; height: 30px" class="btn btn-danger btn-sm" onclick="removeProductInfo(this)">X</button>
                <input type="hidden" name="ids[]" value="${productid}" >
            </div>
            `;

            productInfoDiv.innerHTML += newProductInfo;

            addedProductIds.push(productid);
        }
    });

    function removeProductInfo(button) {
    var productInfoDiv = button.closest('.product-info');
    if (productInfoDiv) {
        productInfoDiv.remove();
    }
}
</script>
<script>
    $(document).ready(function () {
    $('#flashsaleForm').on('submit', function (e) {        
        e.preventDefault();
        
        let formData = new FormData(this);
        console.log(formData);
        
        
        $.ajax({
            url: 'add_flashsale.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {    
                console.log(response);
                            
                response = JSON.parse(response);
                console.log(123);
                                
                if (response.status === 'success') {
                    $('#flashMessage').html(
                        `<div class="alert alert-success">${response.message}</div>`
                    ).fadeIn();
                    
                    setTimeout(() => {
                        $('#flashMessage').fadeOut();
                    }, 5000);

                } else {
                    $('#flashMessage').html(
                        `<div class="alert alert-danger">${response.message}</div>`
                    ).fadeIn(); 
                    
                    setTimeout(() => {
                        $('#flashMessage').fadeOut();
                    }, 5000);
                }

            },
            error: function () {
                $('#responseMessage').html(
                    `<div class="alert alert-danger">Có lỗi xảy ra, vui lòng thử lại.</div>`
                );
            },
        });
    });
});
</script>
</html>
