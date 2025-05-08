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
    <h4 class="pt-2">TC-Badminton / Thương hiệu</h4>
</div>
<!-- Basic Card Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Thêm thương hiệu</h5>
    </div>
    <div class="card-body">
        <form method="post">
            <div class="row">
                <div class="mb-3 col-md-12">
                    <label for="txttenth" class="form-label">Nhập tên thương hiệu <span style="color:red">*</span></label>
                    <input type="text" class="form-control" name="txttenth" id="txttenth" placeholder="Thương hiệu ...">
                </div>
                <div class="mb-3 col-md-12">
                    <label for="txtmota" class="form-label">Mô tả</label>
                    <textarea class="form-control" name="txtmota" id="txtmota" rows="7" placeholder="Nhập mô tả ..."></textarea>
                </div>

                <div class="mb-3 col-md-12 text-center">
                    <a href="danhSachTH.php"><button type="button" class="btn btn-outline-danger ">Quay lại</button></a>
                    <input type="reset" value="Nhập lại" class="btn btn-outline-secondary " name="btn_reset" id="btn_reset">
                    <button type="submit" name="nut_them" value="add-TH" class="btn btn-outline-primary">Thêm</button>
                </div>
            </div>
            <div align="center">
                <?php
                if (isset($_REQUEST['nut_them']) && $_REQUEST['nut_them'] == 'add-TH') {
                    $tenThuongHieu = $_REQUEST['txttenth'];
                    $mota = $_REQUEST['txtmota'];
                    if ($_REQUEST['txttenth'] == '') {
                        echo '<span id="valTH" style="display: block; color:red">Vui lòng nhập tên thương hiệu cần thêm !</span>';
                    } else if ($ad->checkTrung("select tenThuongHieu from thuonghieu where tenThuongHieu like '%$tenThuongHieu%'") == 1) {
                        echo '<span id="valTH" style="display: block; color:red">Tên thương hiệu đã có sẵn. Vui lòng nhập tên thương hiệu khác!</span>';
                    } else {
                        if ($ad->themxoasua("INSERT INTO thuonghieu(tenThuongHieu, moTa) 
                                                    VALUES ('$tenThuongHieu','$mota')") == 1) {
                            echo "<script>swal('Thành công','Thêm thương hiệu thành công','success').then(function(){
                                                    window.location='add-ThuongHieu.php';
                                        })</script>";
                        } else {
                            echo "<script>swal('Thất bại','Thêm thương hiệu không thành công','error').then(function(){
                                                    window.location='add-ThuongHieu.php';
                                        })</script>";
                        }
                    }
                }
                ?>
            </div>

        </form>

    </div>

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách thương hiệu</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <form method="post">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên thương hiệu</th>
                            <th style="width: 600px;">Mô tả</th>
                            <th>Chứ năng</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>Tên thương hiệu</th>
                            <th>Mô tả</th>
                            <th>Chứ năng</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $ad->getThuongHieu('select * 
                                            from thuonghieu order by id_ThuongHieu desc');
                        ?>
                    </tbody>
                </table>

                <?php
                if (isset($_REQUEST['nut_xoa']) && $_REQUEST['nut_xoa'] == 'Xóa') {
                    $id_xoa = $_REQUEST['id_xoa'];
                    if ($ad->themxoasua("DELETE FROM thuonghieu WHERE id_ThuongHieu='$id_xoa'") == 1) {
                        echo "<script>swal('Thành công','Xóa thương hiệu thành công','success').then(function(){
                                                    window.location='add-ThuongHieu.php';
                                        })</script>";
                    } else {
                        echo "<script>swal('Thất bại','Xóa thương hiệu không thành công','error').then(function(){
                                                window.location='add-ThuongHieu.php';
                                    })</script>";
                    }
                }
                ?>
            </form>
        </div>
    </div>

    <?php
    include_once 'component/footer.php'
    ?>