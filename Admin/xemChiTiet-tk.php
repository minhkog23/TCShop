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

<?php
if (isset($_REQUEST['id_nv']) || isset($_REQUEST['id_kh'])) {
    $id_nv = isset($_REQUEST['id_nv']) ? $_REQUEST['id_nv'] : null;
    $id_kh = isset($_REQUEST['id_kh']) ? $_REQUEST['id_kh'] : null;
    if ($id_nv != null) {
        $hoNV = $ad->laycot("select hoNV from nhanvien where id_nv='$id_nv'");
        $tenNV = $ad->laycot("select tenNV from nhanvien where id_nv='$id_nv'");
        $emailNV = $ad->laycot("select emailNV from nhanvien where id_nv='$id_nv'");
        $sdtNV = $ad->laycot("select sdtNV from nhanvien where id_nv='$id_nv'");
        $diaChiNV = $ad->laycot("select diaChiNV from nhanvien where id_nv='$id_nv'");
        $matKhauNV = $ad->laycot("select matKhauNV from nhanvien where id_nv='$id_nv'");
        $tinhTrangNV = $ad->laycot("select tinhTrang from nhanvien where id_nv='$id_nv'");
        $id_quyen = $ad->laycot("select id_quyen from nhanvien where id_nv='$id_nv'");
        $tenQuyen = $ad->laycot("select ten from quyen where id_quyen='$id_quyen'");
    } else if ($id_kh != null) {
        $ho = $ad->laycot("select ho from khachhang where id_kh='$id_kh'");
        $ten = $ad->laycot("select ten from khachhang where id_kh='$id_kh'");
        $email = $ad->laycot("select email from khachhang where id_kh='$id_kh'");
        $sdt = $ad->laycot("select sdt from khachhang where id_kh='$id_kh'");
        $diaChi = $ad->laycot("select diaChi from khachhang where id_kh='$id_kh'");
        $matKhau = $ad->laycot("select matKhau from khachhang where id_kh='$id_kh'");
        $tinhTrang = $ad->laycot("select tinhTrang from khachhang where id_kh='$id_kh'");
    } else {
        echo "<script>alert('Không có thông tin tài khoản');</script>";
    }
}

?>

<div class="card shadow mb-4">
    <form action="" method="post">
        <div class="card-header py-3">
            <?php
            if (isset($_REQUEST['id_kh'])) {
                $title = ($id_kh != null) ? "Chi tiết tài khoản khách hàng" : "Chi tiết tài khoản nhân viên";
            }

            ?>
            <h5 class="m-0 font-weight-bold text-primary"><?php if (isset($title)) echo $title;
                                                            else echo 'Chi tiết tài khoản'; ?></h5>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="mb-3 col-6">
                    <label for="txt_hodem" class="form-label">Họ</label>
                    <input type="text" class="form-control" name="txt_hodem" id="txt_hodem" value="<?php if (isset($id_kh) && $id_kh != null) {
                                                                                                        echo $ho;
                                                                                                    } else if (isset($id_nv) && $id_nv != null) {
                                                                                                        echo $hoNV;
                                                                                                    } else {
                                                                                                        echo " ";
                                                                                                    } ?>">
                </div>
                <div class="mb-3 col-6">
                    <label for="txt_ten" class="form-label">Tên</label>
                    <input type="text" class="form-control" name="txt_ten" id="txt_ten" value="<?php if (isset($id_kh) && $id_kh != null) {
                                                                                                    echo $ten;
                                                                                                } else if (isset($id_nv) && $id_nv != null) {
                                                                                                    echo $tenNV;
                                                                                                } else {
                                                                                                    echo " ";
                                                                                                } ?>">
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="txt_email" name="txt_email" value="<?php if (isset($id_kh) && $id_kh != null) {
                                                                                                        echo $email;
                                                                                                    } else if (isset($id_nv) && $id_nv != null) {
                                                                                                        echo $emailNV;
                                                                                                    } else {
                                                                                                        echo " ";
                                                                                                    } ?>">
                </div>
                <div class="mb-3 col-6">
                    <label for="txt_sdt" class="form-label">Số điện thoại</label>
                    <input type="text" class="form-control" id="txt_sdt" name="txt_sdt" value="<?php if (isset($id_kh) && $id_kh != null) {
                                                                                                    echo $sdt;
                                                                                                } else if (isset($id_nv) && $id_nv != null) {
                                                                                                    echo $sdtNV;
                                                                                                } else {
                                                                                                    echo " ";
                                                                                                } ?>">
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-6">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" id="txt_pass" name="txt_pass" value="<?php if (isset($id_kh) && $id_kh != null) {
                                                                                                            echo $matKhau;
                                                                                                        } else if (isset($id_nv) && $id_nv != null) {
                                                                                                            echo $matKhauNV;
                                                                                                        } else {
                                                                                                            echo "";
                                                                                                        } ?>">
                </div>
                <div class="mb-3 col-6">
                    <label for="txt_tinhTrang" class="form-label">Tình trạng tài khoản</label>
                    <input type="text" class="form-control" id="txt_tinhTrang" name="txt_tinhTrang" value="<?php if (isset($id_kh) && $id_kh != null) {
                                                                                                                echo $tinhTrang;
                                                                                                            } else if (isset($id_nv) && $id_nv != null) {
                                                                                                                echo $tinhTrangNV;
                                                                                                            } else {
                                                                                                                echo "";
                                                                                                            } ?>" readonly>
                </div>
            </div>
            <div class="mb-3" <?php if (isset($id_kh) && $id_kh != null) echo 'hidden'; ?>>
                <label for="txt_quyen" class="form-label">Quyền của tài khoản</label>
                <input type="text" class="form-control" id="txt_quyen" name="txt_quyen" value="<?php if (isset($tenQuyen)) echo $tenQuyen ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="txt_diachi" class="form-label">Địa chỉ</label>
                <input type="text" class="form-control" id="txt_diachi" name="txt_diachi" value="<?php if (isset($id_kh) && $id_kh != null) {
                                                                                                        echo $diaChi;
                                                                                                    } else if (isset($id_nv) && $id_nv != null) {
                                                                                                        echo $diaChiNV;
                                                                                                    } else {
                                                                                                        echo " ";
                                                                                                    } ?>">
            </div>
        </div>

        <div class="card-footer text-center">
            <?php
            $href = (isset($id_kh) && $id_kh != null) ? "taiKhoan-kh.php" : "taiKhoan-nv.php";
            echo '<a href="' . $href . '"><button type="button" class="btn btn-danger">Quay lại</button></a>';
            ?>
            <input type="reset" class="btn btn-secondary" value="Nhập lại" name="btn_reset" id="btn_reset">
            <input type="submit" value="Cập nhật" class="btn btn-primary" id="btn_capnhap" name="btn_capnhap" onclick="return confirm('Bạn có chắc chắn muốn cập nhập tài khoản này không?');">
        </div>
        <?php
        if (isset($_REQUEST['btn_capnhap']) && $_REQUEST['btn_capnhap'] == "Cập nhật") {
            if (isset($id_kh) && $id_kh != null) {
                $txt_hodem = $_REQUEST['txt_hodem'];
                $txt_ten = $_REQUEST['txt_ten'];
                $txt_email = $_REQUEST['txt_email'];
                $txt_sdt = $_REQUEST['txt_sdt'];
                $txt_diachi = $_REQUEST['txt_diachi'];
                $txt_pass = $_REQUEST['txt_pass'];
                $txt_tinhTrang = $_REQUEST['txt_tinhTrang'];
                if ($ad->themxoasua("UPDATE khachhang 
                                        SET ho='$txt_hodem',ten='$txt_ten',email='$txt_email',sdt='$txt_sdt',diaChi='$txt_diachi',matKhau='$txt_pass',tinhTrang='$txt_tinhTrang'
                                        WHERE id_kh='$id_kh'") == 1) {
                    echo "<script>
                            swal('Thành công','Cập nhập thành công','success').then(function(){
                                window.location = 'taiKhoan-kh.php';
                            });
                            setTimeOut(function(){
                                window.location = 'taiKhoan-kh.php';
                            }, 2000);
                        </script>";
                } else {
                    echo "<script>alert('Cập nhật tài khoản thất bại');</script>";
                }
            } else if (isset($id_nv) && $id_nv != null) {
                $txt_hodem = $_REQUEST['txt_hodem'];
                $txt_ten = $_REQUEST['txt_ten'];
                $txt_email = $_REQUEST['txt_email'];
                $txt_sdt = $_REQUEST['txt_sdt'];
                $txt_diachi = $_REQUEST['txt_diachi'];
                $txt_pass = $_REQUEST['txt_pass'];
                $txt_tinhTrang = $_REQUEST['txt_tinhTrang'];
                if ($ad->themxoasua("UPDATE nhanvien 
                                        SET hoNV='$txt_hodem',tenNV='$txt_ten',emailNV='$txt_email',sdtNV='$txt_sdt',diaChiNV='$txt_diachi',matKhauNV='$txt_pass',tinhTrang='$txt_tinhTrang'
                                        WHERE id_nv='$id_nv'") == 1) {
                    echo "<script>
                            swal('Thành công','Cập nhập thành công','success').then(function(){
                                window.location = 'taiKhoan-nv.php';
                            });
                            setTimeOut(function(){
                                window.location = 'taiKhoan-nv.php';
                            }, 2000);
                        </script>";
                } else {
                    echo "<script>alert('Cập nhật tài khoản thất bại');</script>";
                }
            } else {
                echo "<script>alert('Không có thông tin tài khoản');</script>";
            }
        }
        ?>

    </form>
</div>
<?php
include_once 'component/footer.php'
?>