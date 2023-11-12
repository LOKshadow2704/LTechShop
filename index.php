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
    <link rel="stylesheet" href="./assets/css/slideshow.css">
    <link rel="stylesheet" href="./assets/css/form.css">
    <script src="./assets/js/slideshow.js"></script>
    <script src="https://kit.fontawesome.com/0bd872d3c5.js" crossorigin="anonymous"></script>
    <title>Trang chủ</title>
</head>
<body>
    <div id="root">
        <?php
            include_once('./View/v_header.php');
        ?>
        <div class="container">
            <div class="subnav">
                <?php 
                    if(isset($_REQUEST['MP'])){
                        echo "<a href='index.php'><i class='fa-solid fa-house-chimney-window'></i><p>&nbsp;Trang chủ</p></a><a href='index.php?MP=1'><p>&nbsp;/ Quản lý sản phẩm</p></a>";
                    }else{
                        echo "<a href='index.php'><i class='fa-solid fa-house-chimney-window'></i><p>&nbsp;Trang chủ</p></a>";
                    }
                ?>
            </div>
            <?php
                if(isset($_REQUEST['MP'])){
                    $userid=1;
                    include_once("./View/v_Product.php");
                    $product = new viewProduct();
                    $table = $product ->getProductbyManager();
                }elseif(isset($_REQUEST["login"])){
                    include_once("./View/login.php");
                }elseif(isset($_REQUEST["addPr"])){
                    include_once('./View/v_add_product.php');
                }else{
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