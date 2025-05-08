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
    if (isset($_SESSION['id_KH'])) {
        unset($_SESSION['id_KH']);
        unset($_SESSION['ho']);
        unset($_SESSION['ten']);
        unset($_SESSION['email']);
        unset($_SESSION['sdt']);
        unset($_SESSION['diaChi']);
        unset($_SESSION['pass']);
        unset($_SESSION['cart']);
        unset($_SESSION['cart_count']);
    }
    echo '<script>
                swal("Thành công","Đăng xuất thành công","success").then(function(){
                                window.location="../../Customer/";
                });
                setTimeOut(function(){
                    window.location="../../Customer/";
                }, 2000);
            </script>'
    ?>

</body>

</html>