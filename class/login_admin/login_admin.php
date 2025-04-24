<?php
    class loginAdmin
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

        public function mylogin_admin($user,$pass)
        {
            $sql="select * from nhanvien where emailNV='$user' and matKhauNV='$pass' and tinhTrang='Active' limit 1";
            $link=$this->myconnect();
            $result=mysqli_query($link,$sql);
            if(mysqli_num_rows($result)==1)
            {
                while($row=mysqli_fetch_array($result))
                {
                    $id_NV=$row['id_NV'];
                    $hoNV=$row['hoNV'];
                    $tenNV=$row['tenNV'];
                    $myuserNV=$row['emailNV'];
                    $sdtNV=$row['sdtNV'];
                    $diaChiNV=$row['diaChiNV'];
                    $passNV=$row['matKhauNV'];
                    $id_quyen=$row['id_quyen'];
                    session_start();
                    $_SESSION['id_NV']=$id_NV;
                    $_SESSION['hoNV']=$hoNV;
                    $_SESSION['tenNV']=$tenNV;
                    $_SESSION['emailNV']=$myuserNV;
                    $_SESSION['sdtNV']=$sdtNV;
                    $_SESSION['diaChiNV']=$diaChiNV;
                    $_SESSION['passNV']=$passNV;
                    $_SESSION['id_quyen']=$id_quyen;
                    return 1;
                }
            }
            else
            {
                return 0;
            }
        }  
        public function confirmlogin_admin($user,$pass)
        {
            $link=$this->myconnect();
            $sql="select* from nhanvien where emailNV='$user' and matKhauNV='$pass' limit 1";
            $result=mysqli_query($link,$sql);
            if(mysqli_num_rows($result)!=1)
            {
                echo'<script>swal("Thất bại","Vui lòng đăng nhập trước khi thanh toán","error").then(function(){
                                window.location="signin.php";
                })</script>';
            }
        }
    }
?>