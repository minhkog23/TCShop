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
        <h5 class="m-0 font-weight-bold text-primary">Thêm sản phẩm</h5>
    </div>
    <div class="card-body">
        <form method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="mb-3 col-md-4">
                    <label for="txttensp" class="form-label">Nhập tên sản phẩm <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="txttensp" id="txttensp" placeholder="Tên SP ..." required>
                </div>
                <div class="mb-3 col-md-4">
                    <label for="txttensp" class="form-label">Chọn dòng sản phẩm <span style="color: red">*</span></label>
                    <select name="selectDongSP" class="form-control" required>
                        <?php
                        $ad->getdongSP_add_SanPham('SELECT *
                                        FROM dongsanpham dsp JOIN thuonghieu th ON dsp.id_ThuongHieu=th.id_ThuongHieu');
                        ?>
                    </select>
                </div>
                <div class="mb-3 col-md-4">
                    <label for="txtdongia" class="form-label">Nhập giá <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="txtdongia" id="txtdongia" placeholder="Nhập giá ..." pattern="^\d+$" title="Chỉ nhập số và không âm" required>
                </div>

                <div class="mb-3 col-md-6">
                    <label for="fileAnhNen" class="form-label">Chọn ảnh nền sản phẩm <span style="color: red">*</span></label>
                    <input class="form-control" type="file" name="fileAnhNen" id="fileAnhNen" accept="image/*" required>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="formFileMultiple" class="form-label">Chọn ảnh chi tiết sản phẩm ( 4 ảnh ) <span style="color: red">*</span></label>
                    <input class="form-control" type="file" name="fileAnhChiTiet[]" id="fileAnhChiTiet" min="1" max="4" multiple accept="image/*" required>
                </div>
                <div class="mb-3 col-md-12">
                    <label for="txtmota" class="form-label">Mô tả <span style="color: red">*</span></label>
                    <textarea class="form-control" name="txtmota" id="txtmota" rows="3" placeholder="Nhập mô tả ..."></textarea required>
                </div>

                <div class="form-group mb-4 mt-2 col-md-12 border rounded">
                    <p class="pt-2">Thông Số: <span style="color: red">*</span></p>
                    <?php
                    $ad->getThongSo_add_SanPham('SELECT *
                                                FROM size');
                    ?>
                </div>
                <div class="mb-3 col-md-12 text-center">
                    <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                    <a href="danhSachSP.php"><button type="button" class="btn btn-outline-danger ">Quay lại</button></a>
                    <input type="reset" value="Nhập lại" class="btn btn-outline-secondary " name="btn_reset" id="btn_reset">
                    <button type="submit" name="nut_them" value="add-items" class="btn btn-outline-primary ">Thêm</button>
                </div>

            </div>
            <?php
            if (isset($_REQUEST['nut_them']) && $_REQUEST['nut_them'] == 'add-items' && $_REQUEST['token'] == $_SESSION['token']) {
                $tensp = $_REQUEST['txttensp'];
                $DongSP = $_REQUEST['selectDongSP'];
                $dongia = $_REQUEST['txtdongia'];
                $anhNen_name = $_FILES['fileAnhNen']['name'];
                $anhNen_type = $_FILES['fileAnhNen']['type'];
                $anhNen_tmp_name = $_FILES['fileAnhNen']['tmp_name'];
                $anhNen_size = $_FILES['fileAnhNen']['size'];
                $anhChiTiet_name = (array)$_FILES['fileAnhChiTiet']['name'];
                $anhChiTiet_type = (array)$_FILES['fileAnhChiTiet']['type'];
                $anhChiTiet_tmp_name = (array)$_FILES['fileAnhChiTiet']['tmp_name'];
                $anhChiTiet_size = (array)$_FILES['fileAnhChiTiet']['size'];
                $moTa = $_REQUEST['txtmota'];
                if (isset($_REQUEST['txtthongso'])) {
                    $thongSo = $_REQUEST['txtthongso'];
                }
                if ($tensp == '' || $DongSP == '' || $dongia == '' || $moTa == '') {
                    echo '<script>swal("Thất bại","Vui lòng nhập đầy đủ thông tin !","error")</script>';
                } else if ($dongia < 0) {
                    echo '<script>swal("Thất bại","Giá không hợp lệ !","error")</script>';
                } else if (empty($thongSo[0])) {
                    echo '<script>swal("Thất bại","Bạn chưa chọn thông số !","error")</script>';
                } else {
                    if (isset($anhNen_name) && $anhNen_name != '') {
                        if ($anhNen_type != 'image/png' && $anhNen_type != 'image/jpg' && $anhNen_type != 'image/jpeg' && $anhNen_type != 'image/gif' && $anhNen_type != 'image/webp') {
                            echo '<script>swal("Thất bại","File ảnh không hợp lệ !","error")</script>';
                        } else {
                            $anhNen_name_rm = time() . '_' . $anhNen_name;
                            // xử lý bảng anh_chitietsp
                            if (isset($anhChiTiet_name) && !empty($_FILES['fileAnhChiTiet']['name'][0])) {
                                for ($i = 0; $i < count($anhChiTiet_name); $i++) {
                                    // Kiểm tra nếu tệp không phải là hình ảnh hợp lệ
                                    if ($anhChiTiet_type[$i] == 'image/png' || $anhChiTiet_type[$i] == 'image/jpg' || $anhChiTiet_type[$i] == 'image/jpeg' || $anhChiTiet_type[$i] == 'image/gif' || $anhChiTiet_type[$i] == 'image/webp') {
                                        $anhChiTiet_name_i = $anhChiTiet_name[$i];
                                        $anhChiTiet_tmp_name_i = $anhChiTiet_tmp_name[$i];
                                        $anhChiTiet_name_i_rename = time() . '_' . $anhChiTiet_name_i;
                                        if ($ad->uploadfile($anhChiTiet_name_i_rename, $anhChiTiet_tmp_name_i, "../assets/img/img_product/img_product_detail")) {
                                            if ($i == 0) {
                                                // Lưu ảnh vào cột anh1
                                                $anh1 = $anhChiTiet_name_i_rename;
                                            } else if ($i == 1) {
                                                // Lưu ảnh vào cột anh2
                                                $anh2 = $anhChiTiet_name_i_rename;
                                            } else if ($i == 2) {
                                                // Lưu ảnh vào cột anh3
                                                $anh3 = $anhChiTiet_name_i_rename;
                                            } else if ($i == 3) {
                                                // Lưu ảnh vào cột anh4
                                                $anh4 = $anhChiTiet_name_i_rename;
                                            }
                                        }
                                    } else {
                                        echo '<script>
                                                    swal("Thất bại","File ảnh chi tiết không hợp lệ !","error").then(function(){
                                                        window.location="add-SanPham.php";
                                                    });
                                                </script>';
                                        break;  // Dừng vòng lặp ngay khi phát hiện lỗi
                                    }
                                }

                                // xử lý bảng anh_chitietsp
                                if (isset($anh1) || isset($anh2) || isset($anh3) || isset($anh4)) {
                                    if ($ad->uploadfile($anhNen_name_rm, $anhNen_tmp_name, "../assets/img/img_product")) {
                                        $sql = "INSERT INTO sanpham( tenSP, moTa, donGia, anh, id_dongSP) 
                                                                VALUES (?, ?, ?, ?, ?)";
                                        $params = [$tensp, $moTa, $dongia, $anhNen_name_rm, $DongSP];
                                        $result = $ad->themxoasua($sql, $params);
                                        if ($result == 1) {
                                            echo '<script>
                                                        swal("Thành Công","Thêm sản phẩm thành công","success").then(function(){
                                                            window.location="danhSachSP.php";
                                                        });
                                                        setTimeout(function(){
                                                            window.location="danhSachSP.php";
                                                        }, 2000);
                                                    </script>';
                                            $id_maSP = $ad->laycot("SELECT id_maSP FROM sanpham ORDER BY id_maSP DESC LIMIT 1 ");
                                            $sql1 = "INSERT INTO anh_chitietsp(id_maSP, anh1, anh2, anh3, anh4) 
                                                                    VALUES (?, ?, ?, ?, ?)";
                                            $params1 = [$id_maSP, isset($anh1) ? $anh1 : null, isset($anh2) ? $anh2 : null, isset($anh3) ? $anh3 : null, isset($anh4) ? $anh4 : null];
                                            $result1 = $ad->themxoasua($sql1, $params1);
                                            if ($result != 1) {
                                                echo '<script>swal("Thất bại","Upload hình ảnh chi tiết thất bại","error")</script>';
                                            }
                                            // Xử lý kích thước
                                            if (isset($thongSo) && !empty($thongSo[0])) {
                                                for ($i = 0; $i < count($thongSo); $i++) {
                                                    $thongSo_i = isset($thongSo[$i]) ? $thongSo[$i] : '';  // Lấy thông số kỹ thuật (kích thước) nếu có

                                                    // Kiểm tra kích thước không rỗng
                                                    if ($thongSo_i != '') {
                                                        // Thêm thông số kỹ thuật và màu sắc vào bảng chitietsanpham
                                                        $sql2 = "INSERT INTO chitietsanpham(id_maSP, size) 
                                                                                VALUES (?, ?)";
                                                        $params2 = [$id_maSP, $thongSo_i];
                                                        $result2 = $ad->themxoasua($sql2, $params2);
                                                        if ($result2 != 1) {
                                                            echo '<script>swal("Thất bại", "Thêm thông số kỹ thuật thất bại", "error")</script>';
                                                        }
                                                        // if ($ad->themxoasua("INSERT INTO chitietsanpham(id_maSP, size) 
                                                        //                                 VALUES ('$id_maSP','$thongSo_i')") != 1) {
                                                        //     echo '<script>swal("Thất bại", "Thêm thông số kỹ thuật thất bại", "error")</script>';
                                                        // }
                                                    }
                                                }
                                            }
                                        } else {
                                            echo '<script>swal("Thất bại","Thêm sản phẩm không thành công","error")</script>';
                                        }
                                        unset($_SESSION['token']);
                                    } else {
                                        echo '<script>swal("Thất bại","Upload hình ảnh thất bại","error")</script>';
                                    }
                                    
                                }


                                
                            } else {
                                echo '<script>swal("Thất bại","Vui lòng chọn ảnh chi tiết !","error")</script>';
                            }
                            
                        }
                    } else {
                        echo '<script>swal("Thất bại","Vui lòng chọn ảnh nền !","error")</script>';
                    }
                }
            }
            else if (isset($_REQUEST['nut_them']) && $_REQUEST['nut_them'] == 'add-items' && $_REQUEST['token'] != $_SESSION['token']) {
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