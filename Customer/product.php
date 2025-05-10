<?php
    include_once '../class/khachhang.php';
    $kh=new khachhang();
?>
<!-- header -->
<?php 
    $pageTitle='Sản phẩm';
    include_once 'component/header.php';
?>
<link rel="stylesheet" href="../assets/css/product.css">
<!-- Đường dẫn -->
    <div class="">
        <div class="duongdan">
            <a href="index.php">Trang chủ / </a>
            <span>Tất cả sản phẩm</span>
        </div>
    </div>

    <!-- card -->
    <div class="container">
        <div class="column">
            <p align='center'>Danh mục</p>
            <ul class="nav flex-column">
                <?php
                    $kh->getNCC('select* from thuonghieu');
                ?>
            </ul>
        </div>

        <div class="title">
            <h3 class="pt-3 pb-3" align="center">Tất cả sản phẩm</h3>
        </div>

        <!-- dong san pham theo tung nha cung cap-->
        <!-- <div class="category d-flex pt-5 mb-3">
            <div class="category-box">
                <a href="?Duora">Duora</a>
            </div>

        </div>
        <div class="dsp mb-3">
            <p class="" align="left">Sản phẩm của <span>Yonex</span></p>
        </div> -->
        
        <div class="box row">
            <?php
                if(isset($_REQUEST['nut_search']) && $_REQUEST['nut_search']=='search' && $_REQUEST['txtsearch']!='')
                {
                    $ten_search = $_REQUEST['txtsearch'];
                    echo "<p style='padding-left:50px'>Kết quả tìm kiếm '<span style='color: #4479D4'> $ten_search </span>' </p>";
                    $kh->getSP("select* from sanpham where tenSP like '%$ten_search%'");
                }
                else
                {
                    $kh->getSP("select* from sanpham");
                }
           ?>
        </div>       
    </div>
    <!-- footer -->
<?php include_once 'component/footer.php' ?>