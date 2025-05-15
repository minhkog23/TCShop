<?php
error_reporting(0);
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
// Kiểm tra xem có id_sua trong URL không
if (isset($_REQUEST['id_sua']) && $_REQUEST['id_sua'] != '') {
    if (filter_var($_REQUEST['id_sua'], FILTER_VALIDATE_INT) === false) {
        header('location:danhSachSP.php');
    } else {
        $id_sua = intval($_REQUEST['id_sua']);
        $tenSP = $ad->laycot("select tenSP from sanpham where id_maSP='$id_sua'");
        $moTa = $ad->laycot("select moTa from sanpham where id_maSP='$id_sua'");
        $donGia = $ad->laycot("select donGia from sanpham where id_maSP='$id_sua'");
        $anh = $ad->laycot("select anh from sanpham where id_maSP='$id_sua'");
        $id_dongSP = $ad->laycot("select id_dongSP from sanpham where id_maSP='$id_sua'");
        $anh1 = $ad->laycot("select anh1 from anh_chitietsp where id_maSP='$id_sua'");
        $anh2 = $ad->laycot("select anh2 from anh_chitietsp where id_maSP='$id_sua'");
        $anh3 = $ad->laycot("select anh3 from anh_chitietsp where id_maSP='$id_sua'");
        $anh4 = $ad->laycot("select anh4 from anh_chitietsp where id_maSP='$id_sua'");
    }
} else {
    header('location:danhSachSP.php');
}

?>
<?php
// token
// $token =bin2hex(random_bytes(32)); chỉ hổ trợ php 7.0 trở lên
// Đặt ở đầu file PHP, trước khi xuất HTML
if (!isset($_SESSION['token'])) {
    //$_SESSION['token'] = bin2hex(random_bytes(32));//
    $_SESSION['token'] = md5(uniqid(rand(), true)); // Hoặc sử dụng hàm md5 để tạo token
}
$token = $_SESSION['token'];
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
    </div>
    <div class="card-body">
        <form method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="mb-3 col-md-4">
                    <label for="txttensp" class="form-label">Tên sản phẩm <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="txttensp" id="txttensp" value="<?php echo $tenSP ?>" required>
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
                    <input type="text" class="form-control" name="txtdongia" id="txtdongia" pattern="^\d+$" title="Chỉ nhập số và không âm" value="<?php echo $donGia ?>" required>
                </div>

                <div class="mb-3 col-md-6">
                    <label for="fileAnhNen" class="form-label">Chọn ảnh nền sản phẩm <span style="color: red">*</span></label>
                    <br>
                    <?php if (!empty($anh)) { ?>
                        <img src="../assets/img/img_product/<?php echo $anh; ?>" alt="Ảnh nền sản phẩm" style="max-width: 20%; max-height: 50%;">
                    <?php } ?>
                    <input class="form-control mt-2" type="file" name="fileAnhNen" id="fileAnhNen" accept="image/*">

                </div>
                <div class="mb-3 col-md-6">
                    <label for="formFileMultiple" class="form-label">Chọn ảnh chi tiết sản phẩm ( 4 ảnh ) <span style="color: red">*</span></label>
                    <br>
                    <?php if (!empty($anh1)) { ?>
                        <img src="../assets/img/img_product/img_product_detail/<?php echo $anh1; ?>" alt="Ảnh nền sản phẩm" style="max-width: 20%; max-height: 50%;">
                    <?php } ?>
                    <?php if (!empty($anh2)) { ?>
                        <img src="../assets/img/img_product/img_product_detail/<?php echo $anh2; ?>" alt="Ảnh nền sản phẩm" style="max-width: 20%; max-height: 50%;">
                    <?php } ?>
                    <?php if (!empty($anh3)) { ?>
                        <img src="../assets/img/img_product/img_product_detail/<?php echo $anh3; ?>" alt="Ảnh nền sản phẩm" style="max-width: 20%; max-height: 50%;">
                    <?php } ?>
                    <?php if (!empty($anh4)) { ?>
                        <img src="../assets/img/img_product/img_product_detail/<?php echo $anh4; ?>" alt="Ảnh nền sản phẩm" style="max-width: 20%; max-height: 50%;">
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
                    <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                    <a href="danhSachSP.php"><button type="button" class="btn btn-outline-danger ">Quay lại</button></a>
                    <input type="reset" value="Nhập lại" class="btn btn-outline-secondary " name="btn_reset" id="btn_reset">
                    <button type="submit" name="nut_sua" value="sua-items" class="btn btn-outline-primary">Lưu</button>
                </div>
            </div>

            <?php
            if (isset($_REQUEST['nut_sua']) && $_REQUEST['nut_sua'] == 'sua-items' && $_REQUEST['token'] == $_SESSION['token']) {
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
                if (isset($_REQUEST['txtthongso'])) {
                    $thongSo = $_REQUEST['txtthongso'];
                }
                if ($tensp == '' || $dongia == '' || empty($thongSo)) {
                    echo '<script>swal("Thất bại","Vui lòng nhập đầy đủ thông tin","error")</script>';
                } else {
                    //xử lý update chỉ có ảnh nền
                    if (isset($_FILES['fileAnhNen']) && $anhNen_name != '' && empty($_FILES['fileAnhChiTiet']['name'][0])) {
                        if ($anhNen_type != 'image/png' && $anhNen_type != 'image/jpg' && $anhNen_type != 'image/jpeg' && $anhNen_type != 'image/gif' && $anhNen_type != 'image/webp') {
                            echo '<script>swal("Thất bại","Hình ảnh không đúng định dạng","error")</script>';
                        } else
                            if (unlink("../assets/img/img_product/$anh")) {
                            $anhNen_name_rm = time() . '_' . $anhNen_name;
                            if ($ad->uploadfile($anhNen_name_rm, $anhNen_tmp_name, "../assets/img/img_product")) {
                                $sql = "UPDATE sanpham
                                        SET tenSP=?,moTa=?,donGia=?,anh=?,id_dongSP=?
                                        WHERE id_maSP=?;
                                    ";
                                $params = [$tensp, $moTa, $dongia, $anhNen_name_rm, $DongSP, $id_sua];
                                $result = $ad->themxoasua($sql, $params);
                                if ($result == 1) {
                                    echo '<script>
                                        swal("Thành Công","Cập nhập sản phẩm thành công","success").then(function(){
                                                    window.location="danhSachSP.php";
                                        });
                                        setTimeout(function(){
                                            window.location="danhSachSP.php";
                                        }, 2000);
                                    </script>';

                                    $sql1 = "DELETE FROM chitietsanpham WHERE id_maSP=?";
                                    $params1 = [$id_sua];
                                    $result1 = $ad->themxoasua($sql1, $params1);
                                    if ($result1 != 1) {
                                        echo '<script>swal("Thất bại", "Cập nhật thông số kỹ thuật thất bại", "error")</script>';
                                    }
                                    // Xử lý kích thước
                                    for ($i = 0; $i < count($thongSo); $i++) {
                                        $thongSo_i = isset($thongSo[$i]) ? $thongSo[$i] : '';  // Lấy thông số kỹ thuật (kích thước) nếu có

                                        // Kiểm tra kích thước không rỗng
                                        if ($thongSo_i != '') {
                                            // Thêm thông số kỹ thuật vào bảng chitietsanpham
                                            $sql2 = "INSERT INTO chitietsanpham(id_maSP, size) 
                                                            VALUES (?,?)";
                                            $params2 = [$id_sua, $thongSo_i];
                                            $result2 = $ad->themxoasua($sql2, $params2);
                                            if ($result2 != 1) {
                                                echo '<script>swal("Thất bại", "Cập nhật thông số kỹ thuật thất bại", "error")</script>';
                                            }
                                        }
                                    }
                                }
                                unset($_SESSION['token']);
                            } else {
                                echo '<script>swal("Thất bại","Upload hình ảnh thất bại","error")</script>';
                            }
                        }
                        //xử lý upload có ảnh chi tiết không có ảnh nền.
                    } else if (isset($_FILES['fileAnhChiTiet']) && !empty($_FILES['fileAnhChiTiet']['name'][0]) && empty($_FILES['fileAnhNen']['name'])) {
                        // xử lý bảng anh_chitietsp
                        for ($i = 0; $i < count($anhChiTiet_name); $i++) {
                            //$anhChiTiet_type = $_FILES['fileAnhChiTiet']['type'][$i]; // Lấy loại tệp ảnh chi tiết
                            // Kiểm tra nếu tệp không phải là hình ảnh hợp lệ
                            if ($anhChiTiet_type[$i] != 'image/png' && $anhChiTiet_type[$i] != 'image/jpg' && $anhChiTiet_type[$i] != 'image/jpeg' && $anhChiTiet_type[$i] != 'image/gif' && $anhChiTiet_type[$i] != 'image/webp') {
                                echo '<script>swal("Thất bại", "Hình ảnh chi tiết không đúng định dạng !!!", "error")</script>';
                                // Có thể dừng ngay khi gặp lỗi nếu bạn không muốn tiếp tục xử lý các ảnh còn lại
                                break;
                            } else {
                                $anhChiTiet_name_i = $anhChiTiet_name[$i];
                                $anhChiTiet_tmp_name_i = $anhChiTiet_tmp_name[$i];
                                $anhChiTiet_name_i_rename = time() . '_' . $anhChiTiet_name_i;
                                if ($ad->uploadfile($anhChiTiet_name_i_rename, $anhChiTiet_tmp_name_i, "../assets/img/img_product/img_product_detail")) {
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
                        }
                        // xử lý bảng anh_chitietsp
                        if (isset($anh1_i) || isset($anh2_i) || isset($anh3_i) || isset($anh4_i)) {

                            $sql3 = "UPDATE anh_chitietsp
                                                    SET anh1=?,anh2=?,anh3=?,anh4=?
                                                    WHERE id_maSP=?";
                            $params3 = [isset($anh1_i) ? $anh1_i : null, isset($anh2_i) ? $anh2_i : null, isset($anh3_i) ? $anh3_i : null, isset($anh4_i) ? $anh4_i : null, $id_sua];
                            $result3 = $ad->themxoasua($sql3, $params3);
                            if ($result3 != 1) {
                                echo '<script>swal("Thất bại","Upload hình ảnh thất bại","error")</script>';
                            } else {
                                echo '<script>
                                    swal("Thành Công","Cập nhập sản phẩm thành công","success").then(function(){
                                            window.location="danhSachSP.php";
                                    });
                                    setTimeout(function(){
                                        window.location="danhSachSP.php";
                                    }, 2000);
                                </script>';
                                //xóa ảnh chi tiết cũ
                                if (isset($anh1)) {
                                    unlink("../assets/img/img_product/img_product_detail/$anh1");
                                }
                                if (isset($anh2)) {
                                    unlink("../assets/img/img_product/img_product_detail/$anh2");
                                }
                                if (isset($anh3)) {
                                    unlink("../assets/img/img_product/img_product_detail/$anh3");
                                }
                                if (isset($anh4)) {
                                    unlink("../assets/img/img_product/img_product_detail/$anh4");
                                }
                                $sql4 = "DELETE FROM chitietsanpham WHERE id_maSP=?";
                                $params4 = [$id_sua];
                                $result4 = $ad->themxoasua($sql4, $params4);
                                if ($result4 != 1) {
                                    echo '<script>swal("Thất bại", "Cập nhật thông số kỹ thuật thất bại", "error")</script>';
                                }
                                // Xử lý kích thước
                                for ($i = 0; $i < count($thongSo); $i++) {
                                    $thongSo_i = isset($thongSo[$i]) ? $thongSo[$i] : '';  // Lấy thông số kỹ thuật (kích thước) nếu có

                                    // Kiểm tra kích thước không rỗng
                                    if ($thongSo_i != '') {
                                        // Thêm thông số kỹ thuật vào bảng chitietsanpham
                                        $sql5 = "INSERT INTO chitietsanpham(id_maSP, size) 
                                                            VALUES (?,?)";
                                        $params5 = [$id_sua, $thongSo_i];
                                        $result5 = $ad->themxoasua($sql5, $params5);
                                        if ($result5 != 1) {
                                            echo '<script>swal("Thất bại", "Cập nhật thông số kỹ thuật thất bại", "error")</script>';
                                        }
                                    }
                                }
                            }
                            unset($_SESSION['token']);
                        }
                    } else 
                    if (isset($_FILES['fileAnhChiTiet']) && !empty($_FILES['fileAnhChiTiet']['name'][0]) && isset($_FILES['fileAnhNen']) && $anhNen_name != '') {
                        if ($anhNen_type != 'image/png' && $anhNen_type != 'image/jpg' && $anhNen_type != 'image/jpeg' && $anhNen_type != 'image/gif' && $anhNen_type != 'image/webp') {
                            echo '<script>swal("Thất bại","Hình ảnh không đúng định dạng","error")</script>';
                        } else {
                            if (unlink("../assets/img/img_product/$anh")) {
                                $anhNen_name_rm = time() . '_' . $anhNen_name;

                                if ($ad->uploadfile($anhNen_name_rm, $anhNen_tmp_name, "../assets/img/img_product")) {
                                    $sql6 = "UPDATE sanpham
                                        SET tenSP=?,moTa=?,donGia=?,anh=?,id_dongSP=?
                                        WHERE id_maSP=?;
                                    ";
                                    $params6 = [$tensp, $moTa, $dongia, $anhNen_name_rm, $DongSP, $id_sua];
                                    $result6 = $ad->themxoasua($sql6, $params6);
                                    if ($result6 == 1) 
                                    {
                                        echo '<script>
                                                    swal("Thành Công","Cập nhập sản phẩm thành công","success").then(function(){
                                                                window.location="danhSachSP.php";
                                                    });
                                                    setTimeout(function(){
                                                        window.location="danhSachSP.php";
                                                    }, 2000);
                                                </script>';

                                        // xử lý bảng anh_chitietsp
                                        for ($i = 0; $i < count($anhChiTiet_name); $i++) {
                                            //$anhChiTiet_type = $_FILES['fileAnhChiTiet']['type'][$i]; // Lấy loại tệp ảnh chi tiết
                                            // Kiểm tra nếu tệp không phải là hình ảnh hợp lệ
                                            if ($anhChiTiet_type[$i] != 'image/png' && $anhChiTiet_type[$i] != 'image/jpg' && $anhChiTiet_type[$i] != 'image/jpeg' && $anhChiTiet_type[$i] != 'image/gif' && $anhChiTiet_type[$i] != 'image/webp') {
                                                echo '<script>swal("Thất bại", "Hình ảnh chi tiết không đúng định dạng !!!", "error")</script>';
                                                // Có thể dừng ngay khi gặp lỗi nếu bạn không muốn tiếp tục xử lý các ảnh còn lại
                                                break;
                                            } else {
                                                $anhChiTiet_name_i = $anhChiTiet_name[$i];
                                                $anhChiTiet_tmp_name_i = $anhChiTiet_tmp_name[$i];
                                                $anhChiTiet_name_i_rename = time() . '_' . $anhChiTiet_name_i;
                                                if ($ad->uploadfile($anhChiTiet_name_i_rename, $anhChiTiet_tmp_name_i, "../assets/img/img_product/img_product_detail")) {
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
                                        }
                                        // xử lý bảng anh_chitietsp
                                        if (isset($anh1_i) || isset($anh2_i) || isset($anh3_i) || isset($anh4_i)) {
                                            $sql7 = "UPDATE anh_chitietsp
                                                    SET anh1=?,anh2=?,anh3=?,anh4=?
                                                    WHERE id_maSP=?";
                                            $params7 = [isset($anh1_i) ? $anh1_i : null, isset($anh2_i) ? $anh2_i : null, isset($anh3_i) ? $anh3_i : null, isset($anh4_i) ? $anh4_i : null, $id_sua];
                                            $result7 = $ad->themxoasua($sql7, $params7);
                                            if ($result7 != 1) {
                                                echo '<script>swal("Thất bại","Upload hình ảnh thất bại","error")</script>';
                                            } else {
                                                echo '<script>
                                    swal("Thành Công","Cập nhập sản phẩm thành công abcxyz","success").then(function(){
                                            window.location="danhSachSP.php";
                                    });
                                    setTimeout(function(){
                                        window.location="danhSachSP.php";
                                    }, 2000);
                                </script>';
                                                //xóa ảnh chi tiết cũ
                                                if (isset($anh1)) {
                                                    unlink("../assets/img/img_product/img_product_detail/$anh1");
                                                }
                                                if (isset($anh2)) {
                                                    unlink("../assets/img/img_product/img_product_detail/$anh2");
                                                }
                                                if (isset($anh3)) {
                                                    unlink("../assets/img/img_product/img_product_detail/$anh3");
                                                }
                                                if (isset($anh4)) {
                                                    unlink("../assets/img/img_product/img_product_detail/$anh4");
                                                }
                                                $sql8 = "DELETE FROM chitietsanpham WHERE id_maSP=?";
                                                $params8 = [$id_sua];
                                                $result8 = $ad->themxoasua($sql8, $params8);
                                                if ($result8 != 1) {
                                                    echo '<script>swal("Thất bại", "Cập nhật thông số kỹ thuật thất bại", "error")</script>';
                                                }
                                                // Xử lý kích thước
                                                for ($i = 0; $i < count($thongSo); $i++) {
                                                    $thongSo_i = isset($thongSo[$i]) ? $thongSo[$i] : '';  // Lấy thông số kỹ thuật (kích thước) nếu có

                                                    // Kiểm tra kích thước không rỗng
                                                    if ($thongSo_i != '') {
                                                        // Thêm thông số kỹ thuật vào bảng chitietsanpham
                                                        $sql9 = "INSERT INTO chitietsanpham(id_maSP, size) 
                                                            VALUES (?,?)";
                                                        $params9 = [$id_sua, $thongSo_i];
                                                        $result9 = $ad->themxoasua($sql9, $params9);
                                                        if ($result9 != 1) {
                                                            echo '<script>swal("Thất bại", "Cập nhật thông số kỹ thuật thất bại", "error")</script>';
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    unset($_SESSION['token']);
                                }
                            }
                        }
                    } else {
                        $sql10 = "UPDATE sanpham SET tenSP=?, moTa=?, donGia=?, id_dongSP=? WHERE id_maSP=?";
                        $params10 = [$tensp, $moTa, $dongia, $DongSP, $id_sua];
                        $result10 = $ad->themxoasua($sql10, $params10);
                        if ($result10 == 1) {
                            echo '<script>
                                    swal("Thành Công","Cập nhật sản phẩm thành công","success").then(function(){
                                        window.location="danhSachSP.php";
                                    });
                                    setTimeout(function(){
                                        window.location="danhSachSP.php";
                                    }, 2000);
                                </script>';
                            $sql11 = "DELETE FROM chitietsanpham WHERE id_maSP=?";
                            $params11 = [$id_sua];
                            $result11 = $ad->themxoasua($sql11, $params11);
                            if ($result11 != 1) {
                                echo '<script>swal("Thất bại", "Cập nhật thông số kỹ thuật thất bại", "error")</script>';
                            }
                            // Xử lý kích thước
                            for ($i = 0; $i < count($thongSo); $i++) {
                                $thongSo_i = isset($thongSo[$i]) ? $thongSo[$i] : '';  // Lấy thông số kỹ thuật (kích thước) nếu có

                                // Kiểm tra kích thước không rỗng
                                if ($thongSo_i != '') {
                                    // Thêm thông số kỹ thuật vào bảng chitietsanpham
                                    $sql12 = "INSERT INTO chitietsanpham(id_maSP, size) 
                                                            VALUES (?,?)";
                                    $params12 = [$id_sua, $thongSo_i];
                                    $result12 = $ad->themxoasua($sql12, $params12);
                                    if ($result12 != 1) {
                                        echo '<script>swal("Thất bại", "Cập nhật thông số kỹ thuật thất bại", "error")</>';
                                    }
                                }
                            }
                        } else {
                            echo '<script>swal("Thất bại","Upload hình ảnh thất bại","error")</script>';
                        }
                        unset($_SESSION['token']);
                    }
                }
            }
            else if (isset($_REQUEST['nut_sua']) && $_REQUEST['nut_sua'] == 'sua-items' && $_REQUEST['token'] != $_SESSION['token']) {
                echo '<script>swal("Thất bại","Không gửi lại form cũ","error")</script>';
                unset($_SESSION['token']);
            }
            ?>
        </form>
    </div>
</div>
<?php
include_once 'component/footer.php'
?>