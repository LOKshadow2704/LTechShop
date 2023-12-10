<?php
// session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Xử lý cập nhật số lượng
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $new_quantity = $_POST['new_quantity'];
    $price = $_POST['price'];
    include_once(dirname(__FILE__)."\m_cart.php");
    $cart = new modelCart();
    $update = $cart->updateCart($new_quantity,$product_id);
    
    // Cập nhật số lượng trong $_SESSION['cart']
    // ... (Thực hiện logic cập nhật số lượng trong giỏ hàng)

    // Tính toán tổng tiền mới
    $new_total = calculateNewTotal($new_quantity,$price); // Thay vào hàm tính tổng tiền của bạn
    // Trả về kết quả cho Ajax
    echo json_encode(array('new_total' => $new_total));
    
    exit();
}

function calculateNewTotal($new_quantity,$price) {
    $new_total = $new_quantity*$price;
    $new_total=number_format($new_total,0 , ",",".");
    return $new_total;
}
?>