<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/index.css">
    <link rel="stylesheet" href="./assets/css/suggestShop.css">
    <script src="https://kit.fontawesome.com/0bd872d3c5.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <div id="root">
        <?php
            include_once('./View/v_header.php');
        ?>
        <div class="container">
            <div class="suggest_shop">
                <h1>Shop gợi ý cho bạn</h1>
                <?php
                    include_once("./View/v_Shop.php");
                    $suggestShop = new viewShop();
                    $shop = $suggestShop->viewSuggestShop();
                ?>
            </div>
            <div class="suggest_product">
                <?php
                    include_once("./View/v_Product.php");
                    $suggestShop = new viewShop();
                    $shop = $suggestShop->viewSuggestShop();
                ?>
            </div>
        </div>
        <div class="footer">
          
        </div>
    </div>
</body>
</html>