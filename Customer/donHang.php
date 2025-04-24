<?php include_once 'component/header.php' ?>

    <div class="container">
        <h2 class="text-center mt-5 mb-5" >Đơn hàng</h2>
        <div class="mb-3 text-center">
            <a href="donHang.php?loc=tc" class="btn btn-outline-secondary">Tất cả</a>
            <a href="donHang.php?loc=cxl" class="btn btn-outline-secondary">Chờ xử lý</a>
            <a href="donHang.php?loc=dxn" class="btn btn-outline-secondary">Đã xác nhận</a>
            <a href="donHang.php?loc=dgh" class="btn btn-outline-secondary">Đang giao hàng</a>
            <a href="donHang.php?loc=huy" class="btn btn-outline-secondary">Đã hủy</a>
            <a href="donHang.php?loc=tc" class="btn btn-outline-secondary">Thành công</a>
        </div>
        <!-- Danh sách đơn hàng -->
        <div class="table-responsive">
            <table id="example" class="table table-striped" style="width:90%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Age</th>
                        <th>Start date</th>
                        <th>Salary</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Tiger Nixon</td>
                        <td>System Architect</td>
                        <td>Edinburgh</td>
                        <td>61</td>
                        <td>2011-04-25</td>
                        <td>$320,800</td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
    </div>
<?php include_once 'component/footer.php' ?>