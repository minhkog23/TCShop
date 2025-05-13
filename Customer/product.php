<?php
include_once '../class/khachhang.php';
$kh = new khachhang();
?>
<!-- header -->
<?php
$pageTitle = 'Sản phẩm';
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
        if (isset($_REQUEST['nut_search']) && $_REQUEST['nut_search'] == 'search' && $_REQUEST['txtsearch'] != '') {
            $ten_search = htmlspecialchars($_REQUEST['txtsearch'], ENT_QUOTES, 'UTF-8');
            $con = $kh->connect();
            $stmt = $con->prepare("SELECT * FROM sanpham WHERE tenSP LIKE CONCAT('%', ?, '%')");
            // Kiểm tra xem câu lệnh có chuẩn bị thành công không
            if ($stmt === false) {
                echo "Lỗi chuẩn bị câu lệnh SQL: " . mysqli_error($con);
                exit;
            }

            //$searchTerm = $ten_search;
            echo "<p style='padding-left:50px'>Kết quả tìm kiếm '<span style='color: #4479D4'> $ten_search </span>' </p>";
            //$kh->getSP("select* from sanpham where tenSP like '%$ten_search%'");

            // Liên kết tham số vào câu lệnh chuẩn bị
            $stmt->bind_param("s", $ten_search);
            // Thực thi câu lệnh
            $stmt->execute();
            // Lấy kết quả
            $result = $stmt->get_result();
            if (mysqli_num_rows($result) == 0) {
                echo '<h3 align="center" style="padding-bottom:250px; padding-top: 10px ;">Không có sản phẩm</h3>';
            } else {
                while ($row = $result->fetch_assoc()) {
                    $id_maSP = htmlspecialchars($row['id_maSP'], ENT_QUOTES, 'UTF-8');
                    $tenSP = htmlspecialchars($row['tenSP'], ENT_QUOTES, 'UTF-8');
                    $donGia = htmlspecialchars($row['donGia'], ENT_QUOTES, 'UTF-8');
                    $anh = htmlspecialchars($row['anh'], ENT_QUOTES, 'UTF-8');
                    echo '<div class="box-card col-md-3 mb-4">
                            <div class="card">
                                <img class="card-img-top" src="../assets/img/img_product/' . $anh . '" width="200px" height="250px" alt="Load">
                                <div class="card-body" align="center">
                                    <p class="card-ten" style="font-size:17px; height:40px">' . $tenSP . '</p>
                                    <p style="color:red; font-size: 16px;" class="card-gia">' . number_format($donGia, 0, ',', '.') . ' <span>VNĐ</span></p>
                                    <a href="product_detail.php?maSP=' . $id_maSP . '" class="btn btn-primary card-detail">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>';
                }
            }
            // Đóng statement
            $stmt->close();
        } else {
            $kh->getSP("select* from sanpham");
        }
        ?>
    </div>
</div>
<!-- footer -->
<?php include_once 'component/footer.php' ?>