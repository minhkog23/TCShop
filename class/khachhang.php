<?php
include_once 'badminton.php';
class khachhang extends badminton
{
    //tim kim san pham
    public function searchSP($sql)
    {
        $link = $this->connect();
        $result = mysqli_query($link, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // $=$row[''];
            }
        }
    }

    //lay san phẩm
    public function getSP($sql)
    {
        $link = $this->connect();
        $result = mysqli_query($link, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id_maSP = htmlspecialchars($row['id_maSP'], ENT_QUOTES, 'UTF-8');
                $tenSP = htmlspecialchars($row['tenSP'], ENT_QUOTES, 'UTF-8');
                $moTa = htmlspecialchars($row['moTa'], ENT_QUOTES, 'UTF-8');
                $donGia = htmlspecialchars($row['donGia'], ENT_QUOTES, 'UTF-8');
                $anh = htmlspecialchars($row['anh'], ENT_QUOTES, 'UTF-8');
                $soLuong = htmlspecialchars($row['soLuong'], ENT_QUOTES, 'UTF-8');
                $id_SPTB = htmlspecialchars($row['id_SPTB'], ENT_QUOTES, 'UTF-8');
                $id_dongSP = htmlspecialchars($row['id_dongSP'], ENT_QUOTES, 'UTF-8');

                echo '<div class="box-card col-md-3 mb-4">
                            <div class="card">
                                <img class="card-img-top" src="../assets/img/img_product/' . $anh . '" width="200px" height="250px" alt="Load">
                                <div class="card-body" align="center">
                                    <p class="card-ten" style="font-size:17px; height:40px">' . $tenSP . '</p>
                                    <p style="color:red; font-size: 16px;" class="card-gia">' . number_format($donGia, 0, ',', '.') . ' <span>VNĐ</span></p>
                                    <a href="product_detail.php?maSP=' . $id_maSP . '" class="btn btn-primary card-detail">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>';
            }
        } else {
            echo '<h3 align="center" style="padding-bottom:250px; padding-top: 10px ;">Không có sản phẩm</h3>';
        }
    }

    //lay nha cung cap
    public function getNCC($sql)
    {
        $link = $this->connect();
        $result = mysqli_query($link, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id_ThuongHieu = htmlspecialchars($row['id_ThuongHieu'], ENT_QUOTES, 'UTF-8');
                $tenThuongHieu = htmlspecialchars($row['tenThuongHieu'], ENT_QUOTES, 'UTF-8');

                echo '<li class="nav-item">
                            <a class="nav-link" href="product_NCC.php?id_ThuongHieu=' . $id_ThuongHieu . '">' . $tenThuongHieu . '</a>
                        </li>';
            }
        }
    }

    //lay dòng sản phẩm theo thương hiệu
    public function getDongSanPham($sql)
    {
        $link = $this->connect();
        $result = mysqli_query($link, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id_dongSP = htmlspecialchars($row['id_dongSP'], ENT_QUOTES, 'UTF-8');
                $tenDongSP = htmlspecialchars($row['tenDongSP'], ENT_QUOTES, 'UTF-8');
                $id_ThuongHieu = htmlspecialchars($row['id_ThuongHieu'], ENT_QUOTES, 'UTF-8');

                echo '<div class="category-box col-md-3 mb-3">
                            <a href="product_NCC.php?id_ThuongHieu=' . $id_ThuongHieu . '&id_dongSP=' . $id_dongSP . '"><span>' . $tenDongSP . '</span></a>
                        </div>';
            }
        } else {
            echo '<h3 align="center" style="padding-top: 10px ;">Không có dòng sản phẩm</h3>';
        }
    }

    //lấy size
    public function getSize($sql)
    {
        $link = $this->connect();
        $result = mysqli_query($link, $sql);
        $xetGiaTri = []; // Mảng để theo dõi các giá trị đã được lấy
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id_maSP = htmlspecialchars($row['id_maSP'], ENT_QUOTES, 'UTF-8');
                $size = htmlspecialchars($row['size'], ENT_QUOTES, 'UTF-8');
                $soLuong = htmlspecialchars($row['soLuong'], ENT_QUOTES, 'UTF-8');

                if (!in_array($size, $xetGiaTri)) {
                    // Nếu chưa xuất hiện, thêm vào mảng và hiển thị
                    $xetGiaTri[] = $size;
                    echo '<span class="box-size">
                                    <input type="radio" class="form-check-input" name="txtsize" value="' . $size . '" checked>
                                    <label class="form-check-label" for="txtsize">' . $size . '</label>
                                </span>';
                }
            }
        } else {
            echo '<p align="center" style="padding-top: 10px ;">Không có dòng sản phẩm</p>';
        }
    }

    // lấy hóa đơn
    public function getDonHang($sql)
    {
        $link = $this->connect();
        $result = mysqli_query($link, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id_HD = $row['id_HD'];
                $id_KH = $row['id_KH'];
                $ngayDat = $row['ngayDat'];
                $ngayGiao = $row['ngayGiao'];
                $tongTien = $row['tongTien'];
                $tinhTrang = $row['tinhTrang'];
                $id_NV_giaoHang = $row['id_NV_giaoHang'];
                $id_maSP = $row['id_maSP'];
                $tenSP = $row['tenSP'];
                $soLuong = $row['soLuong'];
                $anh = $row['anh'];
                $ngayDat = new DateTime($ngayDat);
                $ngayGiaofm = '';
                if ($ngayGiao == '0000-00-00 00:00:00') {
                    $display = 'none';
                } else {
                    $display = 'block';
                    $ngayGiao = new DateTime($ngayGiao);
                    $ngayGiaofm = $ngayGiao->format('d/m/Y');
                }

                $checkTinhTrang = $tinhTrang == 'Chờ xử lý' ? '' : 'none';
                $checkDG = $tinhTrang == 'Hoàn thành' ? '' : 'none';

                echo '<div class="border p-3 mb-3 rounded">
                        <div class="d-flex justify-content-between mb-2">
                            <div><strong>Đơn hàng # ' . $id_HD . '</strong></div>
                            <span class="badge bg-success">' . $tinhTrang . '</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <img src="../assets/img/img_product/' . $anh . '" alt="SP" width="100" class="me-5 rounded">
                            <div>
                                <div>Sản phẩm: <strong>' . $tenSP . '</strong></div>
                                <div>Số lượng: ' . $soLuong . '</div>
                                <div>Giá: ' . number_format($tongTien, 0, '', '.') . ' vnđ</div>
                                <div = new DateTime($ngaydat);
                                <div>Ngày đặt: ' . $ngayDat->format('d/m/Y') . '</div>
                                <div style="display:' . $display . '">Ngày giao: ' . $ngayGiaofm . '</div>
                            </div>
                        </div>
                        <div class="text-end mt-2">
                            <form action="" method="post">
                                <input type="hidden" name="id_hd" value="' . $id_HD . '"  id="">
                                <input style="display:' . $checkTinhTrang . '" type="submit" value="Hủy" name="nut_huy" class="btn btn-outline-secondary w-25" onclick="confirm(\' Bạn có chắc muốn hủy đơn hàng này không ? \')">
                                <a href="product_detail.php?maSP=' . $id_maSP . '" style="display:' . $checkDG . '" class="btn btn-outline-secondary w-25">Đánh giá</a>
                            </form>
                        </div>
                    </div>';
            }
        } else {
            echo '<h3 align="center" style="padding-top: 10px ;">Không có đơn hàng nào !</h3>';
        }
    }

    //lay đánh giá
    public function getDanhGia($sql)
    {
        $link = $this->connect();
        $result = mysqli_query($link, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo '<div class="cus-danhGia mt-5 pd-5">
                        <h5 align="left" class="mb-3">Đánh giá của khách hàng:</h5>
                        <hr>';
            while ($row = mysqli_fetch_assoc($result)) {
                $id_DG = $row['id_DG'];
                $id_KH = $row['id_KH'];
                $ten = $row['ten'];
                $ngayTao = $row['ngayTao'];
                $ngayTao = new DateTime($ngayTao);
                $ngayTao = $ngayTao->format('d/m/Y');
                $noiDung = $row['noiDung'];
                echo '
                        <div class="noiDung-danhGia">  
                            <p align="left"><i class="fas fa-user-secret"></i> ' . $ten . ': </p>
                            <!-- <p align="left" style="color: #eb9e44;">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                            </p> -->
                            <p align="left" style="font-size: 16px;">' . $noiDung . ' : <span>' . $ngayTao . '</span></p>
                            <hr>
                        </div>
                    ';
            }
            echo '</div>';
        } else {
            echo '<h3 align="center" style="padding-top: 10px ;">Chưa có đánh giá nào !</h3>';
        }
    }
}
