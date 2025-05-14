<?php
class loginAdmin
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

    public function mylogin_admin($user, $pass)
    {
        $sql = "select * from nhanvien where emailNV=? and matKhauNV=? and tinhTrang='Active' AND id_quyen IN (1, 4)  limit 1";
        $link = $this->myconnect();
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $user, $pass);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) == 1) {
            while ($row = mysqli_fetch_array($result)) {
                $id_NV = htmlspecialchars($row['id_NV'], ENT_QUOTES, 'UTF-8');
                $hoNV = htmlspecialchars($row['hoNV'], ENT_QUOTES, 'UTF-8');
                $tenNV = htmlspecialchars($row['tenNV'], ENT_QUOTES, 'UTF-8');
                $myuserNV = htmlspecialchars($row['emailNV'], ENT_QUOTES, 'UTF-8');
                $sdtNV = htmlspecialchars($row['sdtNV'], ENT_QUOTES, 'UTF-8');
                $diaChiNV = htmlspecialchars($row['diaChiNV'], ENT_QUOTES, 'UTF-8');
                $passNV = htmlspecialchars($row['matKhauNV'], ENT_QUOTES, 'UTF-8');
                $id_quyen = htmlspecialchars($row['id_quyen'], ENT_QUOTES, 'UTF-8');

                if(session_status()===PHP_SESSION_NONE){
                    session_start();
                }
                $_SESSION['id_NV'] = $id_NV;
                $_SESSION['hoNV'] = $hoNV;
                $_SESSION['tenNV'] = $tenNV;
                $_SESSION['emailNV'] = $myuserNV;
                $_SESSION['sdtNV'] = $sdtNV;
                $_SESSION['diaChiNV'] = $diaChiNV;
                $_SESSION['passNV'] = $passNV;
                $_SESSION['id_quyen'] = $id_quyen;
                return 1;
            }
        } else {
            return 0;
        }
    }
    public function confirmlogin_admin($user, $pass)
    {
        $link = $this->myconnect();
        $sql = "select* from nhanvien where emailNV=? and matKhauNV=? limit 1";
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $user, $pass);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) != 1) {
            echo '<script>swal("Thất bại","Vui lòng đăng nhập trước khi thanh toán","error").then(function(){
                                window.location="signin.php";
                })</script>';
        }
    }
}
