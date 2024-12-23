<?php
include('./includes/connect.php');
include('./functions/common_functions.php');
session_start();
$query_flashsale = "select * from flashsale";
$flashsale_result = mysqli_query($con, $query_flashsale);
$flashsale = mysqli_fetch_array($flashsale_result);
$percent = isset($flashsale['percent']) ? $flashsale['percent'] : '';
$end_time = isset($flashsale['end_time']) ? $flashsale['end_time'] : '';
$end_time_formatted = date(' H:i:s d/m/Y', strtotime($end_time));
$product_id = isset($flashsale['product_id']) ? $flashsale['product_id'] : '';
$product_ids = explode(',', $product_id);
$product_ids_str = implode(',', array_map('intval', $product_ids));
$query = "SELECT id, name, image, selling_price FROM products WHERE id IN ($product_ids_str)";
$result = mysqli_query($con, $query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce Home Page</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.css" />
    <link rel="stylesheet" href="./assets/css/main.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <?php
        include('header.php');
    ?>

    <div class="landing">
        <div class="container">
            <div class="row m-0">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 p-md-0 tabs-categ">
                    <ul class="p-md-0 d-flex flex-column gap-3 pt-md-3">
                    <?php
                        getCategories();
                    ?>
                    </ul>
                </div>
                <div class="col-lg-9 col-md-9 d-none d-sm-none d-md-block pt-md-4">
                    <div class="cover">
                        <span class="title">Iphone 14 series</span>
                        <span class="desc">Lên đến 10%<br />sản phẩm</span>
                        <a href="product_details.php?product_id=34">Mua ngay</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="category">
        <div class="container">
            <div class="categ-header">
                <div class="sub-title">
                    <span class="shape"></span>
                    <span class="title">Danh mục</span>
                </div>
                <h2>Danh sách danh mục</h2>
            </div>

            <div class="cards">
                <?php
                getCategoriesAndImage();
                ?>
            </div>
        </div>
    </div>
    <div class="products">
        <div class="container">
            <div class="categ-header">
                <div class="sub-title">
                    <span class="shape"></span>
                    <span class="title"> Sản phẩm của chúng tôi</span></span>
                </div>
                <h2>Sản phẩm mới nhất
                </h2>
            </div>
            <div class="row mb-3">
                <?php
                getProduct(4, 3);
                ?>
            </div>
            <div class="view d-flex justify-content-center align-items-center">
                <button onclick="location.href='./products.php'">Xem tất cả sản phẩm</button>
            </div>
        </div>
    </div>

    <div class="products">
        <div class="container">
            <div class="categ-header">
                <div class="sub-title">
                    <span class="shape"></span>
                    <span class="title"> Flash Sale</span></span>
                </div>
                <h2>Giảm giá siêu khủng trong ngày
                </h2>
                <p><strong>Thời gian kết thúc:</strong> <?php echo $end_time_formatted; ?></p>
            </div>
            <div class="row mb-3">
            <div class="container text-center my-3">
            <div class="row mx-auto my-auto justify-content-center">
                <div id="recipeCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                    <?php
                        $first_item = true;
                        
                        while ($row = mysqli_fetch_array($result)) {
                            $product_id = $row['id'];
                            $productName = $row['name'];
                            $product_price = $row['selling_price'];
                            $productImage = $row['image'];
                            $productImages = explode(',', $productImage);
                            $productImage = $productImages[0];
                            
                            $active_class = $first_item ? 'active' : '';
                            $first_item = false;  
                        ?>
                        
                        <div class="carousel-item <?php echo $active_class?>">
                            <div class="col-md-3">
                                <div class="one-card">
                                    <div class="photo">
                                    <img src="./admin/product_images/<?php echo $productImage ?>" alt="<?php echo $productName; ?>">
                                        <button>
                                            <a class="text-light text-decoration-none" href="products.php?add_to_cart=<?php echo $product_id; ?>">Thêm vào giỏ</a>
                                        </button>
                                        <button>
                                            <a class="text-light text-decoration-none" href="product_details.php?product_id=<?php echo $product_id; ?>">Xem thêm</a>
                                        </button>
                                    </div>
                                    <div>
                                    <span class="title fw-bold"><?php echo $productName; ?></span>
                                    <div class="desc">
                                        <span class="text-decoration-line-through"><?php echo number_format($product_price, 0, ',', '.') ?> VNĐ</span>
                                    </div>

                                    <?php 
                                    $new_price = $product_price * (1 - ($percent / 100));
                                    ?>

                                    <div>
                                        <span class="text-danger fw-bold"><?php echo number_format($new_price, 0, ',', '.') ?> VNĐ</span>
                                    </div>

                                </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                    ?>
                    </div>
                    <a class="carousel-control-prev bg-transparent w-aut" href="#recipeCarousel" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    </a>
                    <a class="carousel-control-next bg-transparent w-aut" href="#recipeCarousel" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    </a>
                </div>
            </div>		
	</div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

<style>
    @media (max-width: 767px) {
		.carousel-inner .carousel-item > div {
			display: none;
		}
		.carousel-inner .carousel-item > div:first-child {
			display: block;
		}
	}

	.carousel-inner .carousel-item.active,
	.carousel-inner .carousel-item-next,
	.carousel-inner .carousel-item-prev {
		display: flex;
	}

	/* medium and up screens */
	@media (min-width: 768px) {

		.carousel-inner .carousel-item-end.active,
		.carousel-inner .carousel-item-next {
			transform: translateX(25%);
		}

		.carousel-inner .carousel-item-start.active, 
		.carousel-inner .carousel-item-prev {
			transform: translateX(-25%);
		}
	}

	.carousel-inner .carousel-item-end,
	.carousel-inner .carousel-item-start { 
		transform: translateX(0);
	}
</style>

<script>
    let items = document.querySelectorAll('.carousel .carousel-item')

items.forEach((el) => {
    const minPerSlide = 4
    let next = el.nextElementSibling
    for (var i=1; i<minPerSlide; i++) {
        if (!next) {
    // wrap carousel by using first child
    next = items[0]
}
let cloneChild = next.cloneNode(true)
el.appendChild(cloneChild.children[0])
next = next.nextElementSibling
}
})
</script>