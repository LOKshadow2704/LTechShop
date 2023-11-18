<?php 
    include_once("./Controller/c_Product.php");
    $prod= new controllProduct();
    $table = $prod->getOneProduct($_REQUEST['update']);
    $row = mysql_fetch_assoc($table);
    $textarea = $row['Mota'];
    echo "
    <form class='form-update' action='#' method='post' enctype='multipart/form-data'>
        <h1>Chỉnh sửa sản phẩm</h1>
        <label for='TenSP'>Tên sản phẩm</label>
        <input type='text' id='TenSP' name='TenSP' value='".$row['TenSP']."'> <br>

        <label for='DonGia'>Đơn giá	</label>
        <input type='number' id='DonGia' name='DonGia'  value='".$row['DonGia']."'> <br>

        <label for='HinhAnhSP' >Ảnh sản phẩm</label>
        <input type='file' id='HinhAnhSP' name='myFile'> <br>
        <img src='".$row['HinhAnhSP']."' alt=''> <br>

        <label for='TenDanhMuc'>Loại sản phẩm</label>
        <input type='text' id='TenDanhMuc' name='TenDanhMuc'  value='".$row['IDDanhMuc']."'> <br>

        <label for='NCC'>Nhà cung cấp</label>
        <input type='number' id='NCC' name='NCC'  value='".$row['NCC']."'> <br>

        <div class='wrap_textarea'>
            <label for='Mota'>Mô tả sản phẩm</label>
            <textarea type='number' id='Mota' name='Mota'>".$textarea."</textarea>
        </div><br>

        <div class='act_submit'>
            <button type='submit' name='udt_product'>Chỉnh sửa</button>
            <button type='submit' name='cancle'>Quay lại</button>
        </div>
    </form>
    ";

    if(isset($_REQUEST["udt_product"])){
        include_once('./Controller/c_Product.php');
        $product = new controllProduct();
        $addProd = $product -> updateProduct();
            if(($addProd[0] && $addProd[1]==200) || ($addProd[0] && $addProd[1]==0)){
                header("refresh: 0;url=index.php?MP=1");
                echo "<script>alert('Cập nhật sản phẩm thành công')</script>";
            }else{
                echo "<script>alert('Cập nhật sản phẩm không thành công')</script>";
                if($addProd[1]!=200 && $addProd[1]!=0){
                    echo "<script>alert('Có vấn đề hình ảnh')</script>";
                }
            }
            
    }elseif(isset($_REQUEST["cancle"])){
        header("Location: index.php?MP=1");
    }
?>
