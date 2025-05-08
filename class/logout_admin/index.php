<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng xuất</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <?php
        session_start();
        if(isset($_SESSION['id_NV']))
        {
            unset($_SESSION['id_NV']);
            unset($_SESSION['hoNV']);
            unset($_SESSION['tenNV']);
            unset($_SESSION['emailNV']);
            unset($_SESSION['sdtNV']);
            unset($_SESSION['diaChiNV']);
            unset($_SESSION['passNV']);
            unset($_SESSION['id_quyen']);
        }
        echo '<script>
                swal("Thành công","Đăng xuất thành công","success").then(function(){
                                window.location="../../Admin/signin.php";
                });
                setTimeOut(function(){
                    window.location="../../Admin/signin.php";
                }, 2000);
        </script>';
    ?>

</body>
</html>