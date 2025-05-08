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
        <h5 class="m-0 font-weight-bold text-primary">Thêm sản phẩm</h5>
    </div>
    <div class="card-body">
        <form method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="mb-3 col-md-4">
                    <label for="txttensp" class="form-label">Nhập tên sản phẩm <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="txttensp" id="txttensp" placeholder="Tên SP ...">
                </div>
                <div class="mb-3 col-md-4">
                    <label for="txttensp" class="form-label">Chọn dòng sản phẩm <span style="color: red">*</span></label>
                    <select name="selectDongSP" class="form-control">
                        <?php
                        $ad->getdongSP_add_SanPham('SELECT *
                                        FROM dongsanpham dsp JOIN thuonghieu th ON dsp.id_ThuongHieu=th.id_ThuongHieu');
                        ?>
                    </select>
                </div>
                <div class="mb-3 col-md-4">
                    <label for="txtdongia" class="form-label">Nhập giá <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="txtdongia" id="txtdongia" placeholder="Nhập giá ...">
                </div>

                <div class="mb-3 col-md-6">
                    <label for="fileAnhNen" class="form-label">Chọn ảnh nền sản phẩm <span style="color: red">*</span></label>
                    <input class="form-control" type="file" name="fileAnhNen" id="fileAnhNen" accept="image/*">
                </div>
                <div class="mb-3 col-md-6">
                    <label for="formFileMultiple" class="form-label">Chọn ảnh chi tiết sản phẩm ( 4 ảnh ) <span style="color: red">*</span></label>
                    <input class="form-control" type="file" name="fileAnhChiTiet[]" id="fileAnhChiTiet" multiple accept="image/*">
                </div>
                <div class="mb-3 col-md-12">
                    <label for="txtmota" class="form-label">Mô tả</label>
                    <textarea class="form-control" name="txtmota" id="txtmota" rows="3" placeholder="Nhập mô tả ..."></textarea>
                </div>

                <div class="form-group mb-4 mt-2 col-md-12 border rounded">
                    <p class="pt-2">Thông Số: <span style="color: red">*</span></p>
                    <?php
                    $ad->getThongSo_add_SanPham('SELECT *
                                                FROM size ');
                    ?>
                </div>
                <div class="mb-3 col-md-12 text-center">
                    <a href="danhSachSP.php"><button type="button" class="btn btn-outline-danger ">Quay lại</button></a>
                    <input type="reset" value="Nhập lại" class="btn btn-outline-secondary " name="btn_reset" id="btn_reset">
                    <button type="submit" name="nut_them" value="add-items" class="btn btn-outline-primary ">Thêm</button>
                </div>

            </div>
            <?php
            if (isset($_REQUEST['nut_them']) && $_REQUEST['nut_them'] == 'add-items') {
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
                if (isset($anhNen_name) && $anhNen_name != '') {
                    $anhNen_name_rm = time() . '_' . $anhNen_name;
                    if ($ad->uploadfile($anhNen_name_rm, $anhNen_tmp_name, "../main/img/img_product")) {

                        if ($ad->themxoasua("INSERT INTO sanpham( tenSP, moTa, donGia, anh, id_dongSP) 
                                            VALUES ('$tensp','$moTa','$dongia','$anhNen_name_rm','$DongSP')
                                            ") == 1) {
                            echo '<script>
                                        swal("Thành Công","Thêm sản phẩm thành công","success").then(function(){
                                            window.location="danhSachSP.php";
                                        });
                                        setTimeOut(function(){
                                            window.location="danhSachSP.php";
                                        }, 2000);
                                    </script>';
                            $id_maSP = $ad->laycot("SELECT id_maSP FROM sanpham ORDER BY id_maSP DESC LIMIT 1 ");
                            // echo $id_maSP;

                            // xử lý bảng anh_chitietsp
                            if (isset($anhChiTiet_name) && $anhChiTiet_name != '') {
                                for ($i = 0; $i < count($anhChiTiet_name); $i++) {
                                    $anhChiTiet_name_i = $anhChiTiet_name[$i];
                                    $anhChiTiet_tmp_name_i = $anhChiTiet_tmp_name[$i];
                                    $anhChiTiet_name_i_rename = time() . '_' . $anhChiTiet_name_i;
                                    if ($ad->uploadfile($anhChiTiet_name_i_rename, $anhChiTiet_tmp_name_i, "../main/img/img_product/img_product_detail")) {
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
                                }
                                // xử lý bảng anh_chitietsp
                                if (isset($anh1) && isset($anh2) && isset($anh3) && isset($anh4)) {
                                    if ($ad->themxoasua("INSERT INTO anh_chitietsp(id_maSP, anh1, anh2, anh3, anh4) 
                                                                    VALUES ('$id_maSP','$anh1','$anh2','$anh3','$anh4')
                                                ") != 1) {
                                        echo '<script>swal("Thất bại","Upload hình ảnh thất bại","error")</script>';
                                    }
                                }


                                // Xử lý kích thước
                                for ($i = 0; $i < count($thongSo); $i++) {
                                    $thongSo_i = isset($thongSo[$i]) ? $thongSo[$i] : '';  // Lấy thông số kỹ thuật (kích thước) nếu có

                                    // Kiểm tra kích thước không rỗng
                                    if ($thongSo_i != '') {
                                        // Thêm thông số kỹ thuật và màu sắc vào bảng chitietsanpham
                                        if ($ad->themxoasua("INSERT INTO chitietsanpham(id_maSP, size) 
                                                                        VALUES ('$id_maSP','$thongSo_i')") != 1) {
                                            echo '<script>swal("Thất bại", "Thêm thông số kỹ thuật thất bại", "error")</script>';
                                        }
                                    }
                                }
                            }
                        } else {
                            echo '<script>swal("Thất bại","thất bại","error")</script>';
                        }
                    } else {
                        echo '<script>swal("Thất bại","Upload hình ảnh thất bại","error")</script>';
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