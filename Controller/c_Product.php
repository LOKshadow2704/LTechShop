<?php
include_once "./Model/m_Product.php";
class controllProduct
{
    public function getAllProduct()
    {
        $Product = new modelProduct();
        $tableProduct = $Product->selectAllProduct();
        return $tableProduct;
    }

    public function getSuggestProduct()
    {
        $Product = new modelProduct();
        $tableProduct = $Product->selectSuggestProduct();
        return $tableProduct;
    }

    public function getProductbyManager()
    {
        $Product = new modelProduct();
        $tableProduct = $Product->selectProductbyManager($_SESSION['idLogin']);
        return $tableProduct;
    }

    public function getOneProduct($idprod)
    {
        $id = $_REQUEST["pi"];
        if ($id == "") {
            $id = $idprod;
        }
        $Product = new modelProduct();
        $tableProduct = $Product->selectOneProduct($id);
        if (!$tableProduct) {
            return false;
        } else {
            if (mysql_num_rows($tableProduct) > 0) {
                return $tableProduct;
            } else {
                return 0;
            }
        }
    }

    public function getListProduct()
    {
        $list = $dataArray['oder_prod'];
        $Product = new modelProduct();
        $tableProduct = $Product->selectListProduct($list);
        return $tableProduct;
    }

    public function addProduct()
    {
        //Bắt dữ liệu
        $IdUser = $_SESSION['idLogin'];
        $ProdName = $_REQUEST['TenSP'];
        $ProdPrice = $_REQUEST['DonGia'];
        $file = $_FILES['myFile'];
        $ProdCategory = $_REQUEST['TenDanhMuc'];
        $ProdSupp = $_REQUEST['NCC'];
        $ProdQuan = $_REQUEST['soluong'];
        $ProdDescribe = $_REQUEST['Mota'];
        $pro = new modelProduct();
        $result = $pro->insertProduct($IdUser, $ProdName, $ProdPrice, $file, $ProdCategory, $ProdSupp, $ProdQuan, $ProdDescribe);
        return $result;
    }

    public function deleteProduct()
    {
        //Bắt dữ liệu
        $idProd = $_REQUEST['delete'];
        $pro = new modelProduct();
        $result = $pro->deleteProduct($idProd);
        return $result;
    }

    public function updateProduct()
    {
        //Bắt dữ liệu
        $idProd = $_REQUEST['update'];
        $ProdName = $_REQUEST['TenSP'];
        $ProdPrice = $_REQUEST['DonGia'];
        $file = $_FILES['myFile'];
        $ProdCategory = $_REQUEST['TenDanhMuc'];
        $ProdSupp = $_REQUEST['NCC'];
        $ProdDescribe = $_REQUEST['Mota'];
        $pro = new modelProduct();
        $result = $pro->updateProduct($idProd, $ProdName, $ProdPrice, $file, $ProdCategory, $ProdSupp, $ProdDescribe);
        return $result;
    }

    public function getNumberProduct()
    {
        $pro = new modelProduct();
        $result = $pro->getNumberProduct();
        return $result;
    }

    public function getSPsearch($search)
    {
        $Product = new modelProduct();
        $tableProduct = $Product->selectSPsearch($search);
        return $tableProduct;
    }

    public function getProductFromTo($from, $to)
    {
        $Product = new modelProduct();
        $tableProduct = $Product->getProductFromTo($from, $to);
        return $tableProduct;
    }

}
