<?php
include '../class/admin.php';
$ad = new admin();
?>
<!-- check role -->
<?php
include '../class/auth.php';
$checkRole = new auth();
if ($checkRole->checkRoleAdmin() == 0) {
    header('location:../index.php');
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
    <h4 class="pt-2">TC-Badminton / Dòng sản phẩm</h4>
</div>
<!-- Basic Card Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Thêm dòng sản phẩm</h5>
    </div>
    <div class="card-body">
        <form method="post">
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="txttendsp" class="form-label">Nhập tên dòng sản phẩm <span style="color: red">*</span></label>
                    <input type="text"  class="form-control" pattern="^[A-Za-zÀ-Ỹà-ỹ\s]+$" title="Không được chứa số" name="txttendsp" id="txttendsp" placeholder="Tên dòng sản phẩm ..." required>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="txttensp" class="form-label">Chọn thương hiệu sản phẩm <span style="color: red">*</span></label>
                    <select name="selectDongSP" class="form-control">
                        <option value="0" selected>Chọn thương hiệu</option>
                        <?php
                        $ad->getThuongHieu_addTH("select* from thuonghieu");
                        ?>
                    </select>
                </div>
                <div class="mb-3 col-md-12 text-center">
                    <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                    <a href="danhSachDongSP.php"><button type="button" class="btn btn-outline-danger ">Quay lại</button></a>
                    <input type="reset" value="Nhập lại" class="btn btn-outline-secondary " name="btn_reset" id="btn_reset">
                    <button type="submit" name="nut_them" value="add-dsp" class="btn btn-outline-primary">Thêm</button>
                </div>
            </div>
            <div align="center">
                <?php
                if (isset($_REQUEST['nut_them']) && $_REQUEST['nut_them'] == 'add-dsp' && $_REQUEST['token'] == $_SESSION['token']) {
                    $tendsp = $_REQUEST['txttendsp'];
                    $tenThuongHieu = $_REQUEST['selectDongSP'];
                    if ($tendsp == '' || $tenThuongHieu == '0') {
                        echo '<span id="valDSP" style="display: block; color:red">Vui lòng đầy đủ thông tin !</span>';
                    } else if ($ad->checkTrung("select tenDongSP from dongsanpham where tenDongSP like '%$tendsp%'") == 1) {
                        echo '<span id="valDSP" style="display: block; color:red">Tên dòng sản phẩm đã có sẵn. Vui lòng nhập dòng sản phẩm khác!</span>';
                    } else {
                        $sql="INSERT INTO dongsanpham(tenDongSP, id_ThuongHieu) VALUES (?,?)";
                        $params = [$tendsp, $tenThuongHieu];
                        $result = $ad->themxoasua($sql, $params);
                        if ($result==1) {
                            echo "<script>
                                    swal('Thành công','Thêm dòng sản phẩm thành công','success').then(function(){
                                                window.location='danhSachDongSP.php';
                                    });
                                    setTimeout(function(){
                                        window.location='danhSachDongSP.php';
                                    }, 2000);
                                </script>";
                        } else {
                            echo "<script>swal('Thất bại','Thêm dòng sản phẩm không thành công','error').then(function(){
                                                    window.location='add-dongSanPham.php';
                                        })</script>";
                        }
                        unset($_SESSION['token']);
                        // if ($ad->themxoasua("INSERT INTO dongsanpham(tenDongSP, id_ThuongHieu) 
                        //                             VALUES ('$tendsp','$tenThuongHieu')") == 1) {
                        //     echo "<script>
                        //             swal('Thành công','Thêm dòng sản phẩm thành công','success').then(function(){
                        //                         window.location='danhSachDongSP.php';
                        //             });
                        //             setTimeout(function(){
                        //                 window.location='danhSachDongSP.php';
                        //             }, 2000);
                        //         </script>";
                        // } else {
                        //     echo "<script>swal('Thất bại','Thêm dòng sản phẩm không thành công','error').then(function(){
                        //                             window.location='add-dongSanPham.php';
                        //                 })</script>";
                        // }
                    }
                }
                else if(isset($_REQUEST['nut_them']) && $_REQUEST['nut_them'] == 'add-dsp' && $_REQUEST['token'] != $_SESSION['token'])
                {
                    echo "<script>swal('Thất bại','Không gửi lại form cũ','error')</script>";
                    unset($_SESSION['token']);
                }
                ?>
            </div>

        </form>

    </div>

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách dòng sản phẩm</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <form method="post">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên dòng sản phẩm</th>
                            <th>Tên thương hiệu</th>
                            <th>Chứ năng</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>Tên dòng sản phẩm</th>
                            <th>Tên thương hiệu</th>
                            <th>Chứ năng</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $ad->getDongSP('SELECT *
                                            FROM dongsanpham dsp JOIN thuonghieu th ON dsp.id_ThuongHieu=th.id_ThuongHieu order by id_dongSP desc');
                        ?>

                    </tbody>
                </table>
                <?php
                if (isset($_REQUEST['nut_xoa']) && $_REQUEST['nut_xoa'] == 'Xóa' && $_REQUEST['token'] == $_SESSION['token']) {
                    $id_xoa = $_REQUEST['id_xoa'];
                    if ($ad->themxoasua("DELETE FROM dongsanpham WHERE id_dongSP='$id_xoa'") == 1) {
                        echo "<script>swal('Thành công','Xóa dòng sản phẩm thành công','success').then(function(){
                                                window.location='add-dongSanPham.php';
                                    })</script>";
                    } else {
                        echo "<script>swal('Thất bại','Xóa dòng sản phẩm không thành công','error').then(function(){
                                            window.location='add-dongSanPham.php';
                                })</script>";
                    }
                    unset($_SESSION['token']);
                }
                else if (isset($_REQUEST['nut_xoa']) && $_REQUEST['nut_xoa'] == 'Xóa' && $_REQUEST['token'] != $_SESSION['token']) {
                    echo "<script>swal('Thất bại','Không gửi lại form cũ','error')</script>";
                    unset($_SESSION['token']);
                }
                ?>
            </form>
        </div>
    </div>

    <?php
    include_once 'component/footer.php'
    ?>