
<!-- header -->
<?php 
    $pageTitle='Đăng ký';
    include_once 'component/header.php';
?>
<link rel="stylesheet" href="../main/css/login_KH.css">
    <div class="container mt-5">
        <div class="box row">
            <div class="box-singup" align="center">
                <h3>Đăng ký</h3>
                <form id="form_signup" method="post">
                    <div class="form-group hoten mt-4 pt-3 mb-3">
                        <div>
                            <label for="txtho" class="">Nhập họ <span style="color:red">*</span></label>
                            <input type="text" class="mt-1" name="txtho" id="txtho" placeholder="Nhập họ" required>
                        </div>
                        <div>
                            <label for="txtho">Nhập tên <span style="color:red">*</span></label>
                            <input type="text" class="mt-1" name="txtten" id="txtten" placeholder="Nhập tên" required>
                        </div>
                        
                    </div>
                    <div class="form-group mt-3 mb-3">
                        <label for="txtemail">Email <span style="color:red">*</span></label>
                        <input type="email" class="form-control" name="txtemail" id="txtemail" placeholder="Nhập email (abc@gmail.com)" required>
 
                    </div>
                    <div class="form-group mt-3 mb-3">
                        <label for="txtemail">Số điện thoại <span style="color:red">*</span></label>
                        <input type="text" class="form-control" name="txtsdt" id="txtsdt" placeholder="Nhập số điện thoại" required>
                    </div>
                    <div class="form-group mt-3 mb-3">
                        <label for="txtemail">Địa chỉ</label>
                        <input type="text" class="form-control" name="txtdiachi" id="txtdiachi" placeholder="Nhập địa chỉ">
                    </div>
                    <div class="form-group mb-3">
                        <label for="txtemail">Nhập mật khẩu <span style="color:red">*</span></label>
                        <input type="password" class="form-control" id="txtpwd" name="txtpwd" placeholder="Nhập mật khẩu" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="txtemail">Xác nhận mật khẩu <span style="color:red">*</span></label>
                        <input type="password" class="form-control" id="pwd_xn" name="pwd_xn" placeholder="Xác nhận mật khẩu" require>
                    </div>
                    <p align="right">Nếu bạn đã có tài khoản? <a href="login.php">Đăng nhập</a></p>
                    <button type="submit" name="nut_dangky" value="Đăng ký" class="btn btn-primary w-100" style="background-color:#4479d4">Đăng ký</button>
                    
                    <div align="center">
                        <?php
                            if(isset($_REQUEST['nut_dangky']) && $_REQUEST['nut_dangky']=='Đăng ký')
                            {
                                $ho=$_REQUEST['txtho'];
                                $ten=$_REQUEST['txtten'];
                                $user=$_REQUEST['txtemail'];
                                $sdt=$_REQUEST['txtsdt'];
                                $diaChi=$_REQUEST['txtdiachi'];
                                $pass=$_REQUEST['txtpwd'];
                                $pass_sm=$_REQUEST['pwd_xn'];
                                if($p->checkTrung("select email from khachhang where email='$user'")!=1)
                                {
                                    if($pass==$pass_sm)
                                    {
                                        $pass_mh=md5($pass);
                                        if($p->themxoasua("INSERT INTO khachhang(ho, ten, email, sdt, diaChi, matKhau,tinhTrang) 
                                                            VALUES ('$ho','$ten','$user','$sdt','$diaChi','$pass_mh','Active')
                                                            ")==1)
                                        {
                                            echo'<script>swal("Thành công","Đăng ký thành công","success").then(function(){
                                                        window.location="login.php";
                                            })</script>';
                                        }
                                    }
                                    else
                                    {
                                        echo'<script>swal("Thất bại","Mật khẩu hoặc nhập lại mật khẩu không trùng khớp !","error")</script>';
                                    }
                                }
                                else
                                {
                                    echo'<script>swal("Thất bại","Email đã tồn tại !","error")</script>';
                                }
                                
                            }
                        ?>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
    <!-- footer -->
<?php include_once 'component/footer.php' ?>