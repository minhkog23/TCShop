<?php
include_once 'badminton.php';
class login extends badminton
{
    public function myconnect()
    {
        $con = mysqli_connect("localhost", "root", "", "badminton_db");
        if (!$con) {
            echo 'Không thể kết nối database';
            exit();
        } else {
            mysqli_set_charset($con, 'utf8');
            return $con;
        }
    }

    public function mylogin($user, $pass)
    {
        // Sử dụng dấu "?" thay vì chèn trực tiếp giá trị vào câu lệnh SQL
        $sql = "select * from khachhang where email= ? and matKhau= ? and tinhTrang='Active' limit 1";
        $link = $this->myconnect();
        $stmt = mysqli_prepare($link, $sql);
        // Liên kết tham số vào câu lệnh chuẩn bị
        mysqli_stmt_bind_param($stmt, "ss", $user, $pass);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) == 1) {
            while ($row = mysqli_fetch_array($result)) {
                $id_KH = htmlspecialchars($row['id_KH'], ENT_QUOTES, 'UTF-8');
                $ho = htmlspecialchars($row['ho'], ENT_QUOTES, 'UTF-8');
                $ten = htmlspecialchars($row['ten'], ENT_QUOTES, 'UTF-8');
                $myuser = htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8');
                $sdt = htmlspecialchars($row['sdt'], ENT_QUOTES, 'UTF-8');
                $diaChi = htmlspecialchars($row['diaChi'], ENT_QUOTES, 'UTF-8');
                $pass = htmlspecialchars($row['matKhau'], ENT_QUOTES, 'UTF-8');

                // session_start();
                $_SESSION['id_KH'] = $id_KH;
                $_SESSION['ho'] = $ho;
                $_SESSION['ten'] = $ten;
                $_SESSION['email'] = $myuser;
                $_SESSION['sdt'] = $sdt;
                $_SESSION['diaChi'] = $diaChi;
                $_SESSION['pass'] = $pass;
                return 1;
            }
        } else {
            return 0;
        }
    }
    // in danh mục
    public function getDanhMuc($sql)
    {
        $link = $this->myconnect();
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Sử dụng htmlspecialchars() để bảo vệ dữ liệu xuất ra khỏi XSS
                $id_ThuongHieu = htmlspecialchars($row['id_ThuongHieu'], ENT_QUOTES, 'UTF-8');
                $tenThuongHieu = htmlspecialchars($row['tenThuongHieu'], ENT_QUOTES, 'UTF-8');
                echo '<li class="nav-dropdown"><a class="nav-link-dropdown" href="product_NCC.php?id_ThuongHieu=' . $id_ThuongHieu . '">' . $tenThuongHieu . '</a></li>';
            }
        }
    }
}
