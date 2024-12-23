<?php
    include('../includes/connect.php');
    $get_product_query = "SELECT * FROM `products` WHERE 1";
    if (isset($_POST['category']) && $_POST['category'] != 0) {
        $category_id = $_POST['category'];
        $get_product_query .= " AND category_id = $category_id";
    }

    $search = isset($_POST['search']) ? $_POST['search'] : '';
    if (!empty($search)) {
        $get_product_query .= " AND name LIKE '%$search%'";
    }

    $get_product_query .= " order by id desc";

    $get_product_result = mysqli_query($con, $get_product_query);
    $total_rows = mysqli_num_rows($get_product_result);
    
    if ($total_rows > 0) {
        $stt = 0;
    
        while ($row_fetch_products = mysqli_fetch_array($get_product_result)) {
            $stt ++;
            $product_id = $row_fetch_products['id'];
            $name = $row_fetch_products['name'];
            $image = $row_fetch_products['image'];
            $product_images = explode(',', $image);
            $image = $product_images[0];
            $cost_price = number_format($row_fetch_products['cost_price'], 0, '.', '.');
            $selling_price = number_format($row_fetch_products['selling_price'], 0, '.', '.');
            $quantity = $row_fetch_products['quantity'];
    
            echo "
            <tr>
            <td class='text-center'> $stt </td>
            <td class='text-center'> $name </td>
            <td class='text-center'>
                <img src='./product_images/$image' alt='$name' width='80px' class='img-thumbnail'/>
            </td>
            <td class='text-center'>$cost_price VNĐ</td>
            <td class='text-center'>$selling_price VNĐ</td>
            <td class='text-center'>$quantity</td>
            <td class='text-center'>
                <a href='edit_product.php?edit_product=$product_id'>
                <svg xmlns='http://www.w3.org/2000/svg' height='1em' viewBox='0 0 512 512'><path d='M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z'/></svg>
                </a>
            </td>
            <td class='text-center'>
                <a href='' data-bs-toggle='modal' data-bs-target='#deleteModal_$product_id'>
                <svg xmlns='http://www.w3.org/2000/svg' height='1em' viewBox='0 0 448 512'><path d='M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z'/></svg>
                </a>
                <!-- Modal -->
                <div class='modal fade' id='deleteModal_$product_id' tabindex='-1' aria-labelledby=\"deleteModal_$product_id.Label\" aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered justify-content-center'>
                        <div class='modal-content' style='width:80%;'>
                            <div class='modal-body'>
                                <div class='d-flex flex-column gap-3 align-items-center text-center'>
                                    <span>
                                        <svg width='50' height='50' viewBox='0 0 60 60' fill='none' xmlns='http://www.w3.org/2000/svg'>
                                            <circle cx='29.5' cy='30.5' r='26' stroke='#EA4335' stroke-width='3' />
                                            <path d='M41.2715 22.2715C42.248 21.2949 42.248 19.709 41.2715 18.7324C40.2949 17.7559 38.709 17.7559 37.7324 18.7324L29.5059 26.9668L21.2715 18.7402C20.2949 17.7637 18.709 17.7637 17.7324 18.7402C16.7559 19.7168 16.7559 21.3027 17.7324 22.2793L25.9668 30.5059L17.7402 38.7402C16.7637 39.7168 16.7637 41.3027 17.7402 42.2793C18.7168 43.2559 20.3027 43.2559 21.2793 42.2793L29.5059 34.0449L37.7402 42.2715C38.7168 43.248 40.3027 43.248 41.2793 42.2715C42.2559 41.2949 42.2559 39.709 41.2793 38.7324L33.0449 30.5059L41.2715 22.2715Z' fill='#EA4335' />
                                        </svg>
                                    </span>
                                    <h2>Bạn có muốn xóa sản phẩm này?</h2>
                                    <p>
                                        Bạn có thực sự muốn xóa những bản ghi này không?

                                    </p>
                                    
                                    <div class='btns d-flex gap-3'>
                                        <button type='button' class='btn px-5 btn-secondary' data-bs-dismiss='modal'>Cancel</button>
                                        <a class='text-light' href='delete_product.php?id=$product_id'><button type='button' class='btn px-5 btn-primary' data-bs-dismiss='modal'>
                                                Xóa
                                        </button></a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal  -->
            </td>
        </tr>
            ";

        }        
    }else {
        echo "<p>Không có sản phẩm trong danh mục này.</p>";
    }

?>