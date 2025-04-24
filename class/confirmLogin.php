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
            $sql="select* from khachhang where email='$user' and matKhau='$pass' limit 1";
            $result=mysqli_query($link,$sql);
            if(mysqli_num_rows($result)!=1)
            {
                echo'<script>swal("Thất bại","Vui lòng đăng nhập trước khi thanh toán","error").then(function(){
                                window.location="login.php";
                })</script>';
            }
        }
    }
?>
