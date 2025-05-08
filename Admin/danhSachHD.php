<?php
include '../class/admin.php';
$ad = new admin();
?>

<?php
include '../class/auth.php';
$checkRole = new auth();
if ($checkRole->checkRoleAdmin() == 0) {
    header('location:index.php');
}
?>

<?php
// Danh sách giá trị loc hợp lệ
$ar = ['cxl', 'dxn', 'cbh', 'huy'];

// Lấy loc từ URL
$loc = isset($_REQUEST['loc']) ? $_REQUEST['loc'] : '';

// Nếu loc không hợp lệ → chuyển về cxl
if (!in_array($loc, $ar)) {
    header('location: index.php');
    exit;
}
?>

<?php
include 'component/header.php';
?>
<div class="text-center mb-4">
    <h2>Xử lý đơn</h2>
</div>
<div class="alert alert-primary" role="alert">
    <!-- A simple primary alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like. -->
    <?php
    $cxl = $ad->laycot("select count(tinhTrang) from hoadon where tinhTrang='Chờ xử lý'");
    $dxn = $ad->laycot("select count(tinhTrang) from hoadon where tinhTrang='Đã xác nhận'");
    $cbh = $ad->laycot("select count(tinhTrang) from hoadon where tinhTrang='Đang chuẩn bị hàng'");
    $huy = $ad->laycot("select count(tinhTrang) from hoadon where tinhTrang='Hủy'");

    ?>
    <a href="danhSachHD.php?loc=cxl" class="btn btn-warning position-relative mx-3">Đơn chờ xử lý
        <?php
        if ($cxl != 0) {
            echo '<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            ' . $cxl . '
                        </span>';
        } else {
            echo '';
        }

        ?>
    </a>

    <a href="danhSachHD.php?loc=dxn" class="btn btn-primary position-relative mx-3">
        Đã xác nhận
        <?php
        if ($dxn != 0) {
            echo '<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            ' . $dxn . '
                        </span>';
        } else {
            echo '';
        }

        ?>
    </a>
    <a href="danhSachHD.php?loc=cbh" class="btn btn-primary position-relative mx-3">
        Chuẩn bị hàng
        <?php
        if ($cbh != 0) {
            echo '<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            ' . $cbh . '
                        </span>';
        } else {
            echo '';
        }

        ?>
    </a>

    <a href="danhSachHD.php?loc=huy" class="btn btn-secondary position-relative mx-3">
        Hủy bỏ
    </a>

</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Danh sách đơn hàng</h5>
    </div>
    <!-- <div class="card-body">
        <a href="add-ThuongHieu.php"><button type="button" class="btn btn-primary btn-sm">Thêm mới</button></a>
    </div> -->
    <div class="card-body">
        <div class="table-responsive">
            <form method="post">
                <!-- Xử lý trạng thái 'Chờ xử lý' -->
                <?php
                if (isset($_REQUEST['loc']) && $_REQUEST['loc'] == 'cxl') {
                    $ad->getHD_cxl('select * from hoadon where tinhtrang="Chờ xử lý" order by id_HD desc');
                    if (isset($_REQUEST['nut_dxn']) && $_REQUEST['nut_dxn'] == 'Xác nhận') {
                        $id_dxn = $_REQUEST['id_dxn'];
                        if ($ad->themxoasua("UPDATE hoadon SET tinhTrang='Đã xác nhận' WHERE id_HD='$id_dxn'") == 1) {
                            echo "<script>
                                                swal('Thành công','Xác nhận thành công','success').then(function(){
                                                            window.location='danhSachHD.php?loc=dxn';
                                                });
                                                setTimeout(function() {
                                                    window.location = 'danhSachHD.php?loc=dxn';
                                                }, 2000);         
                                            </script>";
                        }
                    }
                }
                // Xử lý trạng thái 'Đã xác nhận' 
                else if (isset($_REQUEST['loc']) && $_REQUEST['loc'] == 'dxn') {
                    $ad->getHD_dxn('select * from hoadon where tinhtrang="Đã xác nhận" order by id_HD desc');
                    if (isset($_REQUEST['nut_cbh']) && $_REQUEST['nut_cbh'] == 'Chuẩn bị hàng') {
                        $id_dxn = $_REQUEST['id_dxn'];
                        if ($ad->themxoasua("UPDATE hoadon 
                                                        SET tinhTrang='Đang chuẩn bị hàng'
                                                        WHERE id_HD='$id_dxn'") == 1) {
                            echo "<script>
                                                swal('Thành công','Đang chuẩn bị hàng','success').then(function(){
                                                        window.location='danhSachHD.php?loc=cbh';
                                                });
                                                setTimeout(function() {
                                                    window.location = 'danhSachHD.php?loc=cbh';
                                                }, 2000);     
                                            </script>";
                        }
                    }
                }
                // // Xử lý trạng thái 'Chờ giao hàng' 
                else if (isset($_REQUEST['loc']) && $_REQUEST['loc'] == 'cbh') {
                    $ad->getHD_cbh('select * from hoadon where tinhtrang="Đang chuẩn bị hàng" order by id_HD desc');
                    if (isset($_REQUEST['nut_dpgh']) && $_REQUEST['nut_dpgh'] == 'Chuyển giao hàng') {
                        $id_cbh = $_REQUEST['id_cbh'];
                        echo $id_cbh;
                        if ($ad->themxoasua("UPDATE hoadon 
                                                        SET tinhTrang='Chờ giao hàng' 
                                                        WHERE id_HD='$id_cbh'") == 1) {
                            echo "<script>
                                                swal('Thành công','Chuyển sang điều phối giao hàng.','success').then(function(){
                                                    window.location='danhSachHD.php?loc=cxl';
                                                });
                                                setTimeout(function() {
                                                    window.location = 'danhSachHD.php?loc=cxl';
                                                }, 2000);
                                            </script>";
                        } else {
                            echo "<script>swal('Thất bại','Chuyển giao hàng thất bại.','error')</script>";
                        }
                    }
                } else if (isset($_REQUEST['loc']) && $_REQUEST['loc'] == 'huy') {
                    $ad->getHD_huy('select * from hoadon where tinhtrang="Hủy" order by id_HD desc');
                } else {
                    // $ad->getHD('select * from hoadon order by id_HD desc');
                    echo '<h3 align="center">Không có đơn hàng nào cần xử lý </h3>';
                }
                ?>

                <?php
                if (isset($_REQUEST['nut_xoa']) && $_REQUEST['nut_xoa'] == 'Xóa') {
                    $id_xoa = $_REQUEST['id_xoa'];
                    echo $id_xoa;
                    if ($ad->themxoasua("DELETE FROM hoadon WHERE id_HD='$id_xoa'") == 1) {
                        echo "<script>
                                    swal('Thành công','Xóa thành công','success').then(function(){
                                        window.location='danhSachHD.php?loc=cxl';
                                    });
                                    setTimeout(function() {
                                        window.location = 'danhSachHD.php?loc=cxl';
                                    }, 2000);
                                </script>";
                    }
                }
                ?>
            </form>
        </div>
    </div>
</div>
<?php
include_once 'component/footer.php'
?>