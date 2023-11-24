
<?php
include_once("./Model/m_cart.php");
class controllerCart {
        function getCart(){
            $cart = new modelCart();
            $tableCart = $cart->selectCart($_SESSION['userid']);
            return $tableCart;
        }
    }
?>
