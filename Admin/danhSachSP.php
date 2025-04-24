
<?php
    include '../class/admin.php';
    $ad=new admin();
?>

<?php
include 'component/header.php';
?>
<div class="card">
    
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Danh sách sản phẩm</h5>
    </div>
    <div class="card-body">
        <a href="add-SanPham.php"><button type="button" class="btn btn-primary btn-sm">Thêm sản phẩm mới</button></a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <form method="post">
                
                        <?php
                            $ad->getSP('select * 
                                        from sanpham sp JOIN dongsanpham dsp ON sp.id_dongSP=dsp.id_dongSP
                                                        JOIN thuonghieu th on dsp.id_ThuongHieu=th.id_ThuongHieu
                                        order by id_maSP desc');
                        ?>
                        
                    
                <div class="xuLyXoa">
                    <?php
                        if(isset($_REQUEST['nut_xoa'])&&$_REQUEST['nut_xoa']=='Xóa')
                        {
                            $id_xoa=$_REQUEST['id_xoa'];
                            $anhnen=$ad->laycot("select anh from sanpham where id_maSP='$id_xoa'");
                            $anh1=$ad->laycot("select anh1 from anh_chitietsp where id_maSP='$id_xoa'");
                            $anh2=$ad->laycot("select anh2 from anh_chitietsp where id_maSP='$id_xoa'");
                            $anh3=$ad->laycot("select anh3 from anh_chitietsp where id_maSP='$id_xoa'");
                            $anh4=$ad->laycot("select anh4 from anh_chitietsp where id_maSP='$id_xoa'");
                            echo $id_xoa;
                            if($ad->themxoasua("DELETE FROM sanpham WHERE id_maSP='$id_xoa'")==1)
                            {
                                if(unlink("../main/img/img_product/$anhnen"))
                                {
                                    if($ad->themxoasua("DELETE FROM anh_chitietsp WHERE id_maSP='$id_xoa'")==1)
                                    {
                                        if(isset($anh1)) 
                                        {
                                            unlink("../main/img/img_product/img_product_detail/$anh1");
                                        }
                                        if(isset($anh2)) 
                                        {
                                            unlink("../main/img/img_product/img_product_detail/$anh2");
                                        }
                                        if(isset($anh3)) 
                                        {
                                            unlink("../main/img/img_product/img_product_detail/$anh3");
                                        }
                                        if(isset($anh4)) 
                                        {
                                            unlink("../main/img/img_product/img_product_detail/$anh4");
                                        }
                                        if($ad->themxoasua("DELETE FROM chitietsanpham WHERE id_maSP='$id_xoa'")==1)
                                        {
                                            echo "<script>swal('Thành công','Xóa sản phẩm thành công','success').then(function(){
                                                        window.location='danhSachSP.php';
                                                })</script>";
                                        }
                                    }
                                    
                                }
                                
                            }   
                        }
                    ?>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
include_once 'component/footer.php'
?>