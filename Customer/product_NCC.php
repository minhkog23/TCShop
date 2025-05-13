<?php
include_once '../class/khachhang.php';
$kh = new khachhang();
?>
<!-- header -->
<?php
$pageTitle = 'Sản phẩm theo danh mục';
include_once 'component/header.php'
?>
<link rel="stylesheet" href="../assets/css/product.css">
<!-- Đường dẫn -->

<?php
if (isset($_REQUEST['id_ThuongHieu']) && $_REQUEST['id_ThuongHieu'] != '' && isset($_REQUEST['id_dongSP']) && $_REQUEST['id_dongSP'] != '') {
    if (filter_var($_REQUEST['id_ThuongHieu'], FILTER_VALIDATE_INT) === false || filter_var($_REQUEST['id_dongSP'], FILTER_VALIDATE_INT) === false) {
        echo '<script>window.location="product.php"</script>';
    } else {
        $id_ThuongHieu = $_REQUEST['id_ThuongHieu'];
        $id_dongSP = $_REQUEST['id_dongSP'];
        $tenThuongHieu = $kh->laycot("select tenThuongHieu from thuonghieu where id_ThuongHieu=?", [$id_ThuongHieu]);
        $tenDongSP = $kh->laycot("select tenDongSP from dongsanpham where id_dongSP=?", [$id_dongSP]);
    }
} else if (isset($_REQUEST['id_ThuongHieu']) && $_REQUEST['id_ThuongHieu'] != '' && empty($_REQUEST['id_dongSP'])) {
    if (filter_var($_REQUEST['id_ThuongHieu'], FILTER_VALIDATE_INT) === false) {
        echo '<script>window.location="product.php"</script>';
    } else {
        $id_ThuongHieu = $_REQUEST['id_ThuongHieu'];
        $tenThuongHieu = $kh->laycot("select tenThuongHieu from thuonghieu where id_ThuongHieu=?", [$id_ThuongHieu]);
    }
} else {
    echo '<script>window.location="product.php"</script>';
}
?>
<div class="">
    <div class="duongdan">
        <a href="index.php">Trang chủ / </a>
        <a href="product.php">Tất cả sản phẩm /</a>
        <span>Vợt cầu lông <?php echo $tenThuongHieu ?></span>
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

    <!-- <div class="title">
            <h3 class="pt-3 pb-3" align="center">Tất cả sản phẩm</h3>
        </div> -->

    <!-- dong san pham theo tung nha cung cap-->
    <div class="category row pt-5 mb-3">
        <?php
        $con = $kh->connect();
        $sql = "select* from dongsanpham where id_ThuongHieu= ? ";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $id_ThuongHieu);
        $stmt->execute();
        $result = $stmt->get_result();
        if (mysqli_num_rows($result) > 0) {
            while ($row = $result->fetch_assoc()) {
                $id_dongSP = htmlspecialchars($row['id_dongSP'], ENT_QUOTES, 'UTF-8');
                $tenDongSP = htmlspecialchars($row['tenDongSP'], ENT_QUOTES, 'UTF-8');
                $id_ThuongHieu = htmlspecialchars($row['id_ThuongHieu'], ENT_QUOTES, 'UTF-8');

                echo '<div class="category-box col-md-3 mb-3">
                            <a href="product_NCC.php?id_ThuongHieu=' . $id_ThuongHieu . '&id_dongSP=' . $id_dongSP . '"><span>' . $tenDongSP . '</span></a>
                        </div>';
            }
        } else {
            echo '<h3 align="center" style="padding-top: 10px ;">Không có dòng sản phẩm</h3>';
        }

        //$kh->getDongSanPham("");
        ?>

    </div>
    <div class="dsp mb-3">
        <?php
        if (isset($_REQUEST['id_ThuongHieu']) && $_REQUEST['id_ThuongHieu'] != '' && isset($_REQUEST['id_dongSP']) && $_REQUEST['id_dongSP'] != '') {
            echo '<p class="" align="left">Sản phẩm của <span> ' . $tenThuongHieu . '</span> <span>/ ' . $tenDongSP . '</span></p>';
        } else {
            echo '<p class="" align="left">Sản phẩm của <span> ' . $tenThuongHieu . '</span></p>';
        }
        ?>

    </div>

    <!-- lọc sản phẩm theo dòng sản phẩm -->
    <div class="box row">

        <?php
        if (isset($_REQUEST['id_ThuongHieu']) && $_REQUEST['id_ThuongHieu'] != '' && isset($_REQUEST['id_dongSP']) && $_REQUEST['id_dongSP'] != '') {
            if (filter_var($_REQUEST['id_ThuongHieu'], FILTER_VALIDATE_INT) === false || filter_var($_REQUEST['id_dongSP'], FILTER_VALIDATE_INT) === false) {
                echo '<script>window.location="product.php"</script>';
            } else {
                $id_dongSP = $_REQUEST['id_dongSP'];
                $kh->getSP("select* from sanpham where id_dongSP=$id_dongSP");
            }
        } else if (isset($_REQUEST['id_ThuongHieu']) && $_REQUEST['id_ThuongHieu'] != '') {
            if (filter_var($_REQUEST['id_ThuongHieu'], FILTER_VALIDATE_INT) === false) {
                echo '<script>window.location="product.php"</script>';
            } else {
                $kh->getSP("SELECT * 
                                    FROM sanpham sp INNER JOIN dongsanpham dsp on sp.id_dongSP=dsp.id_dongSP
                                                    INNER JOIN thuonghieu ncc on dsp.id_ThuongHieu=ncc.id_ThuongHieu
                                    where ncc.id_ThuongHieu=$id_ThuongHieu");
            }
        } else {
            $kh->getSP("select* from sanpham");
        }

        ?>
    </div>


</div>
<!-- footer -->
<?php include_once 'component/footer.php' ?>