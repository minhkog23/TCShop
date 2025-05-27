<?php
if (session_status() == PHP_SESSION_NONE) {
    // Nếu chưa bắt đầu session, thì bắt đầu session
    session_start();
}
include 'class/login.php';
$p = new login();
include_once 'class/badminton.php';
$bad = new badminton();
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

    <link rel="stylesheet" href="assets/css/trangchu.css">

    <title><?php echo isset($pageTitle) ? $pageTitle : "Trang chủ"; ?></title>
</head>

<body>
    <div class="container-fluid">
        <div class="container pt-2">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-md-3">
                    <a href="index.php"><img src="assets/img/logo.jpg" class="logo col-md-2" alt="Load"></a>
                </div>
                <div class="search col-md-6 ">
                    <form action="Customer/product.php" method="post">
                        <input type="search" name="txtsearch" id="search" placeholder="Tìm kiếm sản phẩm ...">
                        <button name="nut_search" value="search" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>

                <!-- đăng nhập -->
                <div class="user d-flex col-md-3">
                    <!--giỏ hàng  -->
                    <button class="icon-cart"><a href="cart.php"><i class="fas fa-shopping-cart" style="font-size: 26px;"></i></a>
                        <?php
                        if (isset($_SESSION['cart_count'])) {
                            $count = $_SESSION['cart_count'];
                            echo '<span id="dem_GioHang">' . $count . '</span>';
                        } else {
                            echo '<span id="dem_GioHang">0</span>';
                        }
                        ?>

                    </button>
                    <!-- phần đăng nhập -->
                    <button class="icon-user"><i class="fas fa-user" style="font-size: 26px;"></i>
                        <?php
                        if (isset($_SESSION['id_KH'])) {
                            $id_KH = $_SESSION['id_KH'];
                            echo '<div class="logout">
                                    <ul class="dropdownn_logout">
                                        <li><a href="Customer/profile.php?loc=order&status=tc">Đơn hàng</a></li>
                                        <li><a href="Customer/profile.php?loc=profile">Hồ sơ cá nhân</a></li>
                                        <li><a href="class/logout">Đăng xuất</a></li>
                                    </ul>
                                </div> ';
                        } else {
                            echo '<div class="login">
                                    <ul class="dropdownn_login">
                                        <li><a href="Customer/login.php">Đăng nhập</a></li>
                                        <li><a href="Customer/signup.php">Đăng ký</a></li>
                                    </ul>
                                </div>';
                        }
                        ?>

                    </button>
                    <?php
                    if (isset($_SESSION['id_KH'])) {
                        $id_KH = $_SESSION['id_KH'];
                        $ten = $p->laycot("select ten from khachhang where id_KH='$id_KH'");
                        echo "<p>Xin chào: <span>$ten</span></p>";
                    } else {
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
                        <a class="nav-link" href="Customer/product.php">Sản phẩm</a>
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
        <div class="container slider">
            <!-- Carousel -->
            <div id="demo" class="carousel slide" data-bs-ride="carousel">

                <!-- Indicators/dots -->
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
                </div>

                <!-- The slideshow/carousel -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="assets/img/slide/1.jpg" alt="Los Angeles">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/img/slide/2.jpg" alt="Chicago">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/img/slide/3.jpg" alt="New York">
                    </div>
                </div>

                <!-- Left and right controls/icons -->
                <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>
        <!-- Sản phẩm nổi bật -->
        <div class="container mt-5">
            <div class="section-title text-center mb-4">
                <h2>SẢN PHẨM NỔI BẬT</h2>
                <p class="text-muted">Những sản phẩm cầu lông chất lượng cao</p>
            </div>
            <div class="row">
                <?php
                $config = '.env';
                $dbConfig = parse_ini_file($config);
                $con = mysqli_connect($dbConfig['DB_HOST'], $dbConfig['DB_USER'], $dbConfig['DB_PASS'], $dbConfig['DB_NAME']);
                $sql = "SELECT * FROM sanpham where id_SPTB=1";
                // Sử dụng mysqli_prepare để tránh SQL injection
                $result = $con->prepare($sql);
                $result->execute();
                $result = $result->get_result();
                while ($row = $result->fetch_assoc()) {
                    $id_maSP = $row['id_maSP'];
                    $tenSP = $row['tenSP'];
                    $donGia = $row['donGia'];
                    $anh = $row['anh'];
                    $gia_ban = number_format($row['donGia'], 0, ',', '.');
                    echo '<div class="col-md-3 mb-4">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="assets/img/img_product/' . $anh . '" alt="Vợt cầu lông Yonex" width="300px" height="350px">
                            <div class="product-overlay">
                                <a href="Customer/product_detail.php?maSP=' . $id_maSP . '" class="btn btn-primary">Xem chi tiết</a>
                            </div>
                        </div>
                        <div class="product-info p-3">
                            <h5>' . $tenSP . '</h5>
                            <div class="price">
                                <span class="current-price">' . $gia_ban . 'đ</span>
                            </div>
                        </div>
                    </div>
                </div>';
                }
                ?>
            </div>
            <div class="text-center mt-4">
                <a href="Customer/product.php" class="btn btn-outline-primary btn-lg">Xem tất cả sản phẩm</a>
            </div>
        </div>



        <!-- Tin tức & Bài viết -->
        <div class="container mt-5">
            <div class="section-title text-center mb-4">
                <h2>TIN TỨC & BÀI VIẾT</h2>
                <p class="text-muted">Cập nhật những thông tin mới nhất về cầu lông</p>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="news-card">
                        <img src="assets/img/news/Bedminton.jpg" alt="Tin tức 1" width="300px" height="400px" class="ms-5">
                        <div class="news-content p-3">
                            <span class="news-date">15/01/2024</span>
                            <h5>Hướng dẫn chọn vợt cầu lông phù hợp cho người mới bắt đầu</h5>
                            <p>Việc chọn một cây vợt phù hợp là rất quan trọng đối với người mới chơi cầu lông...</p>
                            <a href="#" class="read-more">Đọc thêm</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="news-card">
                        <img src="assets/img/news/Bedminton.jpg" alt="Tin tức 2" width="300px" height="400px" class="ms-5">
                        <div class="news-content p-3">
                            <span class="news-date">12/01/2024</span>
                            <h5>Top 5 kỹ thuật cơ bản trong cầu lông</h5>
                            <p>Cầu lông là môn thể thao đòi hỏi kỹ thuật cao. Dưới đây là 5 kỹ thuật cơ bản...</p>
                            <a href="#" class="read-more">Đọc thêm</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="news-card">
                        <img src="assets/img/news/Bedminton.jpg" alt="Tin tức 3" width="300px" height="400px" class="ms-5">
                        <div class="news-content p-3">
                            <span class="news-date">10/01/2024</span>
                            <h5>Cách bảo quản vợt cầu lông đúng cách</h5>
                            <p>Để vợt cầu lông có tuổi thọ cao và luôn trong tình trạng tốt nhất...</p>
                            <a href="#" class="read-more">Đọc thêm</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section6">
            <div class="container">
                <div class="section6-form">
                    <div class="section6-form-text">
                        <h3 align="center">PHƯƠNG THỨC THANH TOÁN</h3>
                        <p>Quý khách thanh toán Ship COD khi nhận hàng
                            hoặc thanh toán online qua tài khoản ngân hàng, Visa, Paypal, Master Card...</p>
                    </div>
                    <div class="section6-form-text">
                        <h3 align="center">HÀNG CHÍNH HÃNG</h3>
                        <p>Sản phẩm đảm bảo chất lượng được phân phối trực tiếp chính hãng.</p>
                    </div>
                    <div class="section6-form-text">
                        <h3 align="center">HỖ TRỢ 24/7</h3>
                        <p>Đội ngũ bán hàng và kỹ thuật viên luôn sẵn sàng hỗ trợ quý khách.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="footer">
                <div class="footer-form row">
                    <div class="footer-form-nav col-md-3 text-center">
                        <h3>TC Badminton</h3>
                        <ul>
                            <li><a href="#">Giới thiệu về TC Badminton</a></li>
                            <li><a href="#">Tuyển dụng</a></li>
                        </ul>
                    </div>
                    <div class="footer-form-nav col-md-3 text-center">
                        <h3>QUY ĐỊNH & CHÍNH SÁCH</h3>
                        <ul>
                            <li><a href="#">Chính sách bảo mật thông tin</a></li>
                            <li><a href="#">Phương thức thanh toán</a></li>
                            <li><a href="#">Phương thức vận chuyển</a></li>
                            <li><a href="#">Chính sách đổi trả</a></li>
                        </ul>
                    </div>
                    <div class="footer-form-img col-md-3 text-center">
                        <h3>HỢP TÁC VÀ LIÊN KẾT</h3>
                        <img src="assets/img/logoBCT.png" alt="">
                    </div>
                    <div class="footer-form-img col-md-3 text-center">
                        <h3>PHƯƠNG THỨC THANH TOÁN</h3>
                        <img src="assets/img/thanh-toan.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>