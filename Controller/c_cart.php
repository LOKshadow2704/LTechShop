<?php
include_once "./Model/m_cart.php";
class controllerCart
{
    public function getCart()
    {
        $cart = new modelCart();
        $tableCart = $cart->selectCart($_SESSION['idLogin']);
        return $tableCart;
    }

    public function getCartItem($idprod)
    {
        $cart = new modelCart();
        $row = $cart->selectCartItem($idprod);
        return $row;
    }

    public function deleteCartItem()
    {
        $idCartItem = $_REQUEST['delete_cartitem'];
        $cart = new modelCart();
        $tableCart = $cart->deleteCartItem($idCartItem);
        return $tableCart;
    }

    public function addCartItem()
    {
        $idCartItem = $_REQUEST['addtocart'];
        $cart = new modelCart();
        $tableCart = $cart->insertCartItem($idCartItem);
        return $tableCart;
    }
}
