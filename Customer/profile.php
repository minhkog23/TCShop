<?php
include '../class/khachhang.php';
$kh = new khachhang();
?>

<?php
// Danh sách giá trị loc hợp lệ
$ar = ['profile', 'resetPass', 'order', 'cxl'];

// Lấy loc từ URL
$loc = isset($_REQUEST['loc']) ? $_REQUEST['loc'] : '';

// Nếu loc không hợp lệ → chuyển về cxl
if (!in_array($loc, $ar)) {
    header('location: profile.php?loc=profile');
    exit;
}

// Danh sách giá trị status hợp lệ
// $ar1 = ['tc','cxn', 'dxl', 'dgh', 'dg', 'huy'];

// // Lấy loc từ URL
// $status = isset($_REQUEST['status']) ? $_REQUEST['status'] : '';

// // Nếu loc không hợp lệ → chuyển về cxl
// if (!in_array($status, $ar1)) {
//     header('location: profile.php?loc=profile?status=tc');
//     exit;
// }
?>
<?php
include_once 'component/header.php';
?>
<style>
    .statusDH a {
        text-decoration: none;
        color: #000;
        padding: 5px 10px;
        border-radius: 5px;
        background-color: #f8f9fa;
        margin: 0px 10px;
    }
</style>
<div class="container py-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="text-center mb-4">
                <h6 class="mt-2 mb-0">Xin chào: Test</h6>
            </div>
            <div class="list-group">
                <a href="?loc=profile" class="list-group-item list-group-item-action">Hồ Sơ</a>
                <a href="?loc=resetPass" class="list-group-item list-group-item-action">Đổi Mật Khẩu</a>
                <a href="?loc=order&status=tc" class="list-group-item list-group-item-action">Đơn hàng</a>
            </div>
        </div>

        <?php
        if (isset($_SESSION['id_KH'])) {
            $id_kh = $_SESSION['id_KH'];
            $ho = $kh->laycot("select ho from khachhang where id_kh='$id_kh'");
            $ten = $kh->laycot("select ten from khachhang where id_kh='$id_kh'");
            $email = $kh->laycot("select email from khachhang where id_kh='$id_kh'");
            $sdt = $kh->laycot("select sdt from khachhang where id_kh='$id_kh'");
            $diachi = $kh->laycot("select diaChi from khachhang where id_kh='$id_kh'");
        }

        ?>
        <div class="col-md-9">
            <div class="border rounded p-4 bg-white shadow-sm">
                <!-- Profile Form -->
                <div class="formProfile" style="display: <?php echo isset($_REQUEST['loc']) && $_REQUEST['loc'] != 'profile' ? 'none' : 'block'; ?>;">
                    <h5>Hồ Sơ Của Tôi</h5>
                    <form method="POST">
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="col-form-label">Họ <span style="color:red">*</span></label>
                                <input type="text" pattern="^[A-Za-zÀ-Ỹà-ỹ\s]+$" title="Không được chứa số" value="<?php echo $ho; ?>" class="form-control" name="txt_hodem" id="txt_hodem" required>
                            </div>
                            <div class="col-sm-6">
                                <label class="col-form-label">Tên <span style="color:red">*</span></label>
                                <input type="text" pattern="^[A-Za-zÀ-Ỹà-ỹ\s]+$" title="Không được chứa số" class="form-control" value="<?php echo $ten; ?>" name="txt_ten" id="txt_ten" required>
                            </div>

                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Email <span style="color:red">*</span></label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" name="txtemail" value="<?php echo $email; ?>" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Số điện thoại <span style="color:red">*</span></label>
                            <div class="col-sm-10">
                                <input type="tel" pattern="[0-9]{10}" title="Số điện thoại 10 chữ số (VD: 0987654321)" class="form-control" value="<?php echo $sdt; ?>" id="txt_sdt" name="txtsdt" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Địa chỉ <span style="color:red">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="txtdiachi" value="<?php echo $diachi; ?>" required>
                            </div>
                        </div>

                        <div class="text-end">
                            <input type="submit" value="Cập nhập" class="btn btn-primary btn-sm px-4" name="btn_capNhap">
                        </div>
                    </form>

                </div>
                <div>
                    <?php
                    if (isset($_REQUEST['btn_capNhap']) && $_REQUEST['btn_capNhap'] == "Cập nhập") {
                        if (
                            isset($_REQUEST['txt_hodem']) && $_REQUEST['txt_hodem'] != "" && isset($_REQUEST['txt_ten']) && $_REQUEST['txt_ten'] != ""
                            && isset($_REQUEST['txtemail']) && $_REQUEST['txtemail'] != "" && isset($_REQUEST['txtsdt']) && $_REQUEST['txtsdt'] != "" && isset($_REQUEST['txtdiachi'])
                            && $_REQUEST['txtdiachi'] != ""
                        ) {
                            $ho = $_REQUEST['txt_hodem'];
                            $ten = $_REQUEST['txt_ten'];
                            $email = $_REQUEST['txtemail'];
                            $sdt = $_REQUEST['txtsdt'];
                            $diachi = $_REQUEST['txtdiachi'];
                            //Cập nhật thông tin khách hàng
                            if ($kh->themxoasua("UPDATE khachhang SET ho='$ho', ten='$ten', email='$email', sdt='$sdt', diaChi='$diachi' WHERE id_kh='$id_kh'") == 1) {
                                // Cập nhật thành công
                                echo "<script>
                                            swal('Thành công','Cập nhập thành công','success').then(function(){
                                                window.location.href='profile.php?loc=profile';
                                            });
                                            setTimeout(function(){
                                                window.location.href='profile.php?loc=profile';
                                            }, 2000);
                                    </script>";
                            } else {
                                // Cập nhật thất bại
                                echo "<script>alert('Cập nhật thất bại!');</script>";
                            }
                        } else {
                            // Không có dữ liệu để cập nhật
                            echo "<script>alert('Vui lòng nhập đầy đủ thông tin!');</script>";
                        }
                    }
                    ?>
                </div>

                <!-- reset pass -->
                <div class="formResetPass" style="display: <?php echo isset($_REQUEST['loc']) && $_REQUEST['loc'] != 'resetPass' ? 'none' : 'block'; ?>;">
                    <h5>Đổi Mật Khẩu</h5>
                    <p class="text-muted">Để bảo mật tài khoản, vui lòng không chia sẻ mật khẩu cho người khác</p>
                    <form method="POST">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Mật khẩu hiện tại <span style="color:red">*</span></label>
                            <div class="col-sm-9">
                                <input type="password" name="old_password" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Mật khẩu mới <span style="color:red">*</span></label>
                            <div class="col-sm-9">
                                <input type="password" name="new_password" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Xác nhận mật khẩu mới <span style="color:red">*</span></label>
                            <div class="col-sm-9">
                                <input type="password" name="confirm_password" class="form-control" required>
                            </div>
                        </div>

                        <div class="text-end">
                            <input type="submit" value="Lưu" class="btn btn-primary btn-sm px-4" name="btn_luu">
                        </div>
                    </form>
                </div>
                <div>
                    <?php
                    if (isset($_REQUEST['btn_luu']) && $_REQUEST['btn_luu'] == "Lưu") {
                        if (
                            isset($_REQUEST['old_password']) && $_REQUEST['old_password'] != "" && isset($_REQUEST['new_password']) && $_REQUEST['new_password'] != ""
                            && isset($_REQUEST['confirm_password']) && $_REQUEST['confirm_password'] != ""
                        ) {
                            $old_pass = md5($_REQUEST['old_password']);
                            $new_pass = md5($_REQUEST['new_password']);
                            $confirm_pass = md5($_REQUEST['confirm_password']);
                            // Kiểm tra mật khẩu cũ có đúng không
                            if ($kh->checkTrung("select matKhau from khachhang where id_kh='$id_kh' and matKhau='$old_pass'") == 1) {
                                // Kiểm tra mật khẩu mới và xác nhận mật khẩu mới
                                if ($new_pass == $confirm_pass) {
                                    if ($kh->themxoasua("UPDATE khachhang SET matKhau='$new_pass' WHERE id_kh='$id_kh'") == 1) {
                                        echo "<script>
                                            swal('Thành công','Đổi mật khẩu thành công','success').then(function(){
                                                window.location.href='profile.php?loc=resetPass';
                                            });
                                            setTimeout(function(){
                                                window.location.href='profile.php?loc=resetPass';
                                            }, 2000);
                                        </script>";
                                    } else {
                                        echo "<script>alert('Đổi mật khẩu thất bại!');</script>";
                                    }
                                } else {
                                    echo "<script>alert('Mật khẩu mới và xác nhận mật khẩu không giống nhau!');</script>";
                                }
                            } else {
                                echo "<script>alert('Mật khẩu hiện tại không đúng!');</script>";
                            }
                        } else {
                            echo "<script>alert('Vui lòng nhập đầy đủ thông tin!');</script>";
                        }
                    }
                    ?>
                </div>

                <!-- form đơn hàng  -->
                <div class="formDonHang" style="display: <?php echo isset($_REQUEST['loc']) && $_REQUEST['loc'] != 'order' ? 'none' : 'block'; ?>;">
                    <h5 class="mb-4">Lịch Sử Mua Hàng</h5>
                    <!-- Bộ lọc -->
                    <div class="mb-4">
                        <div class="statusDH btn-group" role="group" aria-label="Trạng thái đơn hàng">
                            <a href="?loc=order&status=tc" class="btn btn-light">Tất cả</a>
                            <a href="?loc=order&status=cxl" class="btn btn-light">
                                Chờ xử lý 
                                <?php
                                    $cxl=$kh->laycot("select count(tinhTrang) from hoadon where tinhTrang='Chờ xử lý' and id_KH='$id_kh'");
                                    if($cxl!=0)
                                    {
                                        echo '<span class="badge bg-secondary">'.$cxl.'</span>';
                                    }
                                    else
                                    {
                                        echo '<span class="badge bg-secondary">0</span>';
                                    }
                                ?>
                            </a> 
                            <a href="?loc=order&status=dxn" class="btn btn-light">
                                Đã xác nhận 
                                <?php
                                    $dxn=$kh->laycot("select count(tinhTrang) from hoadon where tinhTrang='Đã xác nhận' and id_KH='$id_kh'");
                                    if($dxn!=0)
                                    {
                                        echo '<span class="badge bg-secondary">'.$dxn.'</span>';
                                    }
                                    else
                                    {
                                        echo '<span class="badge bg-secondary">0</span>';
                                    }
                                ?>
                            </a> 

                            <a href="?loc=order&status=cbh" class="btn btn-light">
                                Đang chuẩn bị hàng 
                                <?php
                                    $cbh=$kh->laycot("select count(tinhTrang) from hoadon where tinhTrang='Đang chuẩn bị hàng' and id_KH='$id_kh'");
                                    if($cbh!=0)
                                    {
                                        echo '<span class="badge bg-secondary">'.$cbh.'</span>';
                                    }
                                    else
                                    {
                                        echo '<span class="badge bg-secondary">0</span>';
                                    }
                                ?>
                            </a>

                            <a href="?loc=order&status=dgh" class="btn btn-light">
                                Đang giao hàng 
                                <?php
                                    $dgh=$kh->laycot("select count(tinhTrang) from hoadon where tinhTrang='Đang giao hàng' and id_KH='$id_kh'");
                                    if($dgh!=0)
                                    {
                                        echo '<span class="badge bg-secondary">'.$dgh.'</span>';
                                    }
                                    else
                                    {
                                        echo '<span class="badge bg-secondary">0</span>';
                                    }
                                ?>
                            </a>
                            <a href="?loc=order&status=dg" class="btn btn-light">Đã giao</a>
                            <a href="?loc=order&status=huy" class="btn btn-light">Đã huỷ</a>


                        </div>
                    </div>
                    <form action="" method="post">
                        <?php
                        // Lấy danh sách đơn hàng từ cơ sở dữ liệu
                        if (isset($_REQUEST['status']) && $_REQUEST['status'] == "tc") {
                            $kh->getDonHang("SELECT hd.id_HD, hd.id_KH, hd.ngayDat, hd.ngayGiao, hd.tongTien, hd.tinhTrang, hd.id_NV_giaoHang, sp.tenSP, cthd.soLuong, sp.anh FROM hoadon hd JOIN chitiethoadon cthd ON hd.id_HD=cthd.id_HD JOIN sanpham sp ON cthd.id_maSP=sp.id_maSP where hd.id_KH='$id_kh' order by hd.id_HD desc");
                        } else if (isset($_REQUEST['status']) && $_REQUEST['status'] == "cxl") {
                            $kh->getDonHang("SELECT hd.id_HD, hd.id_KH, hd.ngayDat, hd.ngayGiao, hd.tongTien, hd.tinhTrang, hd.id_NV_giaoHang, sp.tenSP, cthd.soLuong, sp.anh FROM hoadon hd JOIN chitiethoadon cthd ON hd.id_HD=cthd.id_HD JOIN sanpham sp ON cthd.id_maSP=sp.id_maSP where hd.id_KH='$id_kh' and tinhTrang='Chờ xử lý' order by hd.id_HD desc");
                        }
                        else if (isset($_REQUEST['status']) && $_REQUEST['status'] == "dxn") {
                            $kh->getDonHang("SELECT hd.id_HD, hd.id_KH, hd.ngayDat, hd.ngayGiao, hd.tongTien, hd.tinhTrang, hd.id_NV_giaoHang, sp.tenSP, cthd.soLuong, sp.anh FROM hoadon hd JOIN chitiethoadon cthd ON hd.id_HD=cthd.id_HD JOIN sanpham sp ON cthd.id_maSP=sp.id_maSP where hd.id_KH='$id_kh' and tinhTrang='Đã xác nhận' order by hd.id_HD desc");
                        } 
                        else if (isset($_REQUEST['status']) && $_REQUEST['status'] == "cbh") {
                            $kh->getDonHang("SELECT hd.id_HD, hd.id_KH, hd.ngayDat, hd.ngayGiao, hd.tongTien, hd.tinhTrang, hd.id_NV_giaoHang, sp.tenSP, cthd.soLuong, sp.anh FROM hoadon hd JOIN chitiethoadon cthd ON hd.id_HD=cthd.id_HD JOIN sanpham sp ON cthd.id_maSP=sp.id_maSP where hd.id_KH='$id_kh' and tinhTrang='Đang chuẩn bị hàng' order by hd.id_HD desc");
                        } else if (isset($_REQUEST['status']) && $_REQUEST['status'] == "dgh") {
                            $kh->getDonHang("SELECT hd.id_HD, hd.id_KH, hd.ngayDat, hd.ngayGiao, hd.tongTien, hd.tinhTrang, hd.id_NV_giaoHang, sp.tenSP, cthd.soLuong, sp.anh FROM hoadon hd JOIN chitiethoadon cthd ON hd.id_HD=cthd.id_HD JOIN sanpham sp ON cthd.id_maSP=sp.id_maSP where hd.id_KH='$id_kh' and tinhTrang='Đang giao hàng' order by hd.id_HD desc");
                        } else if (isset($_REQUEST['status']) && $_REQUEST['status'] == "dg") {
                            $kh->getDonHang("SELECT hd.id_HD, hd.id_KH, hd.ngayDat, hd.ngayGiao, hd.tongTien, hd.tinhTrang, hd.id_NV_giaoHang, sp.tenSP, cthd.soLuong, sp.anh FROM hoadon hd JOIN chitiethoadon cthd ON hd.id_HD=cthd.id_HD JOIN sanpham sp ON cthd.id_maSP=sp.id_maSP where hd.id_KH='$id_kh' and tinhTrang='Hoàn thành' order by hd.id_HD desc");
                        } else if (isset($_REQUEST['status']) && $_REQUEST['status'] == "huy") {
                            $kh->getDonHang("SELECT hd.id_HD, hd.id_KH, hd.ngayDat, hd.ngayGiao, hd.tongTien, hd.tinhTrang, hd.id_NV_giaoHang, sp.tenSP, cthd.soLuong, sp.anh FROM hoadon hd JOIN chitiethoadon cthd ON hd.id_HD=cthd.id_HD JOIN sanpham sp ON cthd.id_maSP=sp.id_maSP where hd.id_KH='$id_kh' and tinhTrang='Hủy' order by hd.id_HD desc");
                        }
                        ?>
                    </form>
                    <?php
                        if(isset($_REQUEST['nut_huy']) && $_REQUEST['nut_huy']!='')
                        {
                            if(isset($_REQUEST['id_hd'])&&$_REQUEST['id_hd']!='')
                            {
                                $id_hd=$_REQUEST['id_hd'];
                                echo $id_hd;
                                if($kh->themxoasua("UPDATE hoadon SET tinhTrang='Hủy' WHERE id_HD=$id_hd")==1)
                                {
                                    echo "<script>
                                            swal('Thành công','Bạn đã hủy thành công đơn hàng','success').then(function(){
                                                window.location= 'profile.php?loc=order&status=tc';
                                            });
                                            setTimeout(function(){
                                                window.location= 'profile.php?loc=order&status=tc';
                                            }, 2000);
                                        </script>";
                                }
                            }
                            
                        }        
                    ?>
                </div>

            </div>

        </div>
    </div>
</div>





<?php
include_once 'component/footer.php';
?>