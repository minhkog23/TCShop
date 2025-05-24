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
if (!isset($_REQUEST['id_sua'])) {
    header('location:danhSachTH.php');
} else if (filter_var($_REQUEST['id_sua'], FILTER_VALIDATE_INT) === false) {
    header('location:danhSachTH.php');
} else {
    $id_sua = intval($_REQUEST['id_sua']);
    $tenThuongHieu = $ad->laycot("select tenThuongHieu from thuonghieu where id_ThuongHieu='$id_sua'");
    $moTa = $ad->laycot("select moTa from thuonghieu where id_ThuongHieu='$id_sua'");
}
?>
<?php
// token
// $token =bin2hex(random_bytes(32)); chỉ hổ trợ php 7.0 trở lên
// Đặt ở đầu file PHP, trước khi xuất HTML
if (!isset($_SESSION['token'])) {
    //$_SESSION['token'] = bin2hex(random_bytes(32));//
    $_SESSION['token'] = md5(uniqid(rand(), true)); // Hoặc sử dụng hàm md5 để tạo token
}
$token = $_SESSION['token'];
?>

<?php
include 'component/header.php';
?>
<div class="alert alert-secondary">
    <h4 class="pt-2">TC-Badminton / Thương hiệu</h4>
</div>
<!-- Basic Card Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Sửa thương hiệu</h5>
    </div>
    <div class="card-body">
        <form method="post">
            <div class="row">
                <div class="mb-3 col-md-12">
                    <label for="txttenth" class="form-label">Nhập tên thương hiệu <span style="color:red">*</span></label>
                    <input type="text" class="form-control" pattern="^[A-Za-zÀ-Ỹà-ỹ\s]+$" title="Không được chứa số" name="txttenth" id="txttenth" value="<?php echo $tenThuongHieu ?>" required>
                </div>
                <div class="mb-3 col-md-12">
                    <label for="txtmota" class="form-label">Mô tả</label>
                    <textarea class="form-control" name="txtmota" id="txtmota" rows="7"><?php echo $moTa ?></textarea>
                </div>

                <div class="mb-3 col-md-12 text-center">
                    <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                    <a href="danhSachTH.php"><button type="button" class="btn btn-outline-danger ">Quay lại</button></a>
                    <input type="reset" value="Nhập lại" class="btn btn-outline-secondary " name="btn_reset" id="btn_reset">
                    <button type="submit" name="nut_sua" value="sua-TH" class="btn btn-outline-primary">Lưu</button>
                </div>
            </div>
            <div align="center">
                <?php
                if (isset($_REQUEST['nut_sua']) && $_REQUEST['nut_sua'] == 'sua-TH' && $_REQUEST['token'] == $_SESSION['token']) {
                    $tenThuongHieu = $_REQUEST['txttenth'];
                    $mota = $_REQUEST['txtmota'];
                    if ($_REQUEST['txttenth'] == '') {
                        echo '<span id="valTH" style="display: block; color:red">Vui lòng nhập tên thương hiệu cần sửa !</span>';
                    } else {
                        $sql = "UPDATE thuonghieu 
                                        SET tenThuongHieu=?,moTa=? 
                                        WHERE id_ThuongHieu=?";
                        $params = [$tenThuongHieu, $mota, $id_sua];
                        $result = $ad->themxoasua($sql, $params);
                        if ($result == 1) {
                            echo "<script>
                                    swal('Thành công','Sửa thương hiệu thành công','success').then(function(){
                                        window.location='danhSachTH.php';
                                    });
                                    setTimeout(function(){
                                        window.location='danhSachTH.php';
                                    }, 2000);
                                </script>";
                        } else {
                            echo "<script>swal('Thất bại','Sửa thương hiệu không thành công','error').then(function(){
                                                    window.location='sua-ThuongHieu.php';
                                })</script>";
                        }
                        unset($_SESSION['token']);
                    }
                } else if (isset($_REQUEST['nut_sua']) && $_REQUEST['nut_sua'] == 'sua-TH' && $_REQUEST['token'] != $_SESSION['token']) {
                    echo '<script>swal("Thất bại","Không gửi lại form cũ","error")</script>';
                    unset($_SESSION['token']);
                }
                ?>
            </div>

        </form>

    </div>
    <?php
    include_once 'component/footer.php'
    ?>