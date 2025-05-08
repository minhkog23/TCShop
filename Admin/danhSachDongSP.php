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

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Danh sách dòng sản phẩm</h5>
    </div>
    <div class="card-body">
        <a href="add-dongSanPham.php"><button type="button" class="btn btn-primary btn-sm">Thêm dòng sản phẩm mới</button></a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <form method="post">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Dòng sản phẩm</th>
                            <th>Tên thương hiệu</th>
                            <th>Chứ năng</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>Dòng sản phẩm</th>
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
                if (isset($_REQUEST['nut_xoa']) && $_REQUEST['nut_xoa'] == 'Xóa') {
                    $id_xoa = $_REQUEST['id_xoa'];
                    echo $id_xoa;
                    if ($ad->themxoasua("DELETE FROM dongsanpham WHERE id_dongSP='$id_xoa'") == 1) {
                        echo "<script>swal('Thành công','Xóa dòng sản phẩm thành công','success').then(function(){
                                                window.location='danhSachDongSP.php';
                                    })</script>";
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