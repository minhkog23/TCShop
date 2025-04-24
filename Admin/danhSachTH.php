
<?php
    include '../class/admin.php';
    $ad=new admin();
?>

<?php
include 'component/header.php';
?>

<!-- Page Heading -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Danh sách thương hiệu</h5>
    </div>
    <div class="card-body">
        <a href="add-ThuongHieu.php"><button type="button" class="btn btn-primary btn-sm">Thêm thương hiệu mới</button></a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <form method="post">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên thương hiệu</th>
                            <th style="max-width: 600px;">Mô tả</th>
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
                            $ad->getThuongHieu('select * from thuonghieu order by id_ThuongHieu desc');
                        ?>
                        
                    </tbody>
                </table>

                <?php
                    if(isset($_REQUEST['nut_xoa'])&&$_REQUEST['nut_xoa']=='Xóa')
                    {
                        $id_xoa=$_REQUEST['id_xoa'];
                        echo $id_xoa;
                        if($ad->themxoasua("DELETE FROM thuonghieu WHERE id_ThuongHieu='$id_xoa'")==1)
                        {
                            echo "<script>swal('Thành công','Xóa thương hiệu thành công','success').then(function(){
                                                window.location='danhSachTH.php';
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