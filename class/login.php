<?php
    include_once 'badminton.php';
    class login extends badminton
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

        public function mylogin($user,$pass)
        {
            $sql="select * from khachhang where email='$user' and matKhau='$pass' and tinhTrang='Active' limit 1";
            $link=$this->myconnect();
            $result=mysqli_query($link,$sql);
            if(mysqli_num_rows($result)==1)
            {
                while($row=mysqli_fetch_array($result))
                {
                    $id_KH=$row['id_KH'];
                    $ho=$row['ho'];
                    $ten=$row['ten'];
                    $myuser=$row['email'];
                    $sdt=$row['sdt'];
                    $diaChi=$row['diaChi'];
                    $pass=$row['matKhau'];
                    // session_start();
                    $_SESSION['id_KH']=$id_KH;
                    $_SESSION['ho']=$ho;
                    $_SESSION['ten']=$ten;
                    $_SESSION['email']=$myuser;
                    $_SESSION['sdt']=$sdt;
                    $_SESSION['diaChi']=$diaChi;
                    $_SESSION['pass']=$pass;
                    return 1;
                }
            }
            else
            {
                return 0;
            }
        }  
        // in danh mục
        public function getDanhMuc($sql)
        {
            $link=$this->myconnect();
            $result=mysqli_query($link,$sql);
            if(mysqli_num_rows($result)>0)
            {
                while($row=mysqli_fetch_assoc($result))
                {
                    $id_ThuongHieu=$row['id_ThuongHieu'];
                    $tenThuongHieu=$row['tenThuongHieu'];
                    echo '<li class="nav-dropdown"><a class="nav-link-dropdown" href="product_NCC.php?id_ThuongHieu='.$id_ThuongHieu.'">'.$tenThuongHieu.'</a></li>';
                }
            }
        } 
    }
?>