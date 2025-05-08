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
                $id_maSP = $row['id_maSP'];
                $tenSP = $row['tenSP'];
                $moTa = $row['moTa'];
                $donGia = $row['donGia'];
                $anh = $row['anh'];
                $soLuong = $row['soLuong'];
                $id_SPTB = $row['id_SPTB'];
                $id_dongSP = $row['id_dongSP'];
                echo '<div class="box-card col-md-3 mb-4">
                            <div class="card">
                                <img class="card-img-top" src="../main/img/img_product/' . $anh . '" width="200px" height="250px" alt="Load">
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
                $id_ThuongHieu = $row['id_ThuongHieu'];
                $tenThuongHieu = $row['tenThuongHieu'];
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
                $id_dongSP = $row['id_dongSP'];
                $tenDongSP = $row['tenDongSP'];
                $id_ThuongHieu = $row['id_ThuongHieu'];
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
                $id_maSP = $row['id_maSP'];
                $size = $row['size'];
                $soLuong = $row['soLuong'];
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
}
