<?php
    if (session_status() == PHP_SESSION_NONE) {
    // Nếu chưa bắt đầu session, thì bắt đầu session
    session_start();
    }
    include '../class/login.php';
    $p=new login();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    

    

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <link rel="stylesheet" href="../assets/css/trangchu.css">
    
    <title><?php echo isset($pageTitle) ? $pageTitle : "Trang chủ"; ?></title>
</head>
<body>
    <div class="container-fluid">
        <div class="container pt-2">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-md-3">
                    <a href="index.php"><img src="../assets/img/logo.jpg" class="logo col-md-2" alt="Load"></a>
                </div>
                <div class="search col-md-6 ">
                    <form action="product.php" method="post">
                        <input type="search" name="txtsearch" id="search" placeholder="Tìm kiếm sản phẩm ...">
                        <button name="nut_search" value="search" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>

                <!-- đăng nhập -->
                <div class="user d-flex col-md-3"> 
                     <!--giỏ hàng  -->
                    <button class="icon-cart"><a href="cart.php"><i class="fas fa-shopping-cart" style="font-size: 26px;"></i></a>
                        <?php
                            if(isset($_SESSION['cart_count']))
                            {
                                $count=$_SESSION['cart_count'];
                                echo '<span id="dem_GioHang">'.$count.'</span>';
                            }
                            else
                            {
                                echo '<span id="dem_GioHang">0</span>';
                            }
                        ?>
                        
                    </button>
                    <!-- phần đăng nhập -->
                    <button class="icon-user"><i class="fas fa-user" style="font-size: 26px;"></i>
                    <?php
                        if(isset($_SESSION['id_KH']))
                        {
                            $id_KH=$_SESSION['id_KH'];
                            echo '<div class="logout">
                                    <ul class="dropdownn_logout">
                                        <li><a href="profile.php?loc=order&status=tc">Đơn hàng</a></li>
                                        <li><a href="profile.php?loc=profile">Hồ sơ cá nhân</a></li>
                                        <li><a href="../class/logout">Đăng xuất</a></li>
                                    </ul>
                                </div> ';
                        }
                        else
                        {
                            echo '<div class="login">
                                    <ul class="dropdownn_login">
                                        <li><a href="login.php">Đăng nhập</a></li>
                                        <li><a href="signup.php">Đăng ký</a></li>
                                    </ul>
                                </div>';
                        }
                    ?>
                        
                    </button>
                    <?php
                        if(isset($_SESSION['id_KH']))
                        {
                            $id_KH=$_SESSION['id_KH'];
                            $ten=$p->laycot("select ten from khachhang where id_KH='$id_KH'");
                            echo "<p>Xin chào: <span>$ten</span></p>";
                        }
                        else
                        {
                            echo '<p>Xin chào quý khách</p>';
                        }
                    ?>
                    
                </div>
            </div>
        </div>

        <!-- nav -->
        <div class="menu-nav">
            <div class="container">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Trang chủ</a>
                    </li>
                    <li class="nav-item menu-dropdown">
                        <a class="nav-link" href="#"><i class="fas fa-bars"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Danh mục</a>
                        <div class="menu-dropdown-item">
                            <ul>
                                <?php
                                    $p->getDanhMuc("select * from thuonghieu");
                                ?>
                            </ul>
                        </div> 
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="product.php">Sản phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Tin tức</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Dịch vụ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Liên hệ</a>
                    </li>
                </ul>
            </div>
        </div>