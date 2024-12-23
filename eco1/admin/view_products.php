<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <link rel="stylesheet" href="../assets/css/main.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css" />
</head>

<body>
    <style>
        #example_info{
            display: none;
        }
        #sidebar{
            height: auto !important;
        }
    </style>
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

                    <div class="container">
                        <div class="categ-header">
                            <div class="sub-title">
                                <span class="shape"></span>
                                <h2>Quản lý sản phẩm</h2>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mb-4">
                            <form id="filterForm">
                                <div class="d-flex align-items-center">
                                    <input 
                                        type="text" 
                                        id="searchQuery" 
                                        name="searchQuery" 
                                        class="form-control me-3" 
                                        style="width: 300px;" 
                                        placeholder="Nhập từ khóa tìm kiếm..."
                                    />
                                    
                                    <select
                                        style="padding: 10px 20px; border: 1px solid #ccc;"
                                        class="rounded me-3"
                                        name="category"
                                        id="category"
                                    >
                                        <option value="0">Tìm kiếm theo danh mục</option>
                                        <?php
                                            $selected_category = isset($_GET['category']) ? $_GET['category'] : 0;

                                            $get_category_query = "SELECT * FROM `categories`";
                                            $get_category_result = mysqli_query($con, $get_category_query);

                                            while ($row_fetch_category = mysqli_fetch_array($get_category_result)) {
                                                $category_id = $row_fetch_category['id'];
                                                $category_title = $row_fetch_category['name'];

                                                $selected = ($category_id == $selected_category) ? "selected" : "";

                                                echo "<option value='$category_id' $selected>$category_title</option>";
                                            }
                                        ?>
                                    </select>

                                    <button type="button" id="searchButton" class="btn btn-premary btn-primary">Tìm kiếm</button>
                                </div>
                            </form>
                            <a href="./insert_product.php">
                                <button type="button" class="btn btn-primary" style="color:#fff">
                                    Thêm sản phẩm
                                </button>
                            </a>
                        </div>
                        <div class="table-data">
                            <table id="example" class="table table-bordered table-hover table-striped text-center w-100">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-center" >STT</th>
                                        <th class="text-center" style="width:20%">Tên sản phẩm</th>
                                        <th class="text-center">Ảnh sản phẩm</th>
                                        <th class="text-center">Giá nhập</th>
                                        <th class="text-center">Giá bán</th>
                                        <th class="text-center">Số lượng</th>
                                        <th class="text-center">Edit</th>
                                        <th class="text-center">Delete</th>
                                    </tr>
                                </thead>
                                <tbody id="products">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
<script>
    getProducts();
    function getProducts() {
        $.ajax({
            url: "get_products.php",
            method: "POST",
            success: function (response) {
                $("#products").html(response);
            },
            error: function (xhr, status, error) {
                console.error("Error: " + error); 
                alert("Có lỗi xảy ra.");
            }
        });
    }                                   

    $(document).ready(function () {
    function filterProducts() {
        let categoryId = $("#category").val();
        let searchQuery = $("#searchQuery").val();

        $.ajax({
            url: "get_products.php",
            method: "POST",
            data: { 
                category: categoryId,
                search: searchQuery
            },
            success: function (response) {
                $("#products").html(response);
            },
            error: function (xhr, status, error) {
                console.error("Error: " + error); 
                alert("Có lỗi xảy ra.");
            }
        });
    }

    // Bấm nút tìm kiếm sẽ kích hoạt tìm kiếm
    $("#searchButton").click(function () {
        filterProducts();
    });

});

</script>

</html>