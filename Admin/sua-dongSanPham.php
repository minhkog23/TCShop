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
<div class="alert alert-secondary">
    <h4 class="pt-2">TC-Badminton / Dòng sản phẩm</h4>
</div>
<!-- Basic Card Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Sửa dòng sản phẩm</h5>
        <?php
        $id_sua = $_REQUEST['id_sua'];
        $tenDongSP = $ad->laycot("select tenDongSP from dongsanpham where id_dongSP='$id_sua'");
        $id_ThuongHieu = $ad->laycot("select id_ThuongHieu from dongsanpham where id_dongSP='$id_sua'");
        ?>
    </div>
    <div class="card-body">
        <form method="post">
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="txttendsp" class="form-label">Nhập tên dòng sản phẩm <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="txttendsp" id="txttendsp" value="<?php echo $tenDongSP ?>">
                </div>
                <div class="mb-3 col-md-6">
                    <label for="txttensp" class="form-label">Chọn thương hiệu sản phẩm <span style="color: red">*</span></label>
                    <select name="selectDongSP" class="form-control">
                        <option value="0" selected>Chọn thương hiệu</option>
                        <?php
                        $ad->getThuongHieu_Sua_dsp("select* from thuonghieu", $id_ThuongHieu);
                        ?>
                    </select>
                </div>
                <div class="mb-3 col-md-12 text-center">
                    <a href="danhSachDongSP.php"><button type="button" class="btn btn-outline-danger ">Quay lại</button></a>
                    <input type="reset" value="Nhập lại" class="btn btn-outline-secondary " name="btn_reset" id="btn_reset">
                    <button type="submit" name="nut_sua" value="sua-dsp" class="btn btn-outline-primary">Lưu</button>
                </div>
            </div>
            <div align="center">
                <?php
                if (isset($_REQUEST['nut_sua']) && $_REQUEST['nut_sua'] == 'sua-dsp') {
                    $tendsp = $_REQUEST['txttendsp'];
                    $tenThuongHieu = $_REQUEST['selectDongSP'];
                    echo $tenThuongHieu;
                    if ($tendsp == '' || $tenThuongHieu == '0') {
                        echo '<span id="valDSP" style="display: block; color:red">Vui lòng đầy đủ thông tin !</span>';
                    } else {
                        if ($ad->themxoasua("UPDATE dongsanpham
                                                    SET tenDongSP='$tendsp',id_ThuongHieu='$tenThuongHieu'
                                                    WHERE id_dongSP='$id_sua'") == 1) {
                            echo "<script>swal('Thành công','Sửa dòng sản phẩm thành công','success').then(function(){
                                                    window.location='danhSachDongSP.php';
                                        })</script>";
                        } else {
                            echo "<script>swal('Thất bại','Sửa dòng sản phẩm không thành công','error').then(function(){
                                                    window.location='sua-dongSanPham.php';
                                        })</script>";
                        }
                    }
                }
                ?>
            </div>

        </form>

    </div>

</div>

<?php
include_once 'component/footer.php'
?>