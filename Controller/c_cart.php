<?php
session_start();
include_once("./Model/m_cart.php");
class controllerCart {
        function getCart(){
            $cart = new modelCart();
            $tableCart = $cart->selectCart($_SESSION['idLogin']);
            return $tableCart;
        }

        function getCartItem($idprod){
            $cart = new modelCart();
            $row = $cart->selectCartItem($idprod);
            return $row;
        }

        function deleteCartItem(){
            $idCartItem = $_REQUEST['delete_cartitem'];
            $cart = new modelCart();
            $tableCart = $cart->deleteCartItem($idCartItem);
            return $tableCart;
        }

        function addCartItem(){
            $idCartItem = $_REQUEST['addtocart'];
            $cart = new modelCart();
            $tableCart = $cart->insertCartItem($idCartItem);
            return $tableCart;
        }
    }
?>
