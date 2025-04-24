
<?php
    include '../class/admin.php';
    $ad=new admin();
?>

<?php
include 'component/header.php';
?>
    <div class="text-center mb-4" >
            <h2>Xử lý giao hàng</h2>
        </div>
    <div class="alert alert-primary" role="alert">
        <!-- A simple primary alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like. -->
        <?php
            $cgh=$ad->laycot("select count(tinhTrang) from hoadon where tinhTrang='Chờ giao hàng'");
            $dgh=$ad->laycot("select count(tinhTrang) from hoadon where tinhTrang='Đang giao hàng'");
            $huy=$ad->laycot("select count(tinhTrang) from hoadon where tinhTrang='Hủy'");
            $ht=$ad->laycot("select count(tinhTrang) from hoadon where tinhTrang='Hoàn thành'");
        ?>
        
        <a href="danhSachGH.php?loc=cgh" class="btn btn-warning  position-relative mx-3">
            Chờ giao hàng
            <?php 
                if($cgh!=0)
                {
                    echo '<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            '.$cgh.'
                        </span>';
                }
                else
                {
                    echo '';
                }
                
            ?>
        </a>

        <a href="danhSachGH.php?loc=dgh" class="btn btn-primary position-relative mx-3">
            Đang giao hàng
            <?php 
                if($dgh!=0)
                {
                    echo '<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            '.$dgh.'
                        </span>';
                }
                else
                {
                    echo '';
                }
                
            ?>
        </a>

        <a href="danhSachGH.php?loc=huy" class="btn btn-secondary position-relative mx-3">
            Hủy bỏ
            <?php 
                if($huy!=0)
                {
                    echo '<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            '.$huy.'
                        </span>';
                }
                else
                {
                    echo '';
                }
                
            ?>
        </a>
        <a href="danhSachGH.php?loc=ht" class="btn btn-success position-relative mx-3">
            Hoàn thành
            <?php 
                // if($ht!=0)
                // {
                //     echo '<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                //             '.$ht.'
                //         </span>';
                // }
                // else
                // {
                //     echo '';
                // }
                
            ?>
        </a>
        
    </div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Danh sách đơn hàng</h5>
    </div>
    <!-- <div class="card-body">
        <a href="add-ThuongHieu.php"><button type="button" class="btn btn-primary btn-sm">Thêm mới</button></a>
    </div> -->
    <div class="card-body">
        <div class="table-responsive">
            <form method="post">
                        <!-- Xử lý trạng thái 'Chờ xử lý' -->
                        <?php
                            if(isset($_REQUEST['loc'])&&$_REQUEST['loc']=='cgh')
                            {
                                $ad->getHD_cgh('select * from hoadon where tinhtrang="Chờ giao hàng" order by id_HD desc');
                                if(isset($_REQUEST['nut_gh'])&&$_REQUEST['nut_gh']=='Giao hàng')
                                {
                                    $id_gh=$_REQUEST['id_gh'];
                                    $id_nv_giaoHang=$_REQUEST['id_nv_giaoHang'];
                                    if(isset($id_nv_giaoHang) && $id_nv_giaoHang!='0')
                                    {
                                        if($ad->themxoasua("UPDATE hoadon 
                                                        SET tinhTrang='Đang giao hàng', id_NV_giaoHang='$id_nv_giaoHang'
                                                        WHERE id_HD='$id_gh'")==1)
                                        {
                                            echo "<script>swal('Thành công','Đơn hàng sẽ được giao.','success').then(function(){
                                                            window.location='danhSachGH.php?loc=dgh';
                                                })</script>";
                                        }

                                    }
                                    else
                                    {
                                        echo "<script>swal('Thất bại','Vui lòng chọn nhân viên giao hàng.','error')</script>";
                                    }
                                    
                                }
                                
                            }
                            // xử lý giao hàng
                            else if(isset($_REQUEST['loc'])&&$_REQUEST['loc']=='dgh')
                            {
                                $ad->getHD_dgh('select * from hoadon where tinhtrang="Đang giao hàng" order by id_HD desc');
                                if(isset($_REQUEST['nut_hoanthanh'])&&$_REQUEST['nut_hoanthanh']=='Xong')
                                {
                                    $id_dgh=$_REQUEST['id_dgh'];
                                    $ngayHienTai=date('Y-m-d H:i:s');
                                    if($ad->themxoasua("UPDATE hoadon 
                                                        SET ngayGiao='$ngayHienTai', tinhTrang='Hoàn thành'
                                                        WHERE id_HD='$id_dgh'")==1)
                                    {
                                        echo "<script>swal('Thành công','Giao hàng thành công.','success').then(function(){
                                                        window.location='danhSachGH.php?loc=cgh';
                                            })</script>";
                                    }
                                }
                                // xử lý hủy đơn hàng
                                // else
                                // if(isset($_REQUEST['nut_huy'])&&$_REQUEST['nut_huy']=='Hủy')
                                // {
                                //     $id_huy=$_REQUEST['id_huy'];
                                //     if($ad->themxoasua("UPDATE hoadon 
                                //                         SET tinhTrang='Hủy'
                                //                         WHERE id_HD='$id_huy'")==1)
                                //     {
                                //         echo "<script>swal('Thành công','Đơn hàng đã được hủy.','success').then(function(){
                                //                         window.location='danhSachGH.php?loc=huy';
                                //             })</script>";
                                //     }
                                // }
                            }
                            else if(isset($_REQUEST['loc'])&&$_REQUEST['loc']=='huy')
                            {
                                $ad->getHD_huy('select * from hoadon where tinhtrang="Hủy bỏ" order by id_HD desc');
                            }
                            else if(isset($_REQUEST['loc'])&&$_REQUEST['loc']=='ht')
                            {
                                $ad->getHD_ht('select * from hoadon where tinhtrang="Hoàn thành" order by id_HD desc');
                            }
                            else
                            {
                                //$ad->getHD('select * from hoadon order by id_HD desc');
                                echo '<h3 align="center">Không có đơn hàng nào cần xử lý </h3>';
                            }
                            
                            //$ad->getHD('select * from hoadon order by id_HD desc');
                        ?>
                        


                <?php
                    if(isset($_REQUEST['nut_xoa'])&&$_REQUEST['nut_xoa']=='Xóa')
                    {
                        $id_xoa=$_REQUEST['id_xoa'];
                        echo $id_xoa;
                        if($ad->themxoasua("DELETE FROM hoadon WHERE id_HD='$id_xoa'")==1)
                        {
                            echo "<script>swal('Thành công','Xóa thành công','success').then(function(){
                                                window.location='danhSachHD.php';
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