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
if (isset($_REQUEST['id_HD'])) {
    if (filter_var($_REQUEST['id_HD'], FILTER_VALIDATE_INT) === false) {
        header('location:danhSachHD.php');
    } else {
        $id_HD = intval($_REQUEST['id_HD']);
        $ngayDat = $ad->laycot("select ngayDat from hoadon where id_HD='$id_HD'");
        $ngayGiao = $ad->laycot("select ngayGiao from hoadon where id_HD='$id_HD'");
        $tinhTrang = $ad->laycot("select tinhTrang from hoadon where id_HD='$id_HD'");
        $tongTien = $ad->laycot("select tongTien from hoadon where id_HD='$id_HD'");
        $thanhToan = $ad->laycot("select thanhToan from hoadon where id_HD='$id_HD'");
        $id_KH = $ad->laycot("select id_KH from hoadon where id_HD='$id_HD'");
        $id_NV_banHang = $ad->laycot("select id_NV_banHang from hoadon where id_HD='$id_HD'");
        $id_NV_giaoHang = $ad->laycot("select id_NV_giaoHang from hoadon where id_HD='$id_HD'");
        $hoTen = $ad->laycot("select CONCAT( nn.ho_NN , ' ', nn.ten_NN) as hoten
                            FROM hoadon hd JOIN nguoinhan nn ON hd.id_HD = nn.id_HD
                            WHERE hd.id_HD ='$id_HD'");
        $diaChi = $ad->laycot("select nn.diaChi_NN FROM hoadon hd JOIN nguoinhan nn ON hd.id_HD = nn.id_HD
                            WHERE hd.id_HD ='$id_HD'");
        $email = $ad->laycot("select kh.email FROM hoadon hd JOIN khachhang kh ON hd.id_KH = kh.id_KH
                            WHERE hd.id_HD ='$id_HD'");
        $sdt = $ad->laycot("select nn.sdt_NN FROM hoadon hd JOIN nguoinhan nn ON hd.id_HD = nn.id_HD
                            WHERE hd.id_HD ='$id_HD'");
        $tensp = $ad->laycot("SELECT sp.tenSP
                            FROM hoadon hd join chitiethoadon cthd ON hd.id_HD = cthd.id_HD
                            join sanpham sp ON cthd.id_maSP=sp.id_maSP
                            where hd.id_HD ='$id_HD'");
        $soLuong = $ad->laycot_lap("SELECT cthd.soLuong
                            FROM hoadon hd join chitiethoadon cthd ON hd.id_HD = cthd.id_HD
                            join sanpham sp ON cthd.id_maSP=sp.id_maSP
                            where hd.id_HD ='$id_HD'");
        $dongia = $ad->laycot_lap("SELECT cthd.donGia
                            FROM hoadon hd join chitiethoadon cthd ON hd.id_HD = cthd.id_HD
                            join sanpham sp ON cthd.id_maSP=sp.id_maSP
                            where hd.id_HD ='$id_HD'");
        $thanhTien = $ad->laycot_lap("SELECT cthd.thanhTien
                            FROM hoadon hd join chitiethoadon cthd ON hd.id_HD = cthd.id_HD
                            join sanpham sp ON cthd.id_maSP=sp.id_maSP
                            where hd.id_HD ='$id_HD'");
        $size = $ad->laycot_lap("SELECT cthd.size
                            FROM hoadon hd join chitiethoadon cthd ON hd.id_HD = cthd.id_HD
                            join sanpham sp ON cthd.id_maSP=sp.id_maSP
                            where hd.id_HD ='$id_HD'");
    }
}

?>
<?php
include 'component/header.php';
?>

<div class="card shadow mb-4">
    <form action="" method="post">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Chi tiết sản phẩm</h5>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="mb-3 col-6">
                    <label for="txt_hodem" class="form-label">Mã đơn hàng</label>
                    <input type="text" class="form-control" name="txt_hodem" id="txt_hodem" value="<?php echo $id_HD ?>" readonly>
                </div>
                <div class="mb-3 col-6">
                    <label for="txt_ten" class="form-label">Họ và tên</label>
                    <input type="text" class="form-control" name="txt_ten" id="txt_ten" value="<?php echo $hoTen ?>" readonly>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="txt_email" name="txt_email" value="<?php echo $email ?>" readonly>
                </div>
                <div class="mb-3 col-6">
                    <label for="txt_sdt" class="form-label">Số điện thoại</label>
                    <input type="text" class="form-control" id="txt_sdt" name="txt_sdt" value="<?php echo $sdt ?>" readonly>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="password" class="form-label col-sm-12">Sản phẩm</label>
                <?php
                for ($i = 0; $i < count($soLuong); $i++) {
                    echo '<input type="text" class="form-control col-sm-12 " id="txt_pass" name="txt_pass" value="' . $tensp . '     |     ' . $size[$i] . '     |   SL:' . $soLuong[$i] . '   |    Đơn giá:' . number_format($dongia[$i], 0, '', '.') . ' vnđ' . '   |   Thành tiền: ' . number_format($thanhTien[$i], 0, '', '.') . ' vnđ" readonly>';
                }
                ?>
            </div>

            <div class="mb-3">
                <label for="txt_diachi" class="form-label">Địa chỉ nhận hàng</label>
                <input type="text" class="form-control" id="txt_diachi" name="txt_diachi" value="<?php echo $diaChi ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="txt_diachi" class="form-label">Ngày đặt</label>
                <input type="text" class="form-control" id="txt_diachi" name="txt_diachi" value="<?php echo $ngayDat ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="txt_diachi" class="form-label">Ngày giao</label>
                <input type="text" class="form-control" id="txt_diachi" name="txt_diachi" value="<?php echo $ngayGiao ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="txt_diachi" class="form-label">Phương thức thanh toán</label>
                <input type="text" class="form-control" id="txt_diachi" name="txt_diachi" value="<?php echo $thanhToan ?>" readonly>
            </div>
        </div>

        <div class="card-footer text-center">
            <a href="danhSachHD.php?loc=cxl"><button type="button" class="btn btn-danger">Quay lại</button></a>
        </div>
        <?php

        ?>

    </form>
</div>
<?php
include_once 'component/footer.php'
?>