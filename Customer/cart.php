<!-- header -->
<?php 
    $pageTitle='Giỏ hàng'; 
    include_once 'component/header.php';
?>
<link rel="stylesheet" href="../main/css/cart.css">
<!-- Đường dẫn -->
    <div class="">
        <div class="duongdan">
            <a href="index.php">Trang chủ / </a>
            <span>Giỏ hàng</span>
        </div>
    </div>
    <!-- main -->
    <div class="container mt-5">
        <h1 class="text-center mb-4">Giỏ hàng của bạn</h1>
        <form method="post" action="thanhToan.php">
            <div class="cart-table">
                    <?php
                        // Kiểm tra nếu giỏ hàng có sản phẩm
                        if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                            // Lấy số lượng sản phẩm trong giỏ hàng
                            $cartCount = count($_SESSION['cart']);
                            echo '
                                    <table class="table table-hover text-center">
                                        <thead>
                                            <tr>
                                                <th>Hình ảnh</th>
                                                <th>Sản phẩm</th>
                                                <th>Giá</th>
                                                <th>Số lượng</th>
                                                <th>Tổng</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody id="cart-items">';
                            // Dùng vòng lặp for để duyệt qua các sản phẩm trong giỏ hàng
                            for ($i = 0; $i < $cartCount; $i++) {
                                $item = $_SESSION['cart'][$i];
                                echo '<tr>
                                        <td>
                                            <div class="cart-product d-flex align-items-center">
                                                <img src="../main/img/img_product/img_product_detail/'.$item['img'].'" alt="Sản phẩm" class="cart-product-img">
                                            </div>
                                        </td>
                                        
                                        <td>
                                            <div class="cart-product d-block" >
                                                <span class="ms-3">'.$item['product_name'].'( '.$item['size'].' )</span>
                                            </div>
                                        </td>
                                        
                                        <td>'.number_format($item['price'], 0, ',', '.').' </td>
                                        <td>
                                            <!-- xử lý tăng số lượng -->
                                            <div class="d-flex align-items-center justify-content-center">
                                                <input type="hidden" name="cart['.$i.'][img]" value="'.$item['img'].'">
                                                <input type="hidden" name="cart['.$i.'][product_name]" value="'.$item['product_name'].'">
                                                <input type="hidden" name="cart['.$i.'][price]" value="'.$item['price'].'">
                                                <input type="hidden" name="cart['.$i.'][size]" value="'.$item['size'].'">
                                                <button type="button" class="btn btn-sm btn-outline-secondary quantity-decrease" data-id="'.$i.'">-</button>
                                                <!-- Dữ liệu số lượng sản phẩm sẽ được gửi lên server theo mảng cart -->
                                                <input type="number" class="form-control text-center mx-2 quantity-input" name="cart['.$i.'][quantity]" value="'.$item['quantity'].'" min="1" max="20" style="width: 60px;">
                                                <button type="button" class="btn btn-sm btn-outline-secondary quantity-increase" data-id="'.$i.'">+</button>
                                            </div>
                                        </td>
                                        <td>'.number_format($item['price'] * $item['quantity'], 0, ',', '.').'</td>
                                        <td>
                                            <!-- xử lý xóa -->
                                            <form method="POST">
                                                <input type="hidden" name="action" value="delete">
                                                <input type="hidden" name="product_id" value="'.$i.'">
                                                <button type="button" class="btn btn-danger btn-sm mt-3 remove-item" data-id="'.$i.'">Xóa</button>
                                            </form>
                                        </td>
                                    </tr>';
                                    
                            }
                            echo '</tbody>
                                </table>';
                        } else {
                            echo "Giỏ hàng của bạn hiện tại không có sản phẩm.";
                            echo"
                                <div align='center' class='my-5'>
                                    <a href='product.php' class='btn btn-primary' style='background-color: #4479D4'>Tiếp tục mua sắm</a>
                                </div>

                            ";
                        }
                    ?>
            </div>
            <?php
                if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0)
                {
                    echo '<div class="cart-summary mt-5">
                            <h4 class="text-end">Tổng tiền: <span style="font-size:22px" id="cart-total">0 VNĐ</span></h4>
                            <div class="text-end">
                                <button type="submit" name="nut_thanhtoan" value="Thanh Toán" id="nut_thanhtoan" class="btn btn-primary btn-lg mx-5">Thanh toán</button>
                            </div>
                        </div>';
                    echo"
                        <div align='center' class='my-5'>
                            <a href='product.php' class='btn btn-primary' style='background-color: #4479D4'>Tiếp tục mua sắm</a>
                        </div>

                    ";
                }
            ?>
        </form>  
    </div>
    <?php
            // Xử lý hành động xóa sản phẩm khỏi giỏ hàng
            if (isset($_POST['action']) && $_POST['action'] == 'delete') {
                $productId = $_POST['product_id'];
                unset($_SESSION['cart'][$productId]);  // Xóa sản phẩm khỏi giỏ hàng
                $_SESSION['cart'] = array_values($_SESSION['cart']); // Đảm bảo các khóa giỏ hàng là liên tiếp
                $_SESSION['cart_count'] = count($_SESSION['cart']); // Cập nhật lại số lượng sản phẩm trong giỏ hàng
                header("Location: cart.php " ); // Reload trang sau khi xóa
                exit();
            }
        ?>
<script src="../main/js/cart.js"></script>
<!-- footer -->
<?php include_once 'component/footer.php' ?>