<?php
    include 'badminton.php';
    class admin extends badminton
    {

        // Hàm lấy thương hiệu
        public function getThuongHieu($sql)
        {
            $link=$this->connect();
            $result=mysqli_query($link,$sql);
            if(mysqli_num_rows($result)>0)
            {
                $count=1;
                while($row=mysqli_fetch_array($result))
                {
                    $id_ThuongHieu=$row['id_ThuongHieu'];
                    $tenThuongHieu=$row['tenThuongHieu'];
                    $moTa=$row['moTa'];
                    echo '<tr>
                        <td>'.$count.'</td>
                        <td>'.$tenThuongHieu.'</td>
                        <td>'.$moTa.'</td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="id_xoa" id="id_xoa" value="'.$id_ThuongHieu.'">
                                <a href="sua-ThuongHieu.php?id_sua='.$id_ThuongHieu.'" class="btn btn-warning btn-sm">
                                    <span class="text">Sửa</span>
                                </a>
                                <input type="submit" name="nut_xoa" id="nut_xoa" class="btn btn-danger btn-sm" value="Xóa" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không ?\')">
                            </form>
                        </td>
                    </tr>';
                    $count++;
                }
            }
            else
            {
                echo 'Không có thương hiệu nào';
            }
        }

        // Hàm lấy thương hiệu cho trang thêm sản phẩm
        public function getThuongHieu_addTH($sql)
        {
            $link=$this->connect();
            $result=mysqli_query($link,$sql);
            if(mysqli_num_rows($result)>0)
            {
                $count=1;
                while($row=mysqli_fetch_array($result))
                {
                    $id_ThuongHieu=$row['id_ThuongHieu'];
                    $tenThuongHieu=$row['tenThuongHieu'];
                    $moTa=$row['moTa'];
                    echo '<option value="'.$id_ThuongHieu.'">'.$tenThuongHieu.'</option>';
                    $count++;
                }
            }
            else
            {
                echo 'Không có thương hiệu nào';
            }
        }

        // Hàm lấy dòng sản phẩm
        public function getDongSP($sql)
        {
            $link=$this->connect();
            $result=mysqli_query($link,$sql);
            if(mysqli_num_rows($result)>0)
            {
                $count=1;
                while($row=mysqli_fetch_array($result))
                {
                    $id_dongSP=$row['id_dongSP'];
                    $tenDongSP=$row['tenDongSP'];
                    $id_ThuongHieu=$row['id_ThuongHieu'];
                    $tenThuongHieu=$row['tenThuongHieu'];
                    echo '<tr>
                        <td>'.$count.'</td>
                        <td>'.$tenDongSP.'</td>
                        <td>'.$tenThuongHieu.'</td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="id_xoa" id="id_xoa" value="'.$id_dongSP.'">
                                <a href="sua-dongSanPham.php?id_sua='.$id_dongSP.'" class="btn btn-warning btn-sm">
                                    <span class="text">Sửa</span>
                                </a>
                                        
                                <input type="submit" name="nut_xoa" id="nut_xoa" class="btn btn-danger btn-sm" value="Xóa" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không ?\')">
                            </form>
                        </td>
                    </tr>';
                    $count++;
                }
            }
            else
            {
                echo 'Không có thương hiệu nào';
            }
        }
        
        // hàm lấy tất cả sản phẩm
        public function getSP($sql)
        {
            $link=$this->connect();
            $result=mysqli_query($link,$sql);
            if(mysqli_num_rows($result)>0)
            {
                $count=1;
                echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Ảnh nền</th>
                            <th>Tên sản phẩm</th>
                            <th>Đơn giá</th>
                            <th>Dòng sản phẩm</th>
                            <th>Thương hiệu</th>
                            <th>SPTB</th>
                            <th>Chứ năng</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>Ảnh nền</th>
                            <th>Tên sản phẩm</th>
                            <th>Đơn giá</th>
                            <th>Dòng sản phẩm</th>
                            <th>Thương hiệu</th>
                            <th>SPTB</th>
                            <th>Chứ năng</th>
                        </tr>
                    </tfoot>
                    <tbody>';
                while($row=mysqli_fetch_array($result))
                {
                    $id_maSP=$row['id_maSP'];
                    $tenSP=$row['tenSP'];
                    $moTa=$row['moTa'];
                    $donGia=$row['donGia'];
                    $anh=$row['anh'];
                    $id_SPTB=$row['id_SPTB'];
                    $id_dongSP=$row['id_dongSP'];
                    $tenDongSP=$row['tenDongSP'];
                    $tenThuongHieu=$row['tenThuongHieu'];
                    echo '<tr>
                        <td>'.$count.'</td>
                        <td><img width="50px" height="50px" src="../main/img/img_product/'.$anh.'" alt="Load..."></td>
                        <td>'.$tenSP.'</td>
                        <td>'.$donGia.'</td>
                        <td>'.$tenDongSP.'</td>
                        <td>'.$tenThuongHieu.'</td>
                        <td>'.$id_SPTB.'</td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="id_xoa" id="id_xoa" value="'.$id_maSP.'">
                                <a href="sua-SanPham.php?id_sua='.$id_maSP.'" class="btn btn-warning btn-sm">
                                    <span class="text">Sửa</span>
                                </a>
                                        
                                <input type="submit" name="nut_xoa" id="nut_xoa" class="btn btn-danger btn-sm" value="Xóa" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không ?\')">
                            </form>
                        </td>
                    </tr>';
                    $count++;
                }
                echo '</tbody>
                </table>';
            }
            else
            {
                echo '<h3 align="center">Không có sản phẩm nào !</h3>';
            }
        }

        // Hàm lấy tất cả hóa đơn nhưng không có chức năng
        public function getHD($sql)
        {
            $link=$this->connect();
            $result=mysqli_query($link,$sql);
            if(mysqli_num_rows($result)>0)
            {
                echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã hóa đơn</th>
                            <th>Mã khách hàng</th>
                            <th>Mã Nhân viên</th>
                            <th>Ngày đặt</th>
                            <th>Tổng tiền</th>
                            <th>Tình trạng</th>
                            <th>Chi tiết đơn</th>
                            <th>Phương thức</th>
                            <!--<th>Chức năng</th>-->
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Mã hóa đơn</th>
                            <th>Mã khách hàng</th>
                            <th>Mã Nhân viên</th>
                            <th>Ngày đặt</th>
                            <th>Tổng tiền</th>
                            <th>Tình trạng</th>
                            <th>Chi tiết đơn</th>
                            <th>Phương thức</th>
                            <!--<th>Chức năng</th>-->
                        </tr>
                    </tfoot>
                    <tbody>
                    ';
                while($row=mysqli_fetch_array($result))
                {
                    $id_HD=$row['id_HD'];
                    $id_KH=$row['id_KH'];
                    $id_NV_banHang=$row['id_NV_banHang'];
                    $ngayDat=$row['ngayDat'];
                    $tinhTrang=$row['tinhTrang'];
                    $tongTien=$row['tongTien'];
                    $thanhToan=$row['thanhToan'];
                    
                    echo '<tr>
                        <td>'.$id_HD.'</td>
                        <td>'.$id_KH.'</td>
                        <td>'.$id_NV_banHang.'</td>
                        <td>'.$ngayDat.'</td>
                        <td>'.number_format($tongTien,0,',','.').' vnđ</td>
                        <td><span class="badge bg-secondary" style="color:white; font-size:14px" >'.$tinhTrang.'</span></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="id_xoa" id="id_xoa" value="'.$id_HD.'">
                                <a href="xemChiTiet_HD.php?id_HD='.$id_HD.'" class="btn btn-warning btn-sm">
                                    <span class="text">Chi tiết</span>
                                </a>
                            </form>
                        </td>
                        <td>'.$thanhToan.'</td>
                        <!--<td>
                            <form method="post">
                                <input type="hidden" name="id_xoa" id="id_xoa" value="">
                                <input type="submit" name="nut_duyet" value="Duyệt" class="btn btn-danger btn-sm">
                            </form>
                        </td>-->
                    </tr>';
                }
                echo '</tbody>
                </table>';
            }
            else
            {
                echo '<h3 align="center">Không có đơn hàng nào </h3>';
            }
        }

        // Hàm lấy hóa đơn chờ xử lý
        public function getHD_cxl($sql)
        {
            $link=$this->connect();
            $result=mysqli_query($link,$sql);
            if(mysqli_num_rows($result)>0)
            {
                echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã hóa đơn</th>
                            <th>Mã khách hàng</th>
                            <!--<th>Mã Nhân viên</th>-->
                            <th>Ngày đặt</th>
                            <th>Tổng tiền</th>
                            <th>Tình trạng</th>
                            <th>Chi tiết đơn</th>
                            <th>Phương thức</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Mã hóa đơn</th>
                            <th>Mã khách hàng</th>
                            <!--<th>Mã Nhân viên</th>-->
                            <th>Ngày đặt</th>
                            <th>Tổng tiền</th>
                            <th>Tình trạng</th>
                            <th>Chi tiết đơn</th>
                            <th>Phương thức</th>
                            <th>Chức năng</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    ';
                while($row=mysqli_fetch_array($result))
                {
                    $id_HD=$row['id_HD'];
                    $id_KH=$row['id_KH'];
                    //$id_NV_banHang=$row['id_NV_banHang'];
                    $ngayDat=$row['ngayDat'];
                    $tinhTrang=$row['tinhTrang'];
                    $tongTien=$row['tongTien'];
                    $thanhToan=$row['thanhToan'];
                    
                    echo '<tr>
                        <td>'.$id_HD.'</td>
                        <td>'.$id_KH.'</td>
                        
                        <td>'.$ngayDat.'</td>
                        
                        <td>'.number_format($tongTien,0,',','.').' vnđ</td>
                        <td><span class="badge bg-secondary" style="color:white; font-size:14px" >'.$tinhTrang.'</span></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="id_HD" id="id_HD" value="'.$id_HD.'">
                                <a href="xemChiTiet_HD.php?id_HD='.$id_HD.'" class="btn btn-warning btn-sm">
                                    <span class="text">Chi tiết</span>
                                </a>
                            </form>
                        </td>
                        <td>'.$thanhToan.'</td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="id_dxn" id="id_dxn" value="'.$id_HD.'">
                                <input type="submit" name="nut_dxn" value="Xác nhận" class="btn btn-success btn-sm">
                            </form>
                        </td>
                    </tr>';
                }
                echo '</tbody>
                </table>';
            }
            else
            {
                echo '<h3 align="center">Không có đơn hàng nào </h3>';
            }
        }

        // Hàm lấy hóa đơn đã xác nhận
        public function getHD_dxn($sql)
        {
            $link=$this->connect();
            $result=mysqli_query($link,$sql);
            if(mysqli_num_rows($result)>0)
            {
                echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã hóa đơn</th>
                            <th>Mã khách hàng</th>
                            <!--<th>Mã Nhân viên</th>-->
                            <th>Ngày đặt</th>
                            <th>Tổng tiền</th>
                            <th>Tình trạng</th>
                            <th>Chi tiết đơn</th>
                            <th>Phương thức</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Mã hóa đơn</th>
                            <th>Mã khách hàng</th>
                            <!--<th>Mã Nhân viên</th>-->
                            <th>Ngày đặt</th>
                            <th>Tổng tiền</th>
                            <th>Tình trạng</th>
                            <th>Chi tiết đơn</th>
                            <th>Phương thức</th>
                            <th>Chức năng</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    ';
                while($row=mysqli_fetch_array($result))
                {
                    $id_HD=$row['id_HD'];
                    $id_KH=$row['id_KH'];
                    //$id_NV_banHang=$row['id_NV_banHang'];
                    $ngayDat=$row['ngayDat'];
                    $tinhTrang=$row['tinhTrang'];
                    $tongTien=$row['tongTien'];
                    $thanhToan=$row['thanhToan'];
                    
                    echo '<tr>
                        <td>'.$id_HD.'</td>
                        <td>'.$id_KH.'</td>
                        
                        <td>'.$ngayDat.'</td>
                        <td>'.number_format($tongTien,0,',','.').' vnđ</td>
                        <td><span class="badge bg-secondary" style="color:white; font-size:14px" >'.$tinhTrang.'</span></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="id_HD" id="id_HD" value="'.$id_HD.'">
                                <a href="xemChiTiet_HD.php?id_HD='.$id_HD.'" class="btn btn-warning btn-sm">
                                    <span class="text">Chi tiết</span>
                                </a>
                            </form>
                        </td>
                        <td>'.$thanhToan.'</td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="id_dxn" id="id_dxn" value="'.$id_HD.'">
                                <input type="submit" name="nut_cbh" value="Chuẩn bị hàng" class="btn btn-success btn-sm">
                                        
                            </form>
                        </td>
                    </tr>';
                }
                echo '</tbody>
                </table>';
            }
            else
            {
                echo '<h3 align="center">Không có đơn hàng nào </h3>';
            }
        }

        // Hàm lấy hóa đơn chuẩn bị hàng
        public function getHD_cbh($sql)
        {
            $link=$this->connect();
            $result=mysqli_query($link,$sql);
            if(mysqli_num_rows($result)>0)
            {
                echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã hóa đơn</th>
                            <th>Mã khách hàng</th>
                            <!--<th>Mã Nhân viên</th>-->
                            <th>Ngày đặt</th>
                            <th>Tổng tiền</th>
                            <th>Tình trạng</th>
                            <th>Chi tiết đơn</th>
                            <th>Phương thức</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Mã hóa đơn</th>
                            <th>Mã khách hàng</th>
                            <!--<th>Mã Nhân viên</th>-->
                            <th>Ngày đặt</th>
                            <th>Tổng tiền</th>
                            <th>Tình trạng</th>
                            <th>Chi tiết đơn</th>
                            <th>Phương thức</th>
                            <th>Chức năng</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    ';
                while($row=mysqli_fetch_array($result))
                {
                    $id_HD=$row['id_HD'];
                    $id_KH=$row['id_KH'];

                    $ngayDat=$row['ngayDat'];
                    $tinhTrang=$row['tinhTrang'];
                    $tongTien=$row['tongTien'];
                    $thanhToan=$row['thanhToan'];
                    
                    echo '<tr>
                        <td>'.$id_HD.'</td>
                        <td>'.$id_KH.'</td>
                        
                        <td>'.$ngayDat.'</td>
                        <td>'.number_format($tongTien,0,',','.').' vnđ</td>
                        <td><span class="badge bg-secondary" style="color:white; font-size:14px" >'.$tinhTrang.'</span></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="id_xoa" id="id_xoa" value="'.$id_HD.'">
                                <a href="xemChiTiet_HD.php?id_HD='.$id_HD.'" class="btn btn-warning btn-sm">
                                    <span class="text">Chi tiết</span>
                                </a>
                            </form>
                        </td>
                        <td>'.$thanhToan.'</td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="id_cbh" id="id_cbh" value="'.$id_HD.'">
                                <input type="submit" name="nut_dpgh" value="Chuyển giao hàng" class="btn btn-success btn-sm">
                                        
                            </form>
                        </td>
                    </tr>';
                }
                echo '</tbody>
                </table>';
            }
            else
            {
                echo '<h3 align="center">Không có đơn hàng nào </h3>';
            }
        }

        // Hàm lấy shipper
        public function getNV($sql)
        {
            $link = $this->connect();
            $result = mysqli_query($link, $sql);
            
            $output = '<select name="id_nv_giaoHang" class="form-select form-select-sm" aria-label=".form-select-sm">';
            $output .= '<option value="0" selected>Chọn shipper</option>';
            
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    $id_NV = $row['id_NV'];
                    $tenNV = $row['tenNV'];
                    
                    $output .= '<option value="'.$id_NV.'">'.$tenNV.'</option>';
                }
            } else {
                $output .= '<option disabled>Không có shipper nào</option>';
            }
            
            $output .= '</select>';
            
            return $output;
        }

        // Hàm xử lý giao hàng
        public function getHD_cgh($sql)
        {
            $link=$this->connect();
            $result=mysqli_query($link,$sql);
            if(mysqli_num_rows($result)>0)
            {
                echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã hóa đơn</th>
                            <th>Mã khách hàng</th>
                            <!--<th>Mã Nhân viên</th>-->
                            <th>Ngày đặt</th>
                            <th>Tổng tiền</th>
                            <th>Tình trạng</th>
                            <th>Chi tiết đơn</th>
                            <th>Chọn shipper</th>
                            <th>Phương thức</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Mã hóa đơn</th>
                            <th>Mã khách hàng</th>
                            <!--<th>Mã Nhân viên</th>-->
                            <th>Ngày đặt</th>
                            <th>Tổng tiền</th>
                            <th>Tình trạng</th>
                            <th>Chi tiết đơn</th>
                            <th>Chọn shipper</th>
                            <th>Phương thức</th>
                            <th>Chức năng</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    ';
                while($row=mysqli_fetch_array($result))
                {
                    $id_HD=$row['id_HD'];
                    $id_KH=$row['id_KH'];

                    $ngayDat=$row['ngayDat'];
                    $tinhTrang=$row['tinhTrang'];
                    $tongTien=$row['tongTien'];
                    $thanhToan=$row['thanhToan'];
                    
                    echo '<tr>
                        <td>'.$id_HD.'</td>
                        <td>'.$id_KH.'</td>
                        
                        <td>'.$ngayDat.'</td>
                        <td>'.number_format($tongTien,0,',','.').' vnđ</td>
                        <td><span class="badge bg-secondary" style="color:white; font-size:14px" >'.$tinhTrang.'</span></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="id_xoa" id="id_xoa" value="'.$id_HD.'">
                                <a href="xemChiTiet_HD.php?id_HD='.$id_HD.'" class="btn btn-warning btn-sm">
                                    <span class="text">Chi tiết</span>
                                </a>
                            </form>
                        </td>
                        <form method="post">
                            <td>
                                '.$this->getNV("select * from nhanvien where id_quyen=3").'
                            </td>
                            <td>'.$thanhToan.'</td>
                            <td>
                                <input type="hidden" name="id_gh" id="id_gh" value="'.$id_HD.'">
                                <input type="submit" name="nut_gh" value="Giao hàng" class="btn btn-success btn-sm">
                            </td>
                        </form>
                    </tr>';
                }
                echo '</tbody>
                </table>';
            }
            else
            {
                echo '<h3 align="center">Không có đơn hàng nào </h3>';
            }
        }

        // Hàm lấy hóa đơn đang giao
        public function getHD_dgh($sql)
        {
            $link=$this->connect();
            $result=mysqli_query($link,$sql);
            if(mysqli_num_rows($result)>0)
            {
                echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã hóa đơn</th>
                            <th>Mã khách hàng</th>
                            <th>Mã Nhân viên giao hàng</th>
                            <th>Ngày đặt</th>
                            <th>Tổng tiền</th>
                            <th>Tình trạng</th>
                            <th>Chi tiết đơn</th>
                            <th>Phương thức</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Mã hóa đơn</th>
                            <th>Mã khách hàng</th>
                            <th>Mã Nhân viên giao hàng</th>
                            <th>Ngày đặt</th>
                            <th>Tổng tiền</th>
                            <th>Tình trạng</th>
                            <th>Chi tiết đơn</th>
                            <th>Phương thức</th>
                            <th>Chức năng</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    ';
                while($row=mysqli_fetch_array($result))
                {
                    $id_HD=$row['id_HD'];
                    $id_KH=$row['id_KH'];
                    $id_NV_giaoHang=$row['id_NV_giaoHang'];
                    $ngayDat=$row['ngayDat'];
                    $tinhTrang=$row['tinhTrang'];
                    $tongTien=$row['tongTien'];
                    $thanhToan=$row['thanhToan'];
                    
                    echo '<tr>
                        <td>'.$id_HD.'</td>
                        <td>'.$id_KH.'</td>
                        <td>'.$id_NV_giaoHang.'</td>
                        <td>'.$ngayDat.'</td>
                        <td>'.number_format($tongTien,0,',','.').' vnđ</td>
                        <td><span class="badge bg-secondary" style="color:white; font-size:14px" >'.$tinhTrang.'</span></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="id_xoa" id="id_xoa" value="'.$id_HD.'">
                                <a href="xemChiTiet_HD.php?id_HD='.$id_HD.'" class="btn btn-warning btn-sm">
                                    <span class="text">Chi tiết</span>
                                </a>
                            </form>
                        </td>
                        <td>'.$thanhToan.'</td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="id_dgh" id="id_dgh" value="'.$id_HD.'">
                                <input type="submit" name="nut_hoanthanh" value="Xong" class="btn btn-success btn-sm">
                                        
                            </form>
                        </td>
                    </tr>';
                }
                echo '</tbody>
                </table>';
            }
            else
            {
                echo '<h3 align="center">Không có đơn hàng nào </h3>';
            }
        }

        // Hàm lấy hóa đơn hủy
        public function getHD_huy($sql)
        {
            $link=$this->connect();
            $result=mysqli_query($link,$sql);
            if(mysqli_num_rows($result)>0)
            {
                echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã hóa đơn</th>
                            <th>Mã khách hàng</th>
                            <th>Mã Nhân viên</th>
                            <th>Ngày đặt</th>
                            <th>Tổng tiền</th>
                            <th>Tình trạng</th>
                            <th>Chi tiết đơn</th>
                            <th>Phương thức</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Mã hóa đơn</th>
                            <th>Mã khách hàng</th>
                            <th>Mã Nhân viên</th>
                            <th>Ngày đặt</th>
                            <th>Tổng tiền</th>
                            <th>Tình trạng</th>
                            <th>Chi tiết đơn</th>
                            <th>Phương thức</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    ';
                while($row=mysqli_fetch_array($result))
                {
                    $id_HD=$row['id_HD'];
                    $id_KH=$row['id_KH'];
                    $id_NV_banHang=$row['id_NV_banHang'];
                    $ngayDat=$row['ngayDat'];
                    $tinhTrang=$row['tinhTrang'];
                    $tongTien=$row['tongTien'];
                    $thanhToan=$row['thanhToan'];
                    
                    echo '<tr>
                        <td>'.$id_HD.'</td>
                        <td>'.$id_KH.'</td>
                        <td>'.$id_NV_banHang.'</td>
                        <td>'.$ngayDat.'</td>
                        <td>'.number_format($tongTien,0,',','.').' vnđ</td>
                        <td><span class="badge bg-secondary" style="color:white; font-size:14px" >'.$tinhTrang.'</span></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="id_xoa" id="id_xoa" value="'.$id_HD.'">
                                <a href="xemChiTiet_HD.php?id_HD='.$id_HD.'" class="btn btn-warning btn-sm">
                                    <span class="text">Chi tiết</span>
                                </a>
                            </form>
                        </td>
                        <td>'.$thanhToan.'</td>
                    </tr>';
                }
                echo '</tbody>
                </table>';
            }
            else
            {
                echo '<h3 align="center">Không có đơn hàng nào </h3>';
            }
        }

        // Hàm lấy hóa đơn hoàn thành
        public function getHD_ht($sql)
        {
            $link=$this->connect();
            $result=mysqli_query($link,$sql);
            if(mysqli_num_rows($result)>0)
            {
                echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã hóa đơn</th>
                            <th>Mã khách hàng</th>
                            <th>Mã Nhân viên</th>
                            <th>Ngày đặt</th>
                            <th>Ngày giao</th>
                            <th>Tổng tiền</th>
                            
                            <th>Phương thức</th>
                            <th>Chi tiết đơn</th>
                            <th>Tình trạng</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Mã hóa đơn</th>
                            <th>Mã khách hàng</th>
                            <th>Mã Nhân viên</th>
                            <th>Ngày đặt</th>
                            <th>Ngày giao</th>
                            <th>Tổng tiền</th>
                        
                            <th>Phương thức</th>
                            <th>Chi tiết đơn</th>
                            <th>Tình trạng</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    ';
                while($row=mysqli_fetch_array($result))
                {
                    $id_HD=$row['id_HD'];
                    $id_KH=$row['id_KH'];
                    $id_NV_banHang=$row['id_NV_banHang'];
                    $ngayDat=$row['ngayDat'];
                    $ngayGiao=$row['ngayGiao'];
                    $tinhTrang=$row['tinhTrang'];
                    $tongTien=$row['tongTien'];
                    $thanhToan=$row['thanhToan'];
                    
                    echo '<tr>
                        <td>'.$id_HD.'</td>
                        <td>'.$id_KH.'</td>
                        <td>'.$id_NV_banHang.'</td>
                        <td>'.$ngayDat.'</td>
                        <td>'.$ngayGiao.'</td>
                        <td>'.number_format($tongTien,0,',','.').' vnđ</td>
                        
                        
                        <td>'.$thanhToan.'</td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="id_xoa" id="id_xoa" value="'.$id_HD.'">
                                <a href="xemChiTiet_HD.php?id_HD='.$id_HD.'" class="btn btn-warning btn-sm">
                                    <span class="text">Chi tiết</span>
                                </a>
                            </form>
                        </td>
                        <td><span class="badge bg-success" style="color:white; font-size:14px" >'.$tinhTrang.'</span></td>
                    </tr>';
                }
                echo '</tbody>
                </table>';
            }
            else
            {
                echo '<h3 align="center">Không có đơn hàng nào </h3>';
            }
        }

        // hàm lấy màu sản phẩm
        public function getThongSoSP($sql)
        {
            $link=$this->connect();
            $result=mysqli_query($link,$sql);
            if(mysqli_num_rows($result)>0)
            {
                $count=1;
                while($row=mysqli_fetch_array($result))
                {
                    $id_size=$row['id_size'];
                    $size=$row['size'];
                    
                    echo '<tr>
                        <td>'.$count.'</td>
                        <td>'.$size.'</td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="id_xoa" id="id_xoa" value="'.$id_size.'">
                                <a href="sua-SanPham-thongSo.php?idsua='.$id_size.'" class="btn btn-warning btn-sm">
                                    <span class="text">Sửa</span>
                                </a>
                                <input type="submit" name="nut_xoa" id="nut_xoa" class="btn btn-danger btn-sm" value="Xóa">

                            </form>
                        </td>
                    </tr>';
                    $count++;
                }
            }
            else
            {
                echo 'Không có thông số nào !';
            }
        }

        // hàm lấy dòng sản phẩm cho trang thêm sản phẩm
        public function getdongSP_add_SanPham($sql)
        {
            $link=$this->connect();
            $result=mysqli_query($link,$sql);
            if(mysqli_num_rows($result)>0)
            {
                while($row=mysqli_fetch_array($result))
                {
                    $id_dongSP=$row['id_dongSP'];
                    $tenDongSP=$row['tenDongSP'];
                    $id_ThuongHieu=$row['id_ThuongHieu'];
                    $tenThuongHieu=$row['tenThuongHieu'];
                    echo '<option value="'.$id_dongSP.'">'.$tenDongSP.' - '.$tenThuongHieu.'</option>';
                }
            }
            // else
            // {
            //     echo 'Không có thương hiệu nào';
            // }
        }

        // hàm lấy màu sản phẩm cho trang thêm sản phẩm
        public function getMau_add_SanPham($sql)
        {
            $link=$this->connect();
            $result=mysqli_query($link,$sql);
            if(mysqli_num_rows($result)>0)
            {
                while($row=mysqli_fetch_array($result))
                {
                    $maMau=$row['maMau'];
                    echo '<div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="checkmau" name="txtmausac[]" value="'.$maMau.'">
                            <label class="form-check-label" for="'.$maMau.'">'.$maMau.'</label>
                        </div>';
                }
            }
            // else
            // {
            //     echo 'Không có thương hiệu nào';
            // }
        }

        // hàm lấy thông số sản phẩm cho trang thêm sản phẩm
        public function getThongSo_add_SanPham($sql)
        {
            $link=$this->connect();
            $result=mysqli_query($link,$sql);
            if(mysqli_num_rows($result)>0)
            {
                while($row=mysqli_fetch_array($result))
                {
                    $size=$row['size'];
                    echo '<div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="checkthongso" name="txtthongso[]" value="'.$size.'">
                            <label class="form-check-label" for="'.$size.'">'.$size.'</label>
                        </div>';
                }
            }
            // else
            // {
            //     echo 'Không có thương hiệu nào';
            // }
        }

        // hàm lấy thương hiệu sản phẩm cho trang sửa sản phẩm
        public function getThuongHieu_Sua_dsp($sql,$id_sua)
        {
            $link=$this->connect();
            $result=mysqli_query($link,$sql);
            if(mysqli_num_rows($result)>0)
            {
                $count=1;
                while($row=mysqli_fetch_array($result))
                {
                    $id_ThuongHieu=$row['id_ThuongHieu'];
                    $tenThuongHieu=$row['tenThuongHieu'];
                    $moTa=$row['moTa'];
                    if($id_ThuongHieu==$id_sua){
                        echo '<option value="'.$id_ThuongHieu.'" selected>'.$tenThuongHieu.'</option>';
                    }
                    else
                    {
                        echo '<option value="'.$id_ThuongHieu.'">'.$tenThuongHieu.'</option>';
                    }
                    
                    
                    $count++;
                }
            }
            else
            {
                echo 'Không có thương hiệu nào';
            }
        }

        // hàm lấy dòng sản phẩm cho trang sửa sản phẩm
        public function getdongSP_sua_SanPham($sql,$id_sua)
        {
            $link=$this->connect();
            $result=mysqli_query($link,$sql);
            if(mysqli_num_rows($result)>0)
            {
                while($row=mysqli_fetch_array($result))
                {
                    $id_dongSP=$row['id_dongSP'];
                    $tenDongSP=$row['tenDongSP'];
                    $id_ThuongHieu=$row['id_ThuongHieu'];
                    $tenThuongHieu=$row['tenThuongHieu'];
                    if($id_dongSP==$id_sua)
                    {
                        echo '<option value="'.$id_dongSP.'" selected>'.$tenDongSP.' - '.$tenThuongHieu.'</option>';
                    }
                    else
                    {
                        echo '<option value="'.$id_dongSP.'">'.$tenDongSP.' - '.$tenThuongHieu.'</option>';
                    }
                    
                }
            }
            // else
            // {
            //     echo 'Không có thương hiệu nào';
            // }
        }

        // hàm lấy thông số sản phẩm cho trang sửa sản phẩm
        public function getThongSo_sua_SanPham($sql,$size_sua)
        {
            $link=$this->connect();
            $result=mysqli_query($link,$sql);
            if(mysqli_num_rows($result)>0)
            {
                while($row=mysqli_fetch_array($result))
                {
                    $size=$row['size'];
                    // Kiểm tra xem $size có tồn tại trong mảng $size_sua không
                    $checked = in_array($size, $size_sua) ? 'checked' : '';

                    echo '<div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="checkthongso" name="txtthongso[]" value="'.$size.'" '.$checked.'>
                            <label class="form-check-label" for="'.$size.'">'.$size.'</label>
                        </div>';
                }
            }
            // else
            // {
            //     echo 'Không có thương hiệu nào';
            // }
        }

        // hàm lấy tài khoản nhân viên
        public function getTaiKhoan_NV($sql)
        {
            $link=$this->connect();
            $result=mysqli_query($link,$sql);
            if(mysqli_num_rows($result)>0)
            {
                $count=1;
                echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Họ</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Quyền</th>
                            <th>Tình trạng</th>
                            <th>Chứ năng</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>Họ</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Quyền</th>
                            <th>Tình trạng</th>
                            <th>Chứ năng</th>
                        </tr>
                    </tfoot>
                    <tbody>';
                while($row=mysqli_fetch_array($result))
                {
                    $id_NV=$row['id_NV'];
                    $hoNV=$row['hoNV'];
                    $tenNV=$row['tenNV'];
                    $emailNV=$row['emailNV'];
                    $sdtNV=$row['sdtNV'];
                    $diaChiNV=$row['diaChiNV'];
                    $matKhauNV=$row['matKhauNV'];
                    $id_quyen=$row['id_quyen'];
                    $tinhTrang=$row['tinhTrang'];
                    $ten=$row['ten'];

                    // xử lý nút và class
                    $btn_class= ($tinhTrang == 'Active') ? 'btn-success' : 'btn-danger';
                    $value=($tinhTrang == 'Active') ? 'Khóa' : 'Mở khóa';
                    $txt_class=($value == 'Khóa')? 'btn-danger' : 'btn-success';
                    echo '<tr>
                        <td>'.$count.'</td>
                        <td>'.$hoNV.'</td>
                        <td>'.$tenNV.'</td>
                        <td>'.$emailNV.'</td>
                        <td>'.$sdtNV.'</td>
                        <td>'.$ten.'</td>
                        <td><button type="button" class="btn '.$btn_class.' btn-sm">'.$tinhTrang.'</button></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="id_xoa" id="id_xoa" value="'.$id_NV.'">
                                <a href="xemChiTiet-tk.php?id_nv='.$id_NV.'" class="btn btn-warning btn-sm">
                                    <span class="text">Xem chi tiết</span>
                                </a>      
                                <input type="submit" name="nut_khoa" id="nut_khoa" class="btn '.$txt_class.' btn-sm" value="'.$value.'" onclick="return confirm(\'Bạn có chắc chắn muốn '.$value.' tài khoản này không ?\')">
                            </form>
                        </td>
                    </tr>';
                    $count++;
                }
                echo '</tbody>
                </table>';
            }
            else
            {
                echo '<h3 align="center">Không có tài khoản nhân viên nào !</h3>';
            }
        }

        // hàm lấy tài khoản khách hàng
        public function getTaiKhoan_KH($sql)
        {
            $link=$this->connect();
            $result=mysqli_query($link,$sql);
            if(mysqli_num_rows($result)>0)
            {
                $count=1;
                echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Họ</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Tình trạng</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>Họ</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Tình trạng</th>
                            <th>Chức năng</th>
                        </tr>
                    </tfoot>
                    <tbody>';
                while($row=mysqli_fetch_array($result))
                {
                    $id_KH=$row['id_KH'];
                    $ho=$row['ho'];
                    $ten=$row['ten'];
                    $email=$row['email'];
                    $sdt=$row['sdt'];
                    $diaChi=$row['diaChi'];
                    $tinhTrang=$row['tinhTrang'];
                    $matKhau=$row['matKhau'];

                    // xử lý nút và class
                    $btn_class= ($tinhTrang == 'Active') ? 'btn-success' : 'btn-danger';
                    $value=($tinhTrang == 'Active') ? 'Khóa' : 'Mở khóa';
                    $txt_class=($value == 'Khóa')? 'btn-danger' : 'btn-success';
                    echo '<tr>
                        <td>'.$count.'</td>
                        <td>'.$ho.'</td>
                        <td>'.$ten.'</td>
                        <td>'.$email.'</td>
                        <td>'.$sdt.'</td>
                        <td><button type="button" class="btn '.$btn_class.' btn-sm">'.$tinhTrang.'</button></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="id_xemchitiet" id="id_xemchitiet" value="'.$id_KH.'">
                                <a href="xemChiTiet-tk.php?id_kh='.$id_KH.'" class="btn btn-warning btn-sm">
                                    <span class="text">Xem chi tiết</span>
                                </a>
  
                                <input type="submit" name="nut_khoa" id="nut_khoa" class="btn '.$txt_class.' btn-sm" value="'.$value.'" onclick="return confirm(\'Bạn có chắc chắn muốn '.$value.' tài khoản này không ?\')">
                            </form>
                        </td>
                    </tr>';
                    $count++;
                }
                echo '</tbody>
                </table>';
            }
            else
            {
                echo '<h3 align="center">Không có tài khoản khách hàng nào !</h3>';
            }
        }

        // hàm lấy quyền nhân viên
        public function getQuyen_NV($sql)
        {
            $link=$this->connect();
            $result=mysqli_query($link,$sql);
            if(mysqli_num_rows($result)>0)
            {
                while($row=mysqli_fetch_array($result))
                {
                    $id_quyen=$row['id_quyen'];
                    $ten=$row['ten'];
                    echo '<option value="'.$id_quyen.'">'.$id_quyen.' - '.$ten.'</option>';
                }
            }
            else
            {
                echo 'Không có quyền nào !';
            }
        }
    }

?>