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
include 'component/header.php';
?>
<div class="card">

</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Danh sách tài khoản khách hàng</h5>
    </div>
    <div class="card-body">
        <!-- <a href="add-taiKhoan-kh.php"><button type="button" class="btn btn-primary btn-sm">Thêm tài khoản khách hàng</button></a> -->
        <!-- <a href="#"><button type="button" class="btn btn-warning btn-sm">Các tài khoản đã khóa</button></a> -->
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <form method="post">
                <?php
                $ad->getTaiKhoan_KH('select * 
                                from khachhang');
                ?>

                <div class="xuLyKhoa">
                    <?php
                    if (isset($_REQUEST['nut_khoa']) && $_REQUEST['nut_khoa'] == 'Khóa') {
                        $id_KH = $_REQUEST['id_xemchitiet'];
                        if ($ad->themxoasua("UPDATE khachhang 
                                                SET tinhTrang='Inactive' 
                                                WHERE id_KH='$id_KH'") == 1) {
                            echo "<script>
                                    swal('Thành công','Khóa tài khoản thành công!','success').then(function() {
                                        window.location='taiKhoan-kh.php';
                                    });
                                </script>";
                        } else {
                            echo "<script>alert('Khóa tài khoản không thành công!');</script>";
                        }
                    }

                    if (isset($_REQUEST['nut_khoa']) && $_REQUEST['nut_khoa'] == 'Mở khóa') {
                        $id_KH = $_REQUEST['id_xemchitiet'];
                        if ($ad->themxoasua("UPDATE khachhang 
                                                SET tinhTrang='Active' 
                                                WHERE id_KH='$id_KH'") == 1) {
                            echo "<script>
                                    swal('Thành công','Mở khóa tài khoản thành công!','success').then(function() {
                                        window.location='taiKhoan-kh.php';
                                    });
                                </script>";
                        } else {
                            echo "<script>alert('Mở khóa tài khoản không thành công!');</script>";
                        }
                    }
                    ?>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
include_once 'component/footer.php'
?>