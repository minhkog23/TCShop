<?php
    include_once '../class/khachhang.php';
    $kh=new khachhang();
?>
<!-- header -->
<?php 
    $pageTitle='Chi tiết sản phẩm'; 
    include_once 'component/header.php' 
?>


<link rel="stylesheet" href="../main/css/product_detail.css">
<!-- Đường dẫn -->
    <div class="">
        <div class="duongdan">
            <a href="index.php">Trang chủ / </a>
            <span>Chi tiết sản phẩm</span>
        </div>
    </div>

    <!-- lay cot -->
    <?php
        $id_maSP=$_REQUEST['maSP'];
        $anh1=$kh->laycot("select anh1 from anh_chitietsp where id_maSP=$id_maSP");
        $anh2=$kh->laycot("select anh2 from anh_chitietsp where id_maSP=$id_maSP");
        $anh3=$kh->laycot("select anh3 from anh_chitietsp where id_maSP=$id_maSP");
        $anh4=$kh->laycot("select anh4 from anh_chitietsp where id_maSP=$id_maSP");
        $tenSP=$kh->laycot("select tenSP from sanpham where id_maSP=$id_maSP");
        $moTa=$kh->laycot("select moTa from sanpham where id_maSP=$id_maSP");
        $donGia=$kh->laycot("select donGia from sanpham where id_maSP=$id_maSP");
        $thuongHieu=$kh->laycot("SELECT ncc.tenThuongHieu 
                                    FROM sanpham sp INNER JOIN dongsanpham dsp on sp.id_dongSP=dsp.id_dongSP
                                                    INNER JOIN thuonghieu ncc on dsp.id_ThuongHieu=ncc.id_ThuongHieu
                                    where sp.id_maSP=$id_maSP");
    ?>


    <?php

        // Kiểm tra nếu form được gửi bằng phương thức POST
        if (isset($_REQUEST['nut_giohang']) && $_REQUEST['nut_giohang'] == 'add_to_cart') {
            // Lấy dữ liệu từ form, kiểm tra nếu không có thì gán giá trị mặc định
            if (isset($_REQUEST['txtsize'])) {
                $size = $_REQUEST['txtsize'];
            } else {
                $size = '4U5'; // Giá trị mặc định nếu không chọn
            }

            if (isset($_REQUEST['txtsoluong'])) {
                $soluong = $_REQUEST['txtsoluong'];
            } else {
                $soluong = 1; // Giá trị mặc định nếu không nhập số lượng
            }

            // Kiểm tra nếu giỏ hàng chưa tồn tại trong session, nếu chưa thì tạo mới
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = []; // Khởi tạo giỏ hàng trống
                $_SESSION['cart_count'] = 0; // Khởi tạo biến đếm giỏ hàng
            }

            // Thêm sản phẩm vào giỏ hàng
            $_SESSION['cart'][] = [
                'img' => $anh1,
                'product_name' => $tenSP,
                'brand' => $thuongHieu,
                'price' => $donGia,
                'size' => $size,
                'quantity' => $soluong,
            ];

            // Cập nhật lại biến đếm giỏ hàng
            $_SESSION['cart_count'] += $soluong;
            
            echo '<script>
                        swal("Thành công","Thêm vào giỏ hàng thành công","success").then(function(){
                        window.location="product_detail.php?maSP='.$id_maSP.'";
                });</script>';
        }
    ?>

    <!-- kiểm tra sesson có dữ liệu ch -->
    <?php
        // if (isset($_SESSION['cart'])) {
        //     echo "<pre>";
        //     print_r($_SESSION['cart']); // In toàn bộ nội dung giỏ hàng
        //     echo "</pre>";
        // }
    ?>

    <!-- card -->
    <div class="container">
        <h3 style="text-align: center;" class="pt-3 pb-3">Chi tiết sản phẩm</h3>
        <div class="product_detail row">
            <div class="slider col-5">
                <!-- Carousel -->
                <div id="demo" class="carousel slide carousel-fade" data-bs-ride="carousel">

                    <!-- Indicators/dots -->
                    <div class="carousel-indicators">
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="3"></button>
                    </div>

                    <!-- The slideshow/carousel -->
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="../main/img/img_product/img_product_detail/<?php echo $anh1?>" alt="LOAD" class="d-block w-100">
                        </div>
                        <div class="carousel-item">
                            <img src="../main/img/img_product/img_product_detail/<?php echo $anh2?>" alt="LOAD" class="d-block w-100">
                        </div>
                        <div class="carousel-item">
                            <img src="../main/img/img_product/img_product_detail/<?php echo $anh3?>" alt="LOAD" class="d-block w-100">
                        </div>
                        <div class="carousel-item">
                            <img src="../main/img/img_product/img_product_detail/<?php echo $anh4?>" alt="LOAD" class="d-block w-100">
                        </div>
                    </div>

                    <!-- Left and right controls/icons -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                    </button>

                    <!-- Thumbnails -->
                    <div class="d-flex justify-content-center mt-3 thumbnail">
                        <img src="../main/img/img_product/img_product_detail/<?php echo $anh1?>" class="img-thumbnail mx-1 active" data-bs-slide-to="0" alt="Thumbnail 1" style="width: 85px; height: 100px;" />
                        <img src="../main/img/img_product/img_product_detail/<?php echo $anh2?>" class="img-thumbnail mx-1" data-bs-slide-to="1" alt="Thumbnail 2" style="width: 85px; height: 100px;" />
                        <img src="../main/img/img_product/img_product_detail/<?php echo $anh3?>" class="img-thumbnail mx-1" data-bs-slide-to="2" alt="Thumbnail 3" style="width: 85px; height: 100px;" />
                        <img src="../main/img/img_product/img_product_detail/<?php echo $anh4?>" class="img-thumbnail mx-1" data-bs-slide-to="3" alt="Thumbnail 4" style="width: 85px; height: 100px;" />
                    </div>
                </div>

                <!-- Xử lý -->
                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                    const thumbnails = document.querySelectorAll(".thumbnail img"); // Lấy tất cả ảnh thumbnail
                    const carousel = document.getElementById("demo"); // Lấy carousel

                    // Lặp qua từng thumbnail và thêm sự kiện click
                    thumbnails.forEach((thumbnail, index) => {
                        thumbnail.addEventListener("click", () => {
                        // Xóa class 'active' khỏi tất cả thumbnails
                        thumbnails.forEach((thumb) => thumb.classList.remove("active"));

                        // Thêm class 'active' vào thumbnail được click
                        thumbnail.classList.add("active");

                        // Di chuyển slider đến ảnh tương ứng
                        const carouselInstance = bootstrap.Carousel.getInstance(carousel);
                        carouselInstance.to(index);
                        });
                    });

                    // Lắng nghe sự kiện chuyển slide để cập nhật thumbnail
                    carousel.addEventListener("slide.bs.carousel", (e) => {
                        // Xóa class 'active' khỏi tất cả thumbnails
                        thumbnails.forEach((thumb) => thumb.classList.remove("active"));

                        // Thêm class 'active' vào thumbnail tương ứng với slide hiện tại
                        thumbnails[e.to].classList.add("active");
                    });
                    });

                </script>
            </div>
            <div class="info-product col-5" >
                <form action="" method="post" style="text-align: left;">
                    <div class="product-desc">
                        <h3><?php echo $tenSP?></h3>
                        <p>Thương hiệu: <span><?php echo $thuongHieu?></span></p>
                        <p class="price">
                            <p style="color: red; font-size: 18px;"><?php echo number_format($donGia, 0, ',', '.')?> <span>VNĐ</span></p> 

                            <!-- Ngôi sao chưa làm -->
                            <span class="rate" style="color: #eb9e44;">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </span>
                        </p>
                    </div>

                    <!-- lặp -->
                    <div class="size"> 
                        <div class="mb-1 mt-1">
                            <p>Size</p>
                            <div class="mt-3 mb-3">
                                <?php
                                    $kh->getSize("select* from chitietsanpham where id_maSP=$id_maSP");
                                ?>
                            </div>
                        </div>
                    </div>
                    

                    <div class="soLuong">
                        <div class="mb-2">
                            <p>Số lượng</p>
                            <div class="mt-3 mb-3">
                                <span class="box-soLuong">
                                    <input type="number" name="txtsoluong" id="txtsoluong" class="text-center box-soLuong-sl" width="200px" value="1" min="1" max="20">
                                </span> 
                            </div>
                        </div>
                    </div>

                    <div class="mt-5">
                        <button type="submit" name="nut_giohang" value="add_to_cart" id="themgiohang" class="btn btn-warning w-75"><i class="fas fa-shopping-basket"></i> Thêm giỏ hàng</button>
                        <!-- <button type="submit" name="nut" id="muahang" class="btn btn-warning"><a href="#"><i class="fas fa-shopping-cart"></i> Mua hàng</a></button> -->
                        
                    </div>
                </form>
            </div>
            
        </div>
        <div class="moTa text-center mt-5 pt-3">
            <h3>Mô tả</h3>
            <div class="card p-3">
                <?php echo $moTa ?>
            </div>

        </div>

        <!-- Chưa làm đánh giá -->
        <div class="danhGia text-center mt-5 pt-3">
            <h3>Đánh giá</h3>
            <div class="box-danhGia">
                <div class="d-flex">
                    <textarea name="txtMota" id="txtMota" class="form-control" placeholder="Viết đánh giá ..."></textarea>
                    <button type="submit" class="btn btn-success btn-danhGia">Đánh giá</button>
                </div>
                <div class="cus-danhGia mt-5 pd-5">
                    <h5 align="left" class="mb-3">Đánh giá của khách hàng:</h5>
                    <hr>
                    <div class="noiDung-danhGia">  
                        <p align="left"><i class="fas fa-user-secret"></i> Khách hàng A: </p>
                        <p align="left" style="color: #eb9e44;">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                        </p>
                        <p align="left" style="font-size: 13px;">Sản phẩm tốt mừi điểm</p>
                        <hr>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
<script src="../main/js/product_detail.js"></script>
    <!-- footer -->
<?php include_once 'component/footer.php' ?>