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
<!-- header -->
<?php 
    $pageTitle='Đăng ký';
    include_once 'component/header.php';
?>
<link rel="stylesheet" href="../assets/css/login_KH.css">
    <div class="container mt-5">
        <div class="box row">
            <div class="box-singup" align="center">
                <h3>Đăng ký</h3>
                <form id="form_signup" method="post">
                    <div class="form-group hoten mt-4 pt-3 mb-3">
                        <div>
                            <label for="txtho" class="">Nhập họ <span style="color:red">*</span></label>
                            <input type="text" class="mt-1" pattern="^[A-Za-zÀ-Ỹà-ỹ\s]+$" title="Không được chứa số" name="txtho" id="txtho" placeholder="Nhập họ" required>
                        </div>
                        <div>
                            <label for="txtho">Nhập tên <span style="color:red">*</span></label>
                            <input type="text" class="mt-1" pattern="^[A-Za-zÀ-Ỹà-ỹ\s]+$" title="Không được chứa số" name="txtten" id="txtten" placeholder="Nhập tên" required>
                        </div>

                    </div>
                    <div class="form-group mt-3 mb-3">
                        <label for="txtemail">Email <span style="color:red">*</span></label>
                        <input type="email" class="form-control" name="txtemail" id="txtemail" placeholder="Nhập email (abc@gmail.com)" required>
 
                    </div>
                    <div class="form-group mt-3 mb-3">
                        <label for="txtemail">Số điện thoại <span style="color:red">*</span></label>
                        <input type="text" class="form-control" pattern="[0-9]{10}" title="Số điện thoại 10 chữ số (VD: 0987654321)" name="txtsdt" id="txtsdt" placeholder="Nhập số điện thoại" required>
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
                    <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                    <button type="submit" name="nut_dangky" value="Đăng ký" class="btn btn-primary w-100" style="background-color:#4479d4">Đăng ký</button>
                    
                    <div align="center">
                        <?php
                            if(isset($_REQUEST['nut_dangky']) && $_REQUEST['nut_dangky']=='Đăng ký' && $_REQUEST['token'] == $_SESSION['token'])
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
                                        $sql="INSERT INTO khachhang(ho, ten, email, sdt, diaChi, matKhau,tinhTrang) VALUES (?,?,?,?,?,?,?)";
                                        $params = [$ho, $ten, $user, $sdt, $diaChi, $pass_mh, 'Active'];
                                        $result = $p->themxoasua($sql, $params);
                                        if($result==1)
                                        {
                                            echo'<script>
                                                swal("Thành công","Đăng ký thành công","success").then(function(){
                                                            window.location="login.php";
                                                });
                                                setTimeout(function(){
                                                    window.location="login.php";
                                                }, 2000);
                                            </script>';
                                            unset($_SESSION['token']);
                                        }
                                        else
                                        {
                                            echo'<script>swal("Thất bại","Đăng ký không thành công !","error")</script>';
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
                            else if(isset($_REQUEST['nut_dangky']) && $_REQUEST['nut_dangky']=='Đăng ký' && $_REQUEST['token'] != $_SESSION['token'])
                            {
                                echo'<script>swal("Thất bại","Không gửi lại form cũ","error")</script>';
                                unset($_SESSION['token']);
                            }
                        ?>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
    <!-- footer -->
<?php include_once 'component/footer.php' ?>