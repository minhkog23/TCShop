<?php
    include_once 'badminton.php';
    class confirm extends badminton
    {
        public function myconnect()
        {
            $con=mysqli_connect("localhost","root","","badminton_db");
            if(!$con)
            {
                echo 'Không thể kết nối database';
                exit();
            }
            else
            {
                mysqli_set_charset($con,'utf8');
                return $con;
            }
        }

        public function confirmlogin($user,$pass)
        {
            $link=$this->myconnect();
            $sql="select* from khachhang where email=? and matKhau=? limit 1";
            $stmt=mysqli_prepare($link,$sql);
            mysqli_stmt_bind_param($stmt,"ss",$user,$pass);
            mysqli_stmt_execute($stmt);
            $result=mysqli_stmt_get_result($stmt);
            if(mysqli_num_rows($result)!=1)
            {
                echo'<script>swal("Thất bại","Vui lòng đăng nhập trước khi thanh toán","error").then(function(){
                                window.location="login.php";
                })</script>';
            }
        }
    }
?>
