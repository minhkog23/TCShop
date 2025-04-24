
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Admin</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="index.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<?php
    if(isset($_SESSION['id_quyen'])&& $_SESSION['id_quyen']!="3")
    {
        echo '<!-- Divider -->
        <hr class="sidebar-divider" >

        <!-- Heading -->
        <div class="sidebar-heading" >
            Chức năng
        </div>
        <!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item" >
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-warehouse"></i>
        <span>Thương hiệu</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Các chức năng:</h6>
            <a class="collapse-item" href="danhSachTH.php">Danh sách</a>
            <a class="collapse-item" href="add-ThuongHieu.php">Thêm thương hiệu mới</a>
        </div>
    </div>
</li>
<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item" >
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
        aria-expanded="true" aria-controls="collapseThree">
        <i class="fas fa-th-list"></i>
        <span>Dòng sản phẩm</span>
    </a>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Các chức năng:</h6>
            <a class="collapse-item" href="danhSachDongSP.php">Danh sách</a>
            <a class="collapse-item" href="add-dongSanPham.php">Thêm dòng sản phẩm</a>
        </div>
    </div>
</li>
<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour"
        aria-expanded="true" aria-controls="collapseFour">
        <i class="fas fa-table-tennis"></i>
        <span>Sản phẩm</span>
    </a>
    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Các chức năng:</h6>
            <a class="collapse-item" href="danhSachSP.php">Danh sách</a>
            <a class="collapse-item" href="add-SanPham.php">Thêm sản phẩm</a>
            <a class="collapse-item" href="add-SanPham-thongSo.php">Thêm thông số</a>
        </div>
    </div>
</li>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsefive"
        aria-expanded="true" aria-controls="collapsefive">
        <i class="far fa-user-circle"></i>
        <span>Quản lý tài khoản</span>
    </a>
    <div id="collapsefive" class="collapse" aria-labelledby="headingfive" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Các chức năng:</h6>
            <a class="collapse-item" href="taiKhoan-nv.php">Tài khoản nhân viên</a>
            <a class="collapse-item" href="taiKhoan-kh.php">Tài khoản khách hàng</a>
        </div>
    </div>
</li>';
    }
?>


<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Quản lý
</div>

<!-- Nav Item - Charts -->
<?php 
    include_once '../class/admin.php';
    $ad=new admin();
    if($_SESSION['id_quyen']!='3')
    {
        echo '<li class="nav-item role">
        <a class="nav-link position-relative" href="danhSachHD.php">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Đơn đặt hàng</span>';
        
                $dcd=$ad->laycot("select count(tinhTrang) from hoadon where tinhTrang='Chờ xử lý'");
                    if($dcd!=0)
                    {
                        echo '<span class="position-absolute translate-middle badge rounded-pill bg-danger">
                                '.$dcd.'
                            </span>';
                    }
                    else
                    {
                        echo '';
                    }
                    echo '</a>       
    </li>';
        
    }
?>


<!-- Nav Item - Tables -->
<?php
    if($_SESSION['id_quyen']=='3')
    {

        echo '<li class="nav-item">
        <a class="nav-link position-relative" href="danhSachGH.php">
        <i class="fas fa-fw fa-table"></i>
        <span>Giao hàng</span>';
            
            $cgh=$ad->laycot("select count(tinhTrang) from hoadon where tinhTrang='Chờ giao hàng'");
                if($cgh!=0)
                {
                    echo '<span class="position-absolute translate-middle badge rounded-pill bg-danger">
                            '.$cgh.'
                        </span>';
                }
                else
                {
                    echo '';
                }      
            echo '</a> 
        </li>';
    }
    else
    {
        echo '';
    }
?>


<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>


</ul>
<!-- End of Sidebar -->