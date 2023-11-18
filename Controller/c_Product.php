<?php
    include_once("./Model/m_Product.php");
    class controllProduct{
        function getAllProduct(){
            $Product = new modelProduct();
            $tableProduct = $Product->selectAllProduct();
            return $tableProduct;
        }

        function getSuggestProduct(){
            $Product = new modelProduct();
            $tableProduct = $Product->selectSuggestProduct();
            return $tableProduct;
        }

        function getProductbyManager(){
            $userid =1;
            $Product = new modelProduct();
            $tableProduct = $Product->selectProductbyManager($userid);
            return $tableProduct;
        }

        function getOneProduct($id){
            $Product = new modelProduct();
            $tableProduct = $Product->selectOneProduct($id);
            if(!$tableProduct){
                return false;
            }else{
                if(mysql_num_rows($tableProduct)>0){
                    return $tableProduct;
                }else{
                    return 0;
                }
            }
        }

        function addProduct(){
            //Bắt dữ liệu
            $IdUser = 1;
            $ProdName = $_REQUEST['TenSP'];
            $ProdPrice = $_REQUEST['DonGia'];
            $file = $_FILES['myFile'];
            $ProdCategory = $_REQUEST['TenDanhMuc'];
            $ProdSupp = $_REQUEST['NCC'];
            $ProdDescribe = $_REQUEST['Mota'];
            $pro = new modelProduct();
            $result = $pro->insertProduct($IdUser,$ProdName,$ProdPrice,$file,$ProdCategory,$ProdSupp,$ProdDescribe);
            return $result;        
    }

        function deleteProduct(){
            //Bắt dữ liệu
            $idProd = $_REQUEST['delete'];
            $pro = new modelProduct();
            $result = $pro->deleteProduct($idProd);
            return $result;        
    }

    function updateProduct(){
        //Bắt dữ liệu
        $idProd = $_REQUEST['update'];
        $ProdName = $_REQUEST['TenSP'];
        $ProdPrice = $_REQUEST['DonGia'];
        $file = $_FILES['myFile'];
        $ProdCategory = $_REQUEST['TenDanhMuc'];
        $ProdSupp = $_REQUEST['NCC'];
        $ProdDescribe = $_REQUEST['Mota'];
        $pro = new modelProduct();
        $result = $pro->updateProduct($idProd,$ProdName,$ProdPrice,$file,$ProdCategory,$ProdSupp,$ProdDescribe);
        return $result;        
}
}
?>