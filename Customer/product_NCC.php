<?php
    include_once '../class/khachhang.php';
    $kh=new khachhang();
?>
<!-- header -->
<?php 
    $pageTitle='Sản phẩm theo danh mục'; 
    include_once 'component/header.php' 
?>
<link rel="stylesheet" href="../main/css/product.css">
<!-- Đường dẫn -->
    
    <?php
        if(isset($_REQUEST['id_ThuongHieu']) && isset($_REQUEST['id_dongSP']))
        {
            $id_ThuongHieu=$_REQUEST['id_ThuongHieu'];
            $id_dongSP=$_REQUEST['id_dongSP'];
            $tenThuongHieu=$kh->laycot("select tenThuongHieu from thuonghieu where id_ThuongHieu=$id_ThuongHieu");
            $tenDongSP=$kh->laycot("select tenDongSP from dongsanpham where id_dongSP=$id_dongSP");
        }
        else //(isset($_REQUEST['id_ThuongHieu']))
        {
            $id_ThuongHieu=$_REQUEST['id_ThuongHieu'];
            $tenThuongHieu=$kh->laycot("select tenThuongHieu from thuonghieu where id_ThuongHieu=$id_ThuongHieu");
        }
    ?>
    <div class="">
        <div class="duongdan">
            <a href="index.php">Trang chủ / </a>
            <a href="product.php">Tất cả sản phẩm /</a>
            <span>Vợt cầu lông <?php echo $tenThuongHieu?></span>
        </div>
    </div>

    <!-- card -->
    <div class="container">
        <div class="column">
            <p align='center'>Danh mục</p>
            <ul class="nav flex-column">
                <?php
                    $kh->getNCC('select* from thuonghieu');
                ?>
            </ul>
        </div>

        <!-- <div class="title">
            <h3 class="pt-3 pb-3" align="center">Tất cả sản phẩm</h3>
        </div> -->

        <!-- dong san pham theo tung nha cung cap-->
        <div class="category row pt-5 mb-3">
            <?php
                $kh->getDongSanPham("select* from dongsanpham where id_ThuongHieu=$id_ThuongHieu");
            ?>

        </div>
        <div class="dsp mb-3">
            <?php
                if(isset($_REQUEST['id_ThuongHieu']) && isset($_REQUEST['id_dongSP']))
                {
                    echo '<p class="" align="left">Sản phẩm của <span> '.$tenThuongHieu.'</span> <span>/ '.$tenDongSP.'</span></p>';
                }
                else //(isset($_REQUEST['id_ThuongHieu']))
                {
                    echo '<p class="" align="left">Sản phẩm của <span> '.$tenThuongHieu.'</span></p>';
                }
            ?>
            
        </div>
        
        <!-- lọc sản phẩm theo dòng sản phẩm -->
        <div class="box row">
            
                <?php
                    if(isset($id_ThuongHieu) && isset($_REQUEST['id_dongSP']))
                    {
                        $id_dongSP=$_REQUEST['id_dongSP'];
                        $kh->getSP("select* from sanpham where id_dongSP=$id_dongSP");
                    }
                    else if(isset($id_ThuongHieu))
                    {
                        $kh->getSP("SELECT * 
                                    FROM sanpham sp INNER JOIN dongsanpham dsp on sp.id_dongSP=dsp.id_dongSP
                                                    INNER JOIN thuonghieu ncc on dsp.id_ThuongHieu=ncc.id_ThuongHieu
                                    where ncc.id_ThuongHieu=$id_ThuongHieu");
                    }
                    else
                    {
                        $kh->getSP("select* from sanpham");
                    }
                    
                ?>
        </div>
        
            
    </div>
    <!-- footer -->
<?php include_once 'component/footer.php' ?>