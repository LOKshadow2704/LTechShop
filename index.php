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
    <link rel="stylesheet" href="./assets/css/product.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/0bd872d3c5.js" crossorigin="anonymous"></script>
    
    
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>LTechShop</title>
</head>
<body>
    <?php session_start(); ?>
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
                
    <!-- chuyển từ product_info sang đây -->
    <!-- js so sánh -->
            <script>
                            function delete_compare(id) {
                                if (localStorage.getItem('compare') != null) {
                                var data = JSON.parse(localStorage.getItem('compare'));
                                var index = data.findIndex(item => item.id === id);
                                data.splice(index, 1);
                                localStorage.setItem('compare', JSON.stringify(data)); 
                                document.getElementById("row_compare" + id).remove();
                            }
                        }
                        $(document).ready(function() {
                            viewed_compare();
                            function viewed_compare() {
                                if (localStorage.getItem('compare') != null) {
                                    var data = JSON.parse(localStorage.getItem('compare'));
                                    for (i = 0; i < data.length; i++) {
                                        var name = data[i].name;
                                        var price = data[i].price;
                                        var image = data[i].image;
                                        var content = data[i].content;
                                        var id = data[i].id;

                                        $('#row_compare').find('tbody').append(
                                            '<tr id="row_compare' + id + '">' +
                                            '<td><img width="200px" width="100%" src="' + image + '"></td>' +
                                            '<td>' + name + '</td>' +
                                            '<td>' + price + '</td>' +
                                            '<td>'+ content+'</td>' +
                                            '<td><a href="index.php?pi=' + id + '">Xem sản phẩm</a></td>' +
                                            '<td onclick="delete_compare(' + id + ')"><a style="cursor:pointer;">Xóa so sánh</a></td>' +
                                            '</tr>'
                                        );
                                    }
                                }
                            }

                        });
function add_compare($id) {
                            document.getElementById('title_compare').innerText = 'Chỉ cho phép so sánh tối đa 2 sản phẩm';  
                            var id =$id;
                            var image = document.querySelector('.product_left').src;
                            var name = document.querySelector('.product-title').innerText;
                            var price = document.querySelector('.product-price').innerText;
                            var content = document.querySelector('.product-description1').innerText;
                            
                            var newItem = {
                                'id': id,
                                'image': image,
                                'name': name,
                                'price': price,
                                'content': content
                            };
                            if (localStorage.getItem('compare') == null) {
                                localStorage.setItem('compare', '[]');
                            }
                            var old_data = JSON.parse(localStorage.getItem('compare'));
                            var matches = old_data.filter(obj => obj.id == id);

                            if (matches.length === 0 && old_data.length < 2) {
                                old_data.push(newItem);
                                $('#row_compare').find('tbody').append(
                                        '<tr id="row_compare' + id + '">' +
                                        '<td><img width="200px" width="100%" src="' + image + '"></td>' +
                                        '<td>' + newItem.name + '</td>' +
                                        '<td>' + newItem.price + '</td>' +
                                        '<td>'+ newItem.content +'</td>' +
                                        '<td><a href="index.php?pi=' + id + '"></a>Xem sản phẩm</td>' +
                                        '<td onclick="delete_compare(' + id + ')"><a style="cursor:pointer;">Xóa so sánh</a></td>' +
                                        '</tr>'
                                );
                                localStorage.setItem('compare', JSON.stringify(old_data));
                                $('#myModal').on('shown.bs.modal', function () {
                                    console.log('Modal shown');
                                });
                            }
                        }
            </script> 
    <div id="root" >
        <?php
            include_once('./View/v_Header.php');
            $viewHeader = new viewHeader();
            $viewHeader->showHeader();
        ?>
        <div class="container" >
            <?php

                if(isset($_REQUEST['MP'])){
                    //Trang quản lý sản phẩm
                    echo "<div class='wrap_seller'>";
                    include_once('./View/v_seller.php');
                    $cart = new viewSeller();
                    $table = $cart->leftMenu();
                    include_once("./View/v_Product.php");
                    $product = new viewProduct();
                    echo "<div class='rightMenu'>";
                    $table = $product ->getProductbyManager();
                    echo "</div>";
                    echo "</div>";
                }elseif(isset($_REQUEST['MPO'])){
                    //Trang đơn bán
                    echo "<div class='wrap_seller'>";
                    include_once('./View/v_seller.php');
                    $cart = new viewSeller();
                    $table = $cart->leftMenu();
                    include_once("./View/v_Order.php");
                    $product = new viewOrder();
                    echo "<div class='rightMenu'>";
                    $table = $product ->viewManagermentSalesOrder();
                    echo "</div>";
                    echo "</div>";
                }
                elseif(isset($_REQUEST['DO'])){
                    //Trang chi tiết đơn bán
                    include_once("./View/v_Order.php");
                    $product = new viewOrder();
                    $table = $product ->viewSalesOrder($_REQUEST["DO"]);
                }elseif(isset($_REQUEST['PP'])){
                    if(isset($_SESSION['idLogin'])){
                        include_once("./View/v_Order.php");
                        $product = new viewOrder();
                        $table = $product ->viewPuchaseOrder();
                    }else{
                        echo "<script>alert('Vui lòng đăng nhập'); history.back();</script>";
                    }
                }elseif(isset($_REQUEST['OrD'])){
                    //Trang chi tiết đơn hàng
                    include_once("./View/v_Order.php");
                    $product = new viewOrder();
                    $table = $product ->viewOrderDetail($_REQUEST["OrD"]);
                }elseif(isset($_REQUEST['pi'])){
                    //Xem chi tiết sản phẩm
                    include("./View/Product_info.php");
                    include("./View/v_Product.php");
                    $Product = new viewProductinfo();
                    $Product -> viewOneProduct($_REQUEST["pi"]);
                    $suggestProduct = new ViewProduct();
                    $product = $suggestProduct->viewSuggestProduct();
                }elseif (isset($_REQUEST["login"])) {
                    //Đăng nhập
                    include_once "./View/v_Login.php";
                    $page = new viewLogin();
                    $page->showLoginPage();
                } elseif (isset($_REQUEST["signup"])) {
                    //Đăng ký
                    include_once "./View/v_register.php"; 
                    $page = new viewRegister();
                    $page->showRegisterPage();
                }elseif(isset($_REQUEST["addPr"])){
                    //Thêm sản phẩm
                    include_once('./View/v_add_product.php');
                }elseif(isset($_REQUEST["update"])){
                    //Cập nhật sản phẩm
                    include_once('./View/v_update_product.php');
                }elseif(isset($_REQUEST["delete"])){
                    //Xóa sản phẩm
                    include_once('./Controller/c_Product.php');
                    $product = new controllProduct();
                    $act = $product->deleteProduct();
                    if($act){
                        echo "<script>alert('Xóa thành công'); window.location.replace('http://localhost:81/LTechShop/index.php?MP=1');</script>";
                    }

                }elseif(isset($_REQUEST['idshop'])){
                    include("./View/v_Shop.php");
                    $Product = new viewShop();
                    $Product -> viewoneShop($_REQUEST["idshop"]);
                }elseif(isset($_REQUEST["cart"])){
                    //giỏ hàng
                    include_once('./View/v_cart.php');
                    $cart = new viewCart();
                    $table = $cart->Cart();
                }elseif(isset($_REQUEST["seller"])){
                    if(isset($_SESSION['idLogin'])){
                        //Trang người bán
                        echo "<div class='wrap_seller'>";
                        include_once('./View/v_seller.php');
                        $cart = new viewSeller();
                        $table = $cart->leftMenu();
                        echo "<div class='rightMenu'>";
                        echo "</div>";
                        echo "</div>";
                    }else{
                        echo "<script>alert('Vui lòng đăng nhập'); history.back();</script>";
                    }
                    
                }elseif(isset($_REQUEST['quan_prod'])){
                    include("./View/v_buyProduct.php");
                    $Product = new viewOderpage();
                    $result =$Product -> Buypage();
                }elseif(isset($_REQUEST['show'])){
                    include_once("./View/v_Doanhthu.php");
                    include_once("./View/v_SalesProduct.php");
                    echo "<div class='wrap_seller'>";
                    include_once('./View/v_seller.php');
                    $cart = new viewSeller();
                    $table = $cart->leftMenu();
                    include_once("./View/v_Product.php");
                    $Product = new viewThongke();
                    echo "<div class='rightMenu'>";
                    $Product -> showThongke();
                    echo "</div>";
                    echo "</div>";
                }elseif(isset($_REQUEST['salesproduct'])){
                    include_once("./View/v_SalesProduct.php");
                    echo "<div class='wrap_seller'>";
                    include_once('./View/v_seller.php');
                    $cart = new viewSeller();
                    $table = $cart->leftMenu();
                    include_once("./View/v_Product.php");
                    $Product = new viewSalesProduct();
                    echo "<div class='rightMenu'>";
                    $Product -> showSalesProduct();
                    echo "</div>";
                    echo "</div>";
                }elseif(isset($_REQUEST['txtsearch'])){
                    //tìm kiếm
                    echo"<div class = 'widthSearch' style='width: 100% !important'>";
                    echo"<div class= row>";
                    echo "<div class= col-lg-2>";
                    include_once("./View/v_Comp.php");
                    $Company = new ViewCompany();
                    $table = $Company->viewAllCompany();
                    echo"</div>";
                    echo "<div class= col-lg-10>";
                    include_once("./View/v_Product.php");
                    $Product = new viewProduct();
                    $Product -> viewAllSPbySearch($_REQUEST["txtsearch"]);
                    echo"</div>";
                    echo"</div>";
                    echo"</div>";
                }elseif(isset($_REQUEST["Comp"])){
                    //Đã thêm lọc theo danh mục
                    //Lọc theo danh mục sản phẩm
                    echo"<div class = 'widthSearch' style='width: 100% !important'>";
                    echo"<div class= row>";
                    echo "<div class= col-lg-2>";
                    include_once("./View/v_Comp.php");
                    $Company = new ViewCompany();
                    $table = $Company->viewAllCompany();
                    echo"</div>";
                    echo "<div class= col-lg-10>";
                    include_once("./View/v_Comp.php");
                    $product = new ViewCompany();
                    $table = $product->viewAllProdByCompany($_REQUEST["Comp"]);
                    echo"</div>";
                    echo"</div>";
                    echo"</div>";
                }elseif(isset($_REQUEST['giamin']) && isset($_REQUEST['giamax'])){
                    // Đã thêm lọc theo giá
                    echo"<div class = 'widthSearch' style='width: 100% !important'>";
                    echo"<div class= row>";
                    echo "<div class= col-lg-2>";
                    include_once("./View/v_Comp.php");
                    $Company = new ViewCompany();
                    $table = $Company->viewAllCompany();
                    echo"</div>";
                    echo "<div class= col-lg-10>";
                    include("./View/v_Product.php");
                    $Product = new ViewProduct();
                    $result =$Product -> ViewSPByTimGia($_REQUEST['giamin'], $_REQUEST['giamax']);
                    echo"</div>";
                    echo"</div>";
                    echo"</div>";
                }elseif(isset($_REQUEST['delete_cartitem'])){
                    // Xóa sản phẩm giỏ hàng
                    include("./Controller/c_cart.php");
                    $cart = new controllerCart();
                    $result= $cart -> deleteCartItem();
                    if($result){
                        echo "<script>alert('Xóa thành công');  window.location.replace('http://localhost:81/LTechShop/index.php?cart');</script>";
                    }
                }elseif(isset($_REQUEST['addtocart'])){
                    // Thêm sản phẩm giỏ hàng
                    if(isset($_SESSION['idLogin'])){
                        include("./Controller/c_cart.php");
                        $cart = new controllerCart();
                        $result=$cart -> addCartItem();
                        if($result){
                            // header("Location: index.php.php?pi=".$_REQUEST['addtocart']);
                            echo "<script>alert('Đã thêm sản phẩm vào giỏ hàng');  history.back();</script>";
                        }
                    }else{
                        echo "<script>alert('Vui lòng đăng nhập'); history.back();</script>";
                    }
                }elseif($_GET['vnp_ResponseCode']=='00'){
                    //Thanh toán online thông báo
                    include("./Controller/c_Order.php");
                    $cart = new controllOrder();
                    $result=$cart -> updateOrder();
                    echo "<script>alert('Thanh toán thành công'); window.location.replace('http://localhost:81/LTechShop/index.php');</script>";
                    
                }elseif (isset($_REQUEST["forget-password"])) {
                    //Quên mật khẩu
                    include_once "./View/v_ForgetPassword.php";
                    $page = new viewForgetPassword();
                    $page->showForgetPassword();
                }elseif (isset($_REQUEST["edit-profile"])) {
                    //Chỉnh sửa profile
                    include_once "./View/v_Profile.php";
                    $page = new viewProfile();
                    $page->showPage();
                }elseif(isset($_GET['vnp_ResponseCode'])&&$_GET['vnp_ResponseCode']!='00'){
                    echo "<script>alert('Thanh toán không thành công'); window.location.replace('http://localhost:81/LTechShop/index.php');</script>";
                }elseif(isset($_REQUEST['succes_cod'])){
                    echo "<script>alert('Đặt hàng thành công'); window.location.replace('http://localhost:81/LTechShop/index.php');</script>";
                }elseif(isset($_REQUEST['faile_cod'])){
                    echo "<script>alert('Đặt hàng không thành công'); window.location.replace('http://localhost:81/LTechShop/index.php');</script>";
                }elseif(isset($_REQUEST['oder_prod'])){
                    include("./View/v_buyProduct.php");
                    $buy = new viewOderpage();
                    $buy->BuyNowpage();
                }else{
                    //Trang chủ
                    include_once("./View/slideshow.php");
                    include_once("./View/v_Shop.php");
                    include_once("./View/v_Product.php");
                    $suggestShop = new viewShop();
                    $shop = $suggestShop->viewSuggestShop();
                    $suggestProduct = new ViewProduct();
                    $product = $suggestProduct->viewSuggestProduct();
                }
            ?>
        </div>
        <?php
            include_once('./View/v_footer.php');
        ?>
    </div>
</body>

</html>