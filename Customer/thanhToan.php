<?php
session_start();
include '../class/confirmLogin.php';
$cf = new confirm();
if (isset($_SESSION['email']) && isset($_SESSION['pass'])) {
    $cf->confirmlogin($_SESSION['email'], $_SESSION['pass']);
} else {
    header('location:login.php');
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
<!-- Header -->
<?php
include_once '../class/login.php';
$p = new login();
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
    <title><?php echo isset($pageTitle) ? $pageTitle : "Thanh toán"; ?></title>
</head>

<body>
    <div class="container mt-5">
        <h2>Thông tin thanh toán</h2>
        <?php
        $id_KH = $_SESSION['id_KH'];
        $ho = $p->laycot("select ho from khachhang where id_KH=?",[$id_KH]);
        $ten = $p->laycot("select ten from khachhang where id_KH=?",[$id_KH]);
        $email = $p->laycot("select email from khachhang where id_KH=?",[$id_KH]);
        $sdt = $p->laycot("select sdt from khachhang where id_KH=?",[$id_KH]);
        $diaChi = $p->laycot("select diaChi from khachhang where id_KH=?",[$id_KH]);
        ?>
        <form method="POST">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <input type="hidden" class="form-control" id="txtdate" name="txtdate">
                    </div>
                    <div class="mb-3">
                        <input type="hidden" class="form-control" id="txttinhtrang" name="txttinhtrang" value="Chờ xử lý">
                    </div>
                    <div class="mb-3">
                        <label for="txtho" class="form-label">Họ <span style="color:red">*</span></label>
                        <input type="text" class="form-control" id="txtho" name="txtho" placeholder="Nhập họ ..." value="<?php echo $ho ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="txtten" class="form-label">Tên <span style="color:red">*</span></label>
                        <input type="text" class="form-control" id="txtten" name="txtten" placeholder="Nhập tên người nhận..." value="<?php echo $ten ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="txtemail" class="form-label">Email <span style="color:red">*</span></label>
                        <input type="email" class="form-control" id="txtemail" name="txtemail" placeholder="Nhập email ..." value="<?php echo $email ?>" readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="txtsdt" class="form-label">Số điện thoại <span style="color:red">*</span></label>
                        <input type="text" class="form-control" id="txtsdt" name="txtsdt" placeholder="Nhập số điện thoại ..." value="<?php echo $sdt ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="txtdiachi" class="form-label">Địa chỉ nhận hàng<span style="color:red">*</span></label>
                        <input type="text" class="form-control" id="txtdiachi" name="txtdiachi" placeholder="Nhập địa chỉ nhận hàng ..." value="<?php echo $diaChi ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="txtmota" class="form-label">Ghi chú</label>
                        <textarea class="form-control" id="txtmota" name="txtmota" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="selectPT" class="form-label">Phương thức thanh toán</label>
                        <select class="form-control" id="selectPT" name="selectPT" required>
                            <option value="Tiền mặt">Tiền mặt</option>
                            <!-- <option value="Thẻ tín dụng">Thẻ tín dụng</option>
                        <option value="Chuyển khoản">Chuyển khoản ngân hàng</option> -->
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <h3>Thông tin giỏ hàng</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th>Tổng</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            if (isset($_REQUEST['cart'])) {
                                $cart = $_REQUEST['cart'];
                                $total = 0;
                                $cartLength = count($cart);

                                for ($i = 0; $i < $cartLength; $i++) {
                                    $item = $cart[$i];
                                    $itemTotal = $cart[$i]['price'] * $cart[$i]['quantity'];
                                    $total += $itemTotal;
                                    echo '<input type="hidden" name="cart[' . $i . '][img]" value="' . $item['img'] . '">
                                                <input type="hidden" name="cart[' . $i . '][product_name]" value="' . $item['product_name'] . '">
                                                <input type="hidden" name="cart[' . $i . '][price]" value="' . $item['price'] . '">
                                                <input type="hidden" name="cart[' . $i . '][size]" value="' . $item['size'] . '">
                                                <input type="hidden" name="cart[' . $i . '][quantity]" value="' . $item['quantity'] . '">';
                                    echo '<tr>
                                        <td>' . $cart[$i]['product_name'] . ' ( ' . $cart[$i]['size'] . ' )</td>
                                        <td>' . $cart[$i]['quantity'] . '</td>
                                        <td>' . number_format($cart[$i]['price'], 0, ',', '.') . ' VNĐ</td>
                                        <td>' . number_format($itemTotal, 0, ',', '.') . ' VNĐ</td>
                                    </tr>';
                                }
                            }
                            ?>
                        </tbody>

                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-end">Tổng cộng</th>
                                <th>
                                    <?php if (isset($total)) {
                                        echo number_format($total, 0, ',', '.') . 'VNĐ';
                                    } else {
                                        echo '0 VNĐ';
                                    }
                                    ?>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="d-flex justify-content-center">
                        <a class="btn btn-primary" href="cart.php" role="button">Quay lại giỏ hàng</a>
                        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                        <button type="submit" name="nut_dat" value="Đặt hàng" class="btn btn-primary w-50">Đặt hàng</button>
                    </div>

                </div>
            </div>
            <?php
            if (isset($_REQUEST['nut_dat']) && $_REQUEST['nut_dat'] == 'Đặt hàng' && $_REQUEST['token'] == $_SESSION['token']) {
                if(!isset($_REQUEST['cart']) || empty($_REQUEST['cart'])) {
                    echo '<script>swal("Thất bại","Giỏ hàng trống","error").then(function(){
                        window.location="cart.php";
                    })</script>';
                    exit();
                }
                $tinhTrang = $_REQUEST['txttinhtrang'];
                $ho = $_REQUEST['txtho'];
                $ten = $_REQUEST['txtten'];
                $email = $_REQUEST['txtemail'];
                $sdt = $_REQUEST['txtsdt'];
                $diaChi = $_REQUEST['txtdiachi'];
                $moTa = $_REQUEST['txtmota'];
                $selectPT = $_REQUEST['selectPT'];
                $sql="INSERT INTO hoadon(tinhTrang, thanhToan,id_KH) VALUES (?,?,?)";
                $params = [$tinhTrang, $selectPT, $id_KH];
                $result = $p->themxoasua($sql, $params);
                if ($result != 1) {
                    echo '<script>
                        swal("Thất bại","Đặt hàng thành công","erorr").then(function(){
                            window.location="cart.php";
                        });
                        setTimeout(function(){
                            window.location="cart.php";
                        }, 2000);
                    </script>';
                }
                // if ($p->themxoasua("INSERT INTO hoadon(tinhTrang, thanhToan,id_KH) 
                // VALUES ('$tinhTrang','$selectPT','$id_KH')
                // ") != 1) {
                //     echo '<script>
                //         swal("Thất bại","Đặt hàng thất bại","error").then(function(){
                //             window.location="cart.php";
                //         });
                //         setTimeout(function(){
                //             window.location="cart.php";
                //         }, 2000);
                //     </script>';
                // }

                $id_HD = $p->laycot("select id_HD from hoadon order by id_HD desc limit 1");
                $cart = $_REQUEST['cart'];
                $total = 0;
                $cartLength = count($cart);
                for ($i = 0; $i < $cartLength; $i++) {
                    $item = $cart[$i];
                    $itemTotal = $cart[$i]['price'] * $cart[$i]['quantity'];
                    $total += $itemTotal;
                    $img = $item['img'];
                    $tenSP = $item['product_name'];
                    $donGia = $item['price'];
                    $size = $item['size'];

                    $tensp = $cart[$i]['product_name'];
                    $sl = $cart[$i]['quantity'];
                    $dongia = $cart[$i]['price'];
                    $tongTien = $itemTotal;

                    $id_maSP = $p->laycot("select id_maSP from sanpham where tenSP=? ",[$tensp]);
                    $sql="INSERT INTO chitiethoadon(id_HD, soLuong, donGia, thanhTien, size, id_maSP) VALUES (?,?,?,?,?,?)";
                    $params = [$id_HD, $sl, $dongia, $tongTien, $size, $id_maSP];
                    $result = $p->themxoasua($sql, $params);
                    if ($result != 1) {
                        echo '<script>swal("Thất bại","Đặt hàng thất bại","error").then(function(){
                            window.location="cart.php";
                        })</script>';
                    }
                    // if ($p->themxoasua("INSERT INTO chitiethoadon(id_HD, soLuong, donGia, thanhTien, size, id_maSP) 
                    //                     VALUES ('$id_HD','$sl','$dongia','$tongTien','$size','$id_maSP')

                    //                 ") != 1) {
                    //     echo '<script>swal("Thất bại","Đặt hàng thất bại","error").then(function(){
                    //         window.location="cart.php";
                    //     })</script>';
                    // }
                }
                $sql="UPDATE hoadon SET tongTien=? WHERE id_HD=?";
                $params = [$total, $id_HD];
                $result = $p->themxoasua($sql, $params);
                if ($result == 1) {
                    $sql="INSERT INTO nguoinhan(id_HD,ho_NN, ten_NN, diaChi_NN, sdt_NN) VALUES (?,?,?,?,?)";
                    $params = [$id_HD, $ho, $ten, $diaChi, $sdt];
                    $result = $p->themxoasua($sql, $params);
                    if ($result == 1) {
                        echo '<script>
                            swal("Thành công","Đặt hàng thành công","success").then(function(){
                            window.location="index.php";
                            });
                            setTimeout(function(){
                                window.location="index.php";
                            }, 2000);
                        </script>';
                        unset($_SESSION['cart']);
                        unset($_SESSION['cart_count']);
                    }
                }
                else {
                    echo '<script>swal("Thất bại","Đặt hàng thất bại","error").then(function(){
                        window.location="cart.php";
                    })</script>';
                }
                unset($_SESSION['token']);

                // if ($p->themxoasua("UPDATE hoadon 
                //                     SET tongTien='$total'
                //                     WHERE id_HD='$id_HD'") == 1) {
                //     if($p->themxoasua("INSERT INTO nguoinhan(id_HD,ho_NN, ten_NN, diaChi_NN, sdt_NN) VALUES ('$id_HD','$ho','$ten','$diaChi','$sdt')")==1)
                //     {
                //         echo '<script>
                //             swal("Thành công","Đặt hàng thành công","success").then(function(){
                //             window.location="index.php";
                //             });
                //             setTimeout(function(){
                //                 window.location="index.php";
                //             }, 2000);
                //         </script>';
                //         unset($_SESSION['cart']);
                //         unset($_SESSION['cart_count']);
                //     }
                    
                    
                // } else {
                //     echo '<script>swal("Thất bại","Đặt hàng thất bại","error").then(function(){
                //         window.location="cart.php";
                //     })</script>';
                // }
            }
            else if (isset($_REQUEST['nut_dat']) && $_REQUEST['nut_dat'] == 'Đặt hàng' && $_REQUEST['token'] != $_SESSION['token']) {
                echo '<script>swal("Thất bại","Không gửi lại form cũ","error")</script>';
                unset($_SESSION['token']);
            }
            ?>
        </form>
    </div>