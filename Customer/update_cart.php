<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $product_id = $_POST['product_id'];

    if ($_POST['action'] == 'update') {
        if ($_POST['change'] == 'increase') {
            $_SESSION['cart'][$product_id]['quantity']++;
        } else if ($_POST['change'] == 'decrease' && $_SESSION['cart'][$product_id]['quantity'] > 1) {
            $_SESSION['cart'][$product_id]['quantity']--;
        }
    } else if ($_POST['action'] == 'delete') {
        array_splice($_SESSION['cart'], $product_id, 1);
    }

    // Cập nhật lại số lượng sản phẩm trong giỏ hàng
    $_SESSION['cart_count'] = array_sum(array_column($_SESSION['cart'], 'quantity'));
}
exit();
?>
