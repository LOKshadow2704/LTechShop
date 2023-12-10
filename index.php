<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/index.css">
    <link rel="stylesheet" href="./assets/css/suggestShop.css">
    <link rel="stylesheet" href="./assets/css/footer.css">
    <link rel="stylesheet" href="./assets/css/header.css">
    <link rel="stylesheet" href="./assets/css/table_PM.css">
    <link rel="stylesheet" href="./assets/css/button.css">
    <link rel="stylesheet" href="./assets/css/seller.css">
    <link rel="stylesheet" href="./assets/css/form.css">
    <link rel="stylesheet" href="./assets/css/product_info.css">
    <link rel="stylesheet" href="./assets/css/suggestProduct.css">
    <link rel="stylesheet" href="./assets/css/login.css">
    <link rel="stylesheet" href="./assets/css/Order.css">
    <link rel="stylesheet" href="./assets/css/shop.css">
    <link rel="stylesheet" href="./assets/css/cart.css">
    <link rel="stylesheet" href="./assets/css/Payment.css">
    <link rel="stylesheet" href="./assets/css/pro_search.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/0bd872d3c5.js" crossorigin="anonymous"></script>

    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>LTechShop</title>
</head>
<body>
<script type='text/javascript'>
                            function update_quantity(new_quantity,product_id,price){
                                $.ajax({
                                    type: "POST",
                                    url: "./Model/update_cart.php",
                                    dataType: 'json',
                                    data: {
                                        product_id: product_id,
                                        new_quantity: new_quantity,
                                        price: price

                                    },
                                    success: function(response) {
                                        // Cập nhật tổng tiền trên giao diện
                                        $('.total_amount.'+product_id).text(response.new_total);
                                    },
                                    error: function (error) {console.error('Error:', error)},
                                })
                            }
                    </script>
    <div id="root">
        <?php
session_start();
include_once './View/v_Header.php';
$viewHeader = new viewHeader();
$viewHeader->showHeader();
?>
        <div class="container">
            <?php
if (isset($_REQUEST['MP'])) {
    //Trang quản lý sản phẩm
    echo "<div class='wrap_seller'>";
    include_once './View/v_seller.php';
    $cart = new viewSeller();
    $table = $cart->leftMenu();
    include_once "./View/v_Product.php";
    $product = new viewProduct();
    echo "<div class='rightMenu'>";
    $table = $product->getProductbyManager();
    echo "</div>";
    echo "</div>";
} elseif (isset($_REQUEST['MPO'])) {
    //Trang đơn bán
    echo "<div class='wrap_seller'>";
    include_once './View/v_seller.php';
    $cart = new viewSeller();
    $table = $cart->leftMenu();
    include_once "./View/v_Order.php";
    $product = new viewOrder();
    echo "<div class='rightMenu'>";
    $table = $product->viewManagermentSalesOrder();
    echo "</div>";
    echo "</div>";
} elseif (isset($_REQUEST['DO'])) {
    //Trang chi tiết đơn bán
    include_once "./View/v_Order.php";
    $product = new viewOrder();
    $table = $product->viewSalesOrder($_REQUEST["DO"]);
} elseif (isset($_REQUEST['PP'])) {
    //Trang đơn mua
    $userid = 2;
    include_once "./View/v_Order.php";
    $product = new viewOrder();
    $table = $product->viewPuchaseOrder();
} elseif (isset($_REQUEST['pi'])) {
    //Xem chi tiết sản phẩm
    include "./View/Product_info.php";
    include "./View/v_Product.php";
    $Product = new viewProductinfo();
    $Product->viewOneProduct($_REQUEST["pi"]);
    $suggestProduct = new ViewProduct();
    $product = $suggestProduct->viewSuggestProduct();
} elseif (isset($_REQUEST["login"])) {
    //Đăng nhập
    include_once "./View/v_Login.php";
    $page = new viewLogin();
    $page->showLoginPage();
} elseif (isset($_REQUEST["signup"])) {
    //Đăng ký
    include_once "./View/v_register.php";
    $page = new viewRegister();
    $page->showRegisterPage();
} elseif (isset($_REQUEST["addPr"])) {
    //Thêm sản phẩm
    include_once './View/v_add_product.php';
} elseif (isset($_REQUEST["update"])) {
    //Cập nhật sản phẩm
    include_once './View/v_update_product.php';
} elseif (isset($_REQUEST["delete"])) {
    //Xóa sản phẩm
    include_once './Controller/c_Product.php';
    $product = new controllProduct();
    $act = $product->deleteProduct();
    echo "<script>alert('Xóa thành công')</>";
    header("Refresh: 0; url = index.php?MP=1");
} elseif (isset($_REQUEST['idshop'])) {
    include "./View/v_Shop.php";
    $Product = new viewShop();
    $Product->viewoneShop($_REQUEST["idshop"]);
} elseif (isset($_REQUEST["cart"])) {
    //giỏ hàng
    include_once './View/v_cart.php';
    $cart = new viewCart();
    $table = $cart->Cart();
} elseif (isset($_REQUEST["seller"])) {
    if (isset($_SESSION['idLogin'])) {
        //Trang người bán
        echo "<div class='wrap_seller'>";
        include_once './View/v_seller.php';
        $cart = new viewSeller();
        $table = $cart->leftMenu();
        echo "<div class='rightMenu'>";
        echo "</div>";
        echo "</div>";
    } else {
        echo "<script>alert('Vui lòng đăng nhập')</script>";
        header("Refresh: 0; url = index.php");
    }

} elseif (isset($_REQUEST['quan_prod'])) {
    include "./View/v_buyProduct.php";
    $Product = new viewOderpage();
    $result = $Product->Buypage();
} elseif (isset($_REQUEST['show'])) {
    include_once "./View/v_Doanhthu.php";
    include_once "./View/v_SalesProduct.php";
    echo "<div class='wrap_seller'>";
    include_once './View/v_seller.php';
    $cart = new viewSeller();
    $table = $cart->leftMenu();
    include_once "./View/v_Product.php";
    $Product = new viewThongke();
    echo "<div class='rightMenu'>";
    $Product->showThongke();
    echo "</div>";
    echo "</div>";
} elseif (isset($_REQUEST['salesproduct'])) {
    include_once "./View/v_SalesProduct.php";
    echo "<div class='wrap_seller'>";
    include_once './View/v_seller.php';
    $cart = new viewSeller();
    $table = $cart->leftMenu();
    include_once "./View/v_Product.php";
    $Product = new viewSalesProduct();
    echo "<div class='rightMenu'>";
    $Product->showSalesProduct();
    echo "</div>";
    echo "</div>";
} elseif (isset($_REQUEST['txtsearch'])) {
    //tìm kiếm
    include "./View/v_Product.php";
    $Product = new viewProduct();
    $Product->viewAllSPbySearch($_REQUEST["txtsearch"]);
} elseif (isset($_REQUEST['delete_cartitem'])) {
    // Xóa sản phẩm giỏ hàng
    include "./Controller/c_cart.php";
    $cart = new controllerCart();
    $result = $cart->deleteCartItem();
    if ($result) {
        echo "<script>alert('Xóa thành công');  history.back();</script>";
    }
} elseif (isset($_REQUEST['addtocart'])) {
    // Thêm sản phẩm giỏ hàng
    include "./Controller/c_cart.php";
    $cart = new controllerCart();
    $result = $cart->addCartItem();
    if ($result) {
        // header("Location: index.php.php?pi=".$_REQUEST['addtocart']);
        echo "<script>alert('Đã thêm sản phẩm vào giỏ hàng');  history.back();</script>";
    }
} elseif (isset($_REQUEST['succes'])) {
    include "./Controller/c_Order.php";
    $cart = new controllOrder();
    $result = $cart->updateOrder();
    echo "<script>alert('Đặt hàng thành công'); window.location.replace('http://localhost:81/LTechShop/index.php');</script>";

} elseif (isset($_REQUEST['succes_cod'])) {
    echo "<script>alert('Đặt hàng thành công'); window.location.replace('http://localhost:81/LTechShop/index.php');</script>";
} elseif (isset($_REQUEST['buynow'])) {
    include "./Model/Buy_now.php";

} elseif (isset($_REQUEST["viewP"])) {
    include_once "./View/v_Product.php";
    $vProduct = new ViewProduct();
    $vProduct->viewAllProduct();
} elseif (isset($_REQUEST["forget-password"])) {
    include_once "./View/v_ForgetPassword.php";
    $page = new viewForgetPassword();
    $page->showForgetPassword();
} elseif (isset($_REQUEST["edit-profile"])) {
    include_once "./View/v_Profile.php";
    $page = new viewProfile();
    $page->showPage();
} else {
    //Trang chủ
    include_once "./View/slideshow.php";
    include_once "./View/v_Shop.php";
    include_once "./View/v_Product.php";
    $suggestShop = new viewShop();
    $shop = $suggestShop->viewSuggestShop();
    $suggestProduct = new ViewProduct();
    $product = $suggestProduct->viewSuggestProduct();
}
?>
        </div>
        <?php
include_once './View/v_footer.php';
?>
    </div>
</body>

</html>