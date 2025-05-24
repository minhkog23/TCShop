        <!-- Header -->
        <?php include_once 'component/header.php' ?>

        <!-- slide -->
        <?php include_once 'component/slider.php' ?>
        <?php
        include_once '../class/badminton.php';
        $bad = new badminton();
        ?>

        <!-- Sản phẩm nổi bật -->
        <div class="container mt-5">
            <div class="section-title text-center mb-4">
                <h2>SẢN PHẨM NỔI BẬT</h2>
                <p class="text-muted">Những sản phẩm cầu lông chất lượng cao</p>
            </div>
            <div class="row">
                <?php
                $con = $bad->connect();
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
                            <img src="../assets/img/img_product/'.$anh.'" alt="Vợt cầu lông Yonex" class="img-fluid">
                            <div class="product-overlay">
                                <a href="product_detail.php?maSP='.$id_maSP.'" class="btn btn-primary">Xem chi tiết</a>
                            </div>
                        </div>
                        <div class="product-info p-3">
                            <h5>'. $tenSP.'</h5>
                            <div class="price">
                                <span class="current-price">'.$gia_ban.'đ</span>
                            </div>
                        </div>
                    </div>
                </div>';
                }
                ?>
            </div>
            <div class="text-center mt-4">
                <a href="product.php" class="btn btn-outline-primary btn-lg">Xem tất cả sản phẩm</a>
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
                        <img src="../assets/img/news/Bedminton.jpg" alt="Tin tức 1" class="img-fluid">
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
                        <img src="../assets/img/news/Bedminton.jpg" alt="Tin tức 2" class="img-fluid">
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
                        <img src="../assets/img/news/Bedminton.jpg" alt="Tin tức 3" class="img-fluid">
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

        <!-- footer -->
        <?php include_once 'component/footer.php' ?>