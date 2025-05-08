<?php
    class badminton
    {
        public function connect()
        {
            $con=mysqli_connect("localhost","root","","badminton_db");
            if(!$con)
            {
                echo 'Không thể kết nối';
                exit();
            }
            else
            {
                mysqli_set_charset( $con, 'utf8');
                return $con;
            } 
        }

        public function laycot($sql)
        {
            $link=$this->connect();
            $result=mysqli_query($link,$sql);
            $giatri='';
            if(mysqli_num_rows($result)>0)
            {
                while($row=mysqli_fetch_array($result))
                {
                    $gt=$row[0];
                    $giatri=$gt;
                }
                return $giatri;
            }
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

        public function themxoasua($sql)
        {
            $link=$this->connect();
            if(mysqli_query($link,$sql)>0)
            {
                return 1;
            }
            else
            {
                return 0;
            }
        }
        public function uploadfile($name,$tmp_name,$folder)
		{	
			if($name!='') 
			{
				$des=$folder.'/'.$name;
				if(move_uploaded_file($tmp_name,$des))	
				{
					return 1;
				}
				else
				{
					return 0;	
				}	
			}
			else
			{
				return -1;	
			}	
		}
        
        public function checkTrung($sql)
        {
            $link=$this->connect();
            $result=mysqli_query($link,$sql);
            if(mysqli_num_rows($result)>0)
            {
                return 1;
            }
            else
            {
                return 0;
            }
        }
    }
    
?>