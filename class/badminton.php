<?php
class badminton
{
    public function connect()
    {
        $con = mysqli_connect("localhost", "root", "", "badminton_db");
        if (!$con) {
            echo 'Không thể kết nối';
            exit();
        } else {
            mysqli_set_charset($con, 'utf8');
            return $con;
        }
    }

    // public function laycot($sql)
    // {
    //     $link = $this->connect();
    //     $result = mysqli_query($link, $sql);
    //     if (mysqli_num_rows($result) > 0) {
    //         $row = mysqli_fetch_array($result);
    //         return htmlspecialchars($row[0], ENT_QUOTES, 'UTF-8');  // Bảo vệ khỏi XSS khi hiển thị
    //     }
    //     return '';  // Trả về chuỗi rỗng nếu không có kết quả
    // }

    public function laycot($sql, $params = [])
    {
        $link = $this->connect();

        // Chuẩn bị câu lệnh SQL
        $stmt = mysqli_prepare($link, $sql);

        if ($stmt === false) {
            echo "Lỗi chuẩn bị câu lệnh SQL: " . mysqli_error($link);
            return false;
        }

        // Nếu có tham số, liên kết tham số vào câu lệnh
        if (!empty($params)) {
            // Xác định kiểu dữ liệu của các tham số (ví dụ, 'i' cho integer, 's' cho string)
            $types = str_repeat('s', count($params));  // 's' cho chuỗi (string)

            // Liên kết các tham số vào câu lệnh chuẩn bị bằng cách truyền tham chiếu
            $params_ref = array_merge([$stmt, $types], $params);

            // Truyền tham chiếu cho từng tham số trong mảng params
            foreach ($params_ref as $key => &$value) {
                // Dùng dấu `&` để truyền tham chiếu
                //$params_ref[$key] = &$value;
            }

            // Sử dụng call_user_func_array để gọi mysqli_stmt_bind_param với tham chiếu
            call_user_func_array('mysqli_stmt_bind_param', $params_ref);
        }

        // Thực thi câu lệnh SQL
        $executeResult = mysqli_stmt_execute($stmt);
        if ($executeResult === false) {
            echo "Lỗi thực thi câu lệnh SQL: " . mysqli_stmt_error($stmt);
            return false;
        }

        // Lấy kết quả
        $result = mysqli_stmt_get_result($stmt);
        if ($result === false) {
            echo "Lỗi lấy kết quả: " . mysqli_error($link);
            return false;
        }

        // Trả về giá trị cột đầu tiên nếu có kết quả
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            return htmlspecialchars($row[0], ENT_QUOTES, 'UTF-8');  // Bảo vệ khỏi XSS khi hiển thị
        }

        return '';  // Trả về chuỗi rỗng nếu không có kết quả
    }



    public function laycot_lap($sql)
    {
        $link = $this->connect();
        $result = mysqli_query($link, $sql);
        $giatri = array(); // Khởi tạo mảng rỗng để lưu kết quả

        // Kiểm tra nếu có dữ liệu trả về
        if (mysqli_num_rows($result) > 0) {
            // Duyệt qua các dòng dữ liệu trả về
            while ($row = mysqli_fetch_array($result)) {
                $gt = $row[0]; // Lấy giá trị cột đầu tiên từ mỗi dòng dữ liệu
                $giatri[] = $gt; // Thêm giá trị vào mảng
            }
        }

        return $giatri; // Trả về mảng chứa các giá trị
    }

    // public function themxoasua($sql)
    // {
    //     $link = $this->connect();
    //     if (mysqli_query($link, $sql) > 0) {
    //         return 1;
    //     } else {
    //         return 0;
    //     }
    // }
    public function themxoasua($sql, $params = [])
    {
        $link = $this->connect();

        // Chuẩn bị câu lệnh SQL để tránh SQL injection
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Ràng buộc các tham số nếu có
            if (!empty($params)) {
                // Xác định kiểu dữ liệu của các tham số (ví dụ, 'i' cho integer, 's' cho string)
                $types = str_repeat('s', count($params));  // 's' cho chuỗi (string)

                // Đảm bảo tham số là tham chiếu
                $params_refs = [];
                foreach ($params as $key => $value) {
                    $params_refs[$key] = &$params[$key];
                }

                // Liên kết các tham số vào câu lệnh chuẩn bị
                array_unshift($params_refs, $types); // Thêm kiểu dữ liệu vào đầu mảng
                call_user_func_array([$stmt, 'bind_param'], $params_refs);
            }

            // Thực thi câu lệnh
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_close($stmt);
                return 1; // Thành công
            } else {
                // Trả về thông báo lỗi nếu câu lệnh không thực thi thành công
                $error = mysqli_stmt_error($stmt);
                mysqli_stmt_close($stmt);
                return "Lỗi SQL: " . $error;
            }
        } else {
            // Trường hợp không thể chuẩn bị câu lệnh SQL
            return "Lỗi chuẩn bị câu lệnh: " . mysqli_error($link);
        }
    }

    public function uploadfile($name, $tmp_name, $folder)
    {
        if ($name != '') {
            $des = $folder . '/' . $name;
            if (move_uploaded_file($tmp_name, $des)) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return -1;
        }
    }

    public function checkTrung($sql)
    {
        $link = $this->connect();
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) > 0) {
            return 1;
        } else {
            return 0;
        }
    }
}
