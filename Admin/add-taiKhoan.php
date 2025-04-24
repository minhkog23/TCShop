<?php
    include '../class/admin.php';
    $ad=new admin();
?>

<?php
include 'component/header.php';
?>
    <div class="card shadow mb-4">
        <form action="" method="post">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Thêm tài khoản <span style="color: red;">*</span></h6>
            </div>
            
            <div class="card-body">
                <div class="row">
                    <div class="mb-3 col-6">
                        <label for="txt_hodem" class="form-label">Họ <span style="color: red;">*</span></label>
                        <input type="text" pattern="^[A-Za-zÀ-Ỹà-ỹ\s]+$" title="Không được chứa số" class="form-control" name="txt_hodem" id="txt_hodem" placeholder="Nhập họ" required>
                    </div>
                    <div class="mb-3 col-6">
                        <label for="txt_ten" class="form-label">Tên <span style="color: red;">*</span></label>
                        <input type="text" pattern="^[A-Za-zÀ-Ỹà-ỹ\s]+$" title="Không được chứa số" class="form-control" name="txt_ten" id="txt_ten" placeholder="Nhập tên" required>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-6">
                        <label for="email" class="form-label">Email <span style="color: red;">*</span></label>
                        <input type="email" class="form-control" id="txt_email" name="txt_email" placeholder="Nhập email" required>
                    </div>
                    <div class="mb-3 col-6">
                        <label for="txt_sdt" class="form-label">Số điện thoại <span style="color: red;">*</span></label>
                        <input type="tel" pattern="[0-9]{10}" title="Số điện thoại 10 chữ số (VD: 0987654321)" class="form-control" id="txt_sdt" name="txt_sdt" placeholder="Nhập số điện thoại" required>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-6">
                        <label for="password" class="form-label">Mật khẩu <span style="color: red;">*</span></label>
                        <input type="password" class="form-control" id="txt_pass" name="txt_pass" placeholder="Nhập mật khẩu" required>
                    </div>
                    <div class="mb-3 col-6" hidden>
                        <label for="txt_tinhTrang" class="form-label">Tình trạng tài khoản</label>
                        <input type="text" class="form-control" id="txt_tinhTrang" name="txt_tinhTrang" >
                    </div>

                    <div class="mb-3 col-6">
                        <label for="txt_quyen" class="form-label">Quyền của tài khoản</label>
                        <select class="form-control" name="select_quyen" id="txt_quyen" required>
                            <option value="" selected disabled>Vui lòng chọn quyền</option>
                            <?php
                                $ad->getQuyen_NV("select * from quyen");
                            ?> 
                        </select>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="txt_diachi" class="form-label">Địa chỉ</label>
                    <input type="text" class="form-control" id="txt_diachi" name="txt_diachi" placeholder="Nhập địa chỉ">
                </div>
            </div>

            <div class="card-footer text-center">
                <a href="taiKhoan-nv.php"><button type="button" class="btn btn-danger">Quay lại</button></a>
                <input type="reset" class="btn btn-secondary" value="Nhập lại" name="btn_reset" id="btn_reset">
                <input type="submit" value="Thêm" class="btn btn-primary" id="btn_them" name="btn_them">
            </div>
            <?php
                if(isset($_REQUEST['btn_them']) && $_REQUEST['btn_them'] == "Thêm")
                {
                    $txt_hodem=$_REQUEST['txt_hodem'];
                    $txt_ten=$_REQUEST['txt_ten'];
                    $txt_email=$_REQUEST['txt_email'];
                    $txt_sdt=$_REQUEST['txt_sdt'];
                    $txt_diachi=$_REQUEST['txt_diachi'];
                    $txt_pass=$_REQUEST['txt_pass'];
                    // $txt_tinhTrang=$_REQUEST['txt_tinhTrang'];
                    $select_quyen= $_REQUEST['select_quyen'];
                    if(isset($txt_hodem) && $txt_hodem!="" ||isset($txt_ten) && $txt_ten!="" ||isset($txt_email) && $txt_email!="" 
                            ||isset($txt_sdt) && $txt_sdt!="" ||isset($txt_diachi) && $txt_diachi!="" ||isset($txt_pass) && $txt_pass!="" 
                            ||isset($select_quyen) && $select_quyen!="")
                    {
                        if($ad->checkTrung("select emailNV from nhanvien where emailNV='$txt_email'")!=1)
                        {
                            $pass=md5($txt_pass);
                            if($ad->themxoasua("INSERT INTO nhanvien(hoNV, tenNV, emailNV, sdtNV, diaChiNV, matKhauNV, tinhTrang, id_quyen) 
                        VALUES ('$txt_hodem','$txt_ten','$txt_email','$txt_sdt','$txt_diachi','$pass','Active','$select_quyen')")==1)
                            {
                                echo "<script>
                                        swal('Thành công','Thêm tài khoản thành công!','success').then(function() {
                                            window.location = 'taiKhoan-nv.php';
                                        });
                                </script>";
                            }
                            else
                            {
                                echo "<script>alert('Thêm tài khoản không thành công!')</script>";
                                echo "<script>window.location='add-taiKhoan.php'</script>";
                            }
                        }
                        else
                        {
                            echo "<script>
                                        swal('Thất bại','Email đã tồn tại. Vui lòng nhập email khác !','error').then(function() {
                                            window.location = 'add-taiKhoan.php';
                                        });
                                </script>";
                        }
                    }
                    else
                    {
                        echo "<script>alert('Vui lòng nhập đầy đủ thông tin!')</script>";
                    }

                }  
            ?>
            
        </form>
    </div>
<?php
include_once 'component/footer.php'
?>