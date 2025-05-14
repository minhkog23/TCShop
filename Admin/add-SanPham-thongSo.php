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
    <h4 class="pt-2">TC-Badminton / Sản phẩm</h4>
</div>
<!-- Basic Card Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Thêm thông số sản phẩm</h5>
    </div>
    <div class="card-body">
        <form method="post" enctype="">
            <div class="row">
                <div class="mb-3 col-md-12">
                    <label for="txtthongSo" class="form-label">Nhập thông số sản phẩm <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="txtthongSo" id="txtthongSo" placeholder="Thông số SP ...">
                </div>

                <div class="mb-3 col-md-12 text-center">
                    <a href="danhSachSP.php"><button type="button" class="btn btn-outline-danger ">Quay lại</button></a>
                    <input type="reset" value="Nhập lại" class="btn btn-outline-secondary " name="btn_reset" id="btn_reset">
                    <button type="submit" name="nut_them" value="add-thongSo" class="btn btn-outline-primary">Thêm</button>
                </div>
            </div>
            <div align="center">
                <?php
                if (isset($_REQUEST['nut_them']) && $_REQUEST['nut_them'] == 'add-thongSo') {
                    $thongSo = $_REQUEST['txtthongSo'];
                    if ($_REQUEST['txtthongSo'] == '') {
                        echo '<span id="valthongso" style="display: block; color:red">Vui lòng nhập thông số cần thêm !</span>';
                    // } else if ($ad->checkTrung("select size from size where size like '%$thongSo%'") == 1) {
                    //     echo '<span id="valthongso" style="display: block; color:red">Thông số đã có sẵn. Vui lòng chọn thông số khác!</span>';
                    } else {
                        $sql = "INSERT INTO size(size) VALUES (?)";
                        $params = [$thongSo];
                        $result = $ad->themxoasua($sql, $params);
                        if($result == 1) {
                            echo "<script>
                                    swal('Thành công','Thêm thông số thành công','success').then(function(){
                                            window.location='add-SanPham-thongSo.php';
                                    });
                                    setTimeout(function(){
                                        window.location='add-SanPham-thongSo.php';
                                    }, 2000);
                                </script>";
                        } else {
                            echo "<script>swal('Thất bại','Thêm thông số không thành công','error').then(function(){
                                            window.location='add-SanPham-thongSo.php';
                                })</script>";
                        }
                        // if ($ad->themxoasua("INSERT INTO size(size) VALUES ('$thongSo')") == 1) {
                        //     echo "<script>swal('Thành công','Thêm thông số thành công','success').then(function(){
                        //                         window.location='add-SanPham-thongSo.php';
                        //             });
                        //             setTimeout(function(){
                        //                 window.location='add-SanPham-thongSo.php';
                        //             }, 2000);    
                        //         </script>";
                        // }
                    }
                }
                ?>
            </div>

        </form>

    </div>

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách thông số</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <form action="" method="post">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Thông số</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>Thông số</th>
                            <th>Chức năng</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $ad->getThongSoSP('select * 
                                        from size order by id_size desc');
                        ?>
                    </tbody>
                </table>
                <?php
                if (isset($_REQUEST['nut_xoa']) && $_REQUEST['nut_xoa'] == 'Xóa') {
                    $id_xoa = $_REQUEST['id_xoa'];
                    if ($ad->themxoasua("DELETE FROM size WHERE id_size='$id_xoa'") == 1) {
                        echo "<script>
                                swal('Thành công','Xóa thông số thành công','success').then(function(){
                                        window.location='add-SanPham-thongSo.php';
                                });
                                setTimeout(function(){
                                    window.location='add-SanPham-thongSo.php';
                                }, 2000);
                            </script>";
                    } else {
                        echo "<script>swal('Thất bại','Xóa thông số không thành công','error').then(function(){
                                            window.location='add-SanPham-thongSo.php';
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