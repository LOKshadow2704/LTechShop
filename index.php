<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/index.css">
    <link rel="stylesheet" href="./assets/css/suggestShop.css">
    <link rel="stylesheet" href="./assets/css/footer.css">
    <link rel="stylesheet" href="./assets/css/header.css">
    <script src="https://kit.fontawesome.com/0bd872d3c5.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <div id="root">
        <?php
            include_once('./View/v_header.php');
        ?>
        <?php
            if(isset($_REQUEST['MP'])){
                $userid=1;
                include_once("./View/v_Product.php");
                $product = new viewProduct();
                $table = $product ->getProductbyManager();
            }else{
                include_once("./View/v_Shop.php");
                $suggestShop = new viewShop();
                $shop = $suggestShop->viewSuggestShop();
                include_once("./View/v_Product.php");
                $suggestShop = new viewShop();
                $shop = $suggestShop->viewSuggestShop();
            }
        ?>
        <div class="suggest_product">
        </div>
        <?php
            include_once('./View/v_footer.php');
        ?>
    </div>
</body>
</html>