<?php
    session_start();
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
            $Product = new modelProduct();
            $tableProduct = $Product->selectProductbyManager($_SESSION['idLogin']);
            return $tableProduct;
        }

        function getOneProduct($idprod){
            $id =$_REQUEST["pi"];
            if($id==""){
                $id=$idprod;
            }
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

        function getOneinfProduct($idprod){
            $id =$_REQUEST["pi"];
            if($id==""){
                $id=$idprod;
            }
            $Product = new modelProduct();
            $tableProduct = $Product->selectOneinfProduct($id);
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

        function getListProduct(){
            $list = $dataArray['oder_prod'];
            $Product = new modelProduct();
            $tableProduct = $Product->selectListProduct($list);
            return $tableProduct;
        }

        function addProduct(){
            //Bắt dữ liệu
            $IdUser =$_SESSION['idLogin'];
            $ProdName = $_REQUEST['TenSP'];
            $ProdPrice = $_REQUEST['DonGia'];
            $file = $_FILES['myFile'];
            $ProdCategory = $_REQUEST['TenDanhMuc'];
            $ProdSupp = $_REQUEST['NCC'];
            $ProdQuan = $_REQUEST['soluong'];
            $ProdDescribe = $_REQUEST['Mota'];
            if($ProdName==""||$ProdPrice<=0||$ProdCategory==""||$ProdSupp==""||$ProdQuan==""||$ProdDescribe==""){
                echo "<script>alert('Không được để trống dữ liệu');  history.back();</script>";
                return false;
            }
            $pro = new modelProduct();
            $result = $pro->insertProduct($IdUser,$ProdName,$ProdPrice,$file,$ProdCategory,$ProdSupp,$ProdQuan,$ProdDescribe);
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

    function getSPsearch($search){
        $Product = new modelProduct();
        $tableProduct = $Product->selectSPsearch($search);
        return $tableProduct;
    }
}
?>