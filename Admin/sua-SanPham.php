<?php
include '../class/admin.php';
$ad = new admin();
?>
<?php
include '../class/auth.php';
$checkRole = new auth();
if ($checkRole->checkRoleAdmin() == 0) {
    header('location:index.php');
}
?>
<?php
include 'component/header.php';
?>
<div class="alert alert-secondary">
    <h4 class="pt-2">TC-Badminton / Sản phẩm</h4>
</div>
<!-- Basic Card Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Sửa sản phẩm</h5>
        <?php
        $id_sua = $_REQUEST['id_sua'];
        $tenSP = $ad->laycot("select tenSP from sanpham where id_maSP='$id_sua'");
        $moTa = $ad->laycot("select moTa from sanpham where id_maSP='$id_sua'");
        $donGia = $ad->laycot("select donGia from sanpham where id_maSP='$id_sua'");
        $anh = $ad->laycot("select anh from sanpham where id_maSP='$id_sua'");
        $id_dongSP = $ad->laycot("select id_dongSP from sanpham where id_maSP='$id_sua'");
        $anh1 = $ad->laycot("select anh1 from anh_chitietsp where id_maSP='$id_sua'");
        $anh2 = $ad->laycot("select anh2 from anh_chitietsp where id_maSP='$id_sua'");
        $anh3 = $ad->laycot("select anh3 from anh_chitietsp where id_maSP='$id_sua'");
        $anh4 = $ad->laycot("select anh4 from anh_chitietsp where id_maSP='$id_sua'");
        ?>
    </div>
    <div class="card-body">
        <form method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="mb-3 col-md-4">
                    <label for="txttensp" class="form-label">Tên sản phẩm <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="txttensp" id="txttensp" value="<?php echo $tenSP ?>">
                </div>
                <div class="mb-3 col-md-4">
                    <label for="txttensp" class="form-label">Dòng sản phẩm <span style="color: red">*</span></label>
                    <select name="selectDongSP" class="form-control">
                        <?php
                        $ad->getdongSP_sua_SanPham('SELECT *
                                        FROM dongsanpham dsp JOIN thuonghieu th ON dsp.id_ThuongHieu=th.id_ThuongHieu', $id_dongSP);
                        ?>
                    </select>
                </div>
                <div class="mb-3 col-md-4">
                    <label for="txtdongia" class="form-label">Giá sản phẩm<span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="txtdongia" id="txtdongia" value="<?php echo $donGia ?>">
                </div>

                <div class="mb-3 col-md-6">
                    <label for="fileAnhNen" class="form-label">Chọn ảnh nền sản phẩm <span style="color: red">*</span></label>
                    <br>
                    <?php if (!empty($anh)) { ?>
                        <img src="../main/img/img_product/<?php echo $anh; ?>" alt="Ảnh nền sản phẩm" style="max-width: 20%; max-height: 50%;">
                    <?php } ?>
                    <input class="form-control mt-2" type="file" name="fileAnhNen" id="fileAnhNen" accept="image/*">

                </div>
                <div class="mb-3 col-md-6">
                    <label for="formFileMultiple" class="form-label">Chọn ảnh chi tiết sản phẩm ( 4 ảnh ) <span style="color: red">*</span></label>
                    <br>
                    <?php if (!empty($anh1)) { ?>
                        <img src="../main/img/img_product/img_product_detail/<?php echo $anh1; ?>" alt="Ảnh nền sản phẩm" style="max-width: 20%; max-height: 50%;">
                    <?php } ?>
                    <?php if (!empty($anh2)) { ?>
                        <img src="../main/img/img_product/img_product_detail/<?php echo $anh2; ?>" alt="Ảnh nền sản phẩm" style="max-width: 20%; max-height: 50%;">
                    <?php } ?>
                    <?php if (!empty($anh3)) { ?>
                        <img src="../main/img/img_product/img_product_detail/<?php echo $anh3; ?>" alt="Ảnh nền sản phẩm" style="max-width: 20%; max-height: 50%;">
                    <?php } ?>
                    <?php if (!empty($anh4)) { ?>
                        <img src="../main/img/img_product/img_product_detail/<?php echo $anh4; ?>" alt="Ảnh nền sản phẩm" style="max-width: 20%; max-height: 50%;">
                    <?php } ?>
                    <input class="form-control mt-2" type="file" name="fileAnhChiTiet[]" id="fileAnhChiTiet" multiple accept="image/*">
                </div>
                <div class="mb-3 col-md-12">
                    <label for="txtmota" class="form-label">Mô tả</label>
                    <textarea class="form-control" name="txtmota" id="txtmota" rows="3"><?php echo $moTa ?></textarea>
                </div>

                <div class="form-group mb-4 mt-2 col-md-12 border rounded">
                    <p class="pt-2">Thông Số: <span style="color: red">*</span></p>
                    <?php
                    $size = $ad->laycot_lap("SELECT size FROM `chitietsanpham` where id_maSP='$id_sua' ");
                    $ad->getThongSo_sua_SanPham('SELECT *
                                                FROM size ', $size);
                    ?>
                </div>
                <div class="mb-3 col-md-12 text-center">
                    <a href="danhSachSP.php"><button type="button" class="btn btn-outline-danger ">Quay lại</button></a>
                    <input type="reset" value="Nhập lại" class="btn btn-outline-secondary " name="btn_reset" id="btn_reset">
                    <button type="submit" name="nut_sua" value="sua-items" class="btn btn-outline-primary">Lưu</button>
                </div>

            </div>
            <?php
            if (isset($_REQUEST['nut_sua']) && $_REQUEST['nut_sua'] == 'sua-items') {
                // if($_REQUEST['txttensp']!='' && $_REQUEST['selectDongSP']!='' && $_REQUEST['txtdongia']!='' && $_FILES['fileAnhNen']['name']!='' && $_FILES['fileAnhChiTiet']['name']!='' && $_REQUEST['txtthongso']!=''  && $_REQUEST['txtmausac']!='' )
                // {

                // }
                // else
                // {
                //     echo '<script>swal("Thất bại","Vui lòng nhập đầy đủ thông tin bắt buộc","error")</script>';
                // }
                $tensp = $_REQUEST['txttensp'];
                $DongSP = $_REQUEST['selectDongSP'];
                $dongia = $_REQUEST['txtdongia'];
                $anhNen_name = $_FILES['fileAnhNen']['name'];
                $anhNen_type = $_FILES['fileAnhNen']['type'];
                $anhNen_tmp_name = $_FILES['fileAnhNen']['tmp_name'];
                $anhNen_size = $_FILES['fileAnhNen']['size'];
                $anhChiTiet_name = $_FILES['fileAnhChiTiet']['name'];
                $anhChiTiet_type = $_FILES['fileAnhChiTiet']['type'];
                $anhChiTiet_tmp_name = $_FILES['fileAnhChiTiet']['tmp_name'];
                $anhChiTiet_size = $_FILES['fileAnhChiTiet']['size'];
                $moTa = $_REQUEST['txtmota'];
                $thongSo = $_REQUEST['txtthongso'];
                $mauSac = $_REQUEST['txtmausac'];

                //xử lý update chỉ có ảnh nền
                if (isset($_FILES['fileAnhNen']) && $anhNen_name != '') {
                    if (unlink("../main/img/img_product/$anh")) {
                        $anhNen_name_rm = time() . '_' . $anhNen_name;
                        if ($ad->uploadfile($anhNen_name_rm, $anhNen_tmp_name, "../main/img/img_product")) {

                            if ($ad->themxoasua("UPDATE sanpham
                                                        SET tenSP='$tensp',moTa='$moTa',donGia='$dongia',anh='$anhNen_name_rm',id_dongSP='$DongSP'
                                                        WHERE id_maSP='$id_sua';
                                                     ") == 1) {
                                echo '<script>swal("Thành Công","Cập nhập sản phẩm thành công","success").then(function(){
                                                    window.location="danhSachSP.php";
                                        })</script>';

                                if ($ad->themxoasua("DELETE FROM chitietsanpham WHERE id_maSP='$id_sua'") != 1) {
                                    echo '<script>swal("Thất bại", "Cập nhật thông số kỹ thuật và màu sắc thất bại", "error")</script>';
                                }
                                // Xử lý kích thước
                                for ($i = 0; $i < count($thongSo); $i++) {
                                    $thongSo_i = isset($thongSo[$i]) ? $thongSo[$i] : '';  // Lấy thông số kỹ thuật (kích thước) nếu có

                                    // Kiểm tra kích thước không rỗng
                                    if ($thongSo_i != '') {
                                        // Thêm thông số kỹ thuật vào bảng chitietsanpham
                                        if ($ad->themxoasua("INSERT INTO chitietsanpham(id_maSP, size) 
                                                            VALUES ('$id_sua','$thongSo_i')") != 1) {
                                            echo '<script>swal("Thất bại", "Cập nhật thông số kỹ thuật thất bại", "error")</script>';
                                        }
                                    }
                                }
                            }
                        } else {
                            echo '<script>swal("Thất bại","Upload hình ảnh thất bại","error")</script>';
                        }
                    }
                    //xử lý upload có ảnh chi tiết không có ảnh nền.
                } else if (isset($_FILES['fileAnhChiTiet']) && !empty($_FILES['fileAnhChiTiet']['name'][0])) {
                    // xử lý bảng anh_chitietsp
                    //echo "hdajsgdahwdauw";
                    for ($i = 0; $i < count($anhChiTiet_name); $i++) {
                        $anhChiTiet_name_i = $anhChiTiet_name[$i];
                        $anhChiTiet_tmp_name_i = $anhChiTiet_tmp_name[$i];
                        $anhChiTiet_name_i_rename = time() . '_' . $anhChiTiet_name_i;
                        if ($ad->uploadfile($anhChiTiet_name_i_rename, $anhChiTiet_tmp_name_i, "../main/img/img_product/img_product_detail")) {
                            if ($i == 0) {
                                // Lưu ảnh vào cột anh1
                                $anh1_i = $anhChiTiet_name_i_rename;
                            } else if ($i == 1) {
                                // Lưu ảnh vào cột anh2
                                $anh2_i = $anhChiTiet_name_i_rename;
                            } else if ($i == 2) {
                                // Lưu ảnh vào cột anh3
                                $anh3_i = $anhChiTiet_name_i_rename;
                            } else if ($i == 3) {
                                // Lưu ảnh vào cột anh4
                                $anh4_i = $anhChiTiet_name_i_rename;
                            }
                        } else {
                            echo '<script>swal("Thất bại","Xử lý hình ảnh chi tiết thất bại","error")</script>';
                        }
                    }
                    // xử lý bảng anh_chitietsp
                    if (isset($anh1_i) || isset($anh2_i) || isset($anh3_i) || isset($anh4_i)) {
                        if ($ad->themxoasua("UPDATE anh_chitietsp
                                                    SET anh1='$anh1_i',anh2='$anh2_i',anh3='$anh3_i',anh4='$anh4_i'
                                                    WHERE id_maSP='$id_sua'
                                ") != 1) {
                            echo '<script>swal("Thất bại","Upload hình ảnh thất bại","error")</script>';
                        } else {
                            echo '<script>swal("Thành Công","Cập nhập sản phẩm thành công","success").then(function(){
                                        window.location="danhSachSP.php";
                            })</script>';
                            //xóa ảnh chi tiết cũ
                            if (isset($anh1)) {
                                unlink("../main/img/img_product/img_product_detail/$anh1");
                            }
                            if (isset($anh2)) {
                                unlink("../main/img/img_product/img_product_detail/$anh2");
                            }
                            if (isset($anh3)) {
                                unlink("../main/img/img_product/img_product_detail/$anh3");
                            }
                            if (isset($anh4)) {
                                unlink("../main/img/img_product/img_product_detail/$anh4");
                            }

                            if ($ad->themxoasua("DELETE FROM chitietsanpham WHERE id_maSP='$id_sua'") != 1) {
                                echo '<script>swal("Thất bại", "Cập nhật thông số kỹ thuật thất bại", "error")</script>';
                            }
                            // Xử lý kích thước 
                            for ($i = 0; $i < count($thongSo); $i++) {
                                $thongSo_i = isset($thongSo[$i]) ? $thongSo[$i] : '';  // Lấy thông số kỹ thuật (kích thước) nếu có
                                // Kiểm tra kích thước không rỗng
                                if ($thongSo_i != '') {

                                    // Thêm thông số kỹ thuật và màu sắc vào bảng chitietsanpham
                                    if ($ad->themxoasua("INSERT INTO chitietsanpham(id_maSP, size) 
                                                                VALUES ('$id_sua','$thongSo_i')") != 1) {
                                        echo '<script>swal("Thất bại", "Cập nhật thông số kỹ thuật thất bại", "error")</script>';
                                    }
                                }
                            }
                        }
                    }
                } else 
                if (isset($_FILES['fileAnhChiTiet']) && $anhChiTiet_name != '' && isset($_FILES['fileAnhNen']) && $anhNen_name != '') {
                    if (unlink("../main/img/img_product/$anh")) {
                        $anhNen_name_rm = time() . '_' . $anhNen_name;
                        if ($ad->uploadfile($anhNen_name_rm, $anhNen_tmp_name, "../main/img/img_product")) {

                            if ($ad->themxoasua("UPDATE sanpham
                                                        SET tenSP='$tensp',moTa='$moTa',donGia='$dongia',anh='$anhNen_name_rm',id_dongSP='$DongSP'
                                                        WHERE id_maSP='$id_sua';
                                                     ") == 1) {
                                echo '<script>swal("Thành Công","Cập nhập sản phẩm thành công","success").then(function(){
                                                    window.location="danhSachSP.php";
                                        })</script>';

                                // xử lý bảng anh_chitietsp
                                for ($i = 0; $i < count($anhChiTiet_name); $i++) {
                                    $anhChiTiet_name_i = $anhChiTiet_name[$i];
                                    $anhChiTiet_tmp_name_i = $anhChiTiet_tmp_name[$i];
                                    $anhChiTiet_name_i_rename = time() . '_' . $anhChiTiet_name_i;
                                    if ($ad->uploadfile($anhChiTiet_name_i_rename, $anhChiTiet_tmp_name_i, "../main/img/img_product/img_product_detail")) {
                                        if ($i == 0) {
                                            // Lưu ảnh vào cột anh1
                                            $anh1_i = $anhChiTiet_name_i_rename;
                                        } else if ($i == 1) {
                                            // Lưu ảnh vào cột anh2
                                            $anh2_i = $anhChiTiet_name_i_rename;
                                        } else if ($i == 2) {
                                            // Lưu ảnh vào cột anh3
                                            $anh3_i = $anhChiTiet_name_i_rename;
                                        } else if ($i == 3) {
                                            // Lưu ảnh vào cột anh4
                                            $anh4_i = $anhChiTiet_name_i_rename;
                                        }
                                    }
                                }
                                // xử lý bảng anh_chitietsp
                                if (isset($anh1_i) && isset($anh2_i) && isset($anh3_i) && isset($anh4_i)) {
                                    if ($ad->themxoasua("UPDATE anh_chitietsp
                                                                SET anh1='$anh1_i',anh2='$anh2_i',anh3='$anh3_i',anh4='$anh4_i'
                                                                WHERE id_maSP='$id_sua'
                                            ") != 1) {
                                        echo '<script>swal("Thất bại","Upload hình ảnh thất bại","error")</script>';
                                    } else {
                                        //xóa ảnh chi tiết cũ
                                        if (isset($anh1)) {
                                            unlink("../main/img/img_product/img_product_detail/$anh1");
                                        }
                                        if (isset($anh2)) {
                                            unlink("../main/img/img_product/img_product_detail/$anh2");
                                        }
                                        if (isset($anh3)) {
                                            unlink("../main/img/img_product/img_product_detail/$anh3");
                                        }
                                        if (isset($anh4)) {
                                            unlink("../main/img/img_product/img_product_detail/$anh4");
                                        }

                                        //xóa đi bảng chitietsanpham để cập nhập lại vì id_maSP trùng với nhau
                                        if ($ad->themxoasua("DELETE FROM chitietsanpham WHERE id_maSP='$id_sua'") != 1) {
                                            echo '<script>swal("Thất bại", "Cập nhật thông số kỹ thuật thất bại", "error")</script>';
                                        }
                                        // Xử lý kích thước 
                                        for ($i = 0; $i < count($thongSo); $i++) {
                                            $thongSo_i = isset($thongSo[$i]) ? $thongSo[$i] : '';  // Lấy thông số kỹ thuật (kích thước) nếu có

                                            // Kiểm tra kích thước không rỗng
                                            if ($thongSo_i != '') {
                                                // Thêm thông số kỹ thuật vào bảng chitietsanpham
                                                if ($ad->themxoasua("INSERT INTO chitietsanpham(id_maSP, size) 
                                                                    VALUES ('$id_sua','$thongSo_i')") != 1) {
                                                    echo '<script>swal("Thất bại", "Cập nhật thông số kỹ thuật thất bại", "error")</script>';
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        } else {
                            echo '<script>swal("Thất bại","Upload hình ảnh thất bại","error")</script>';
                        }
                    }
                } else {
                    if ($ad->themxoasua("UPDATE sanpham SET tenSP='$tensp', moTa='$moTa', donGia='$dongia', id_dongSP='$DongSP' WHERE id_maSP='$id_sua'") == 1) {
                        echo '<script>swal("Thành Công","Cập nhật sản phẩm thành công","success").then(function(){
                                                window.location="danhSachSP.php";
                                    })</script>';

                        if ($ad->themxoasua("DELETE FROM chitietsanpham WHERE id_maSP='$id_sua'") != 1) {
                            echo '<script>swal("Thất bại", "Cập nhật thông số kỹ thuật và màu sắc thất bại", "error")</script>';
                        }
                        // Xử lý kích thước và màu sắc
                        for ($i = 0; $i < count($thongSo); $i++) {
                            $thongSo_i = isset($thongSo[$i]) ? $thongSo[$i] : '';  // Lấy thông số kỹ thuật (kích thước) nếu có
                            // Kiểm tra kích thước không rỗng
                            if ($thongSo_i != '') {
                                // Thêm thông số kỹ thuật và màu sắc vào bảng chitietsanpham
                                if ($ad->themxoasua("INSERT INTO chitietsanpham(id_maSP, size) 
                                                    VALUES ('$id_sua','$thongSo_i')") != 1) {
                                    echo '<script>swal("Thất bại", "Cập nhật thông số kỹ thuật thất bại", "error")</script>';
                                }
                            }
                        }
                    } else {
                        echo '<script>swal("Thất bại","Cập nhật thất bại","error")</script>';
                    }
                }
            }
            ?>
        </form>
    </div>
</div>

<?php
include_once 'component/footer.php'
?>