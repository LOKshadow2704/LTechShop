<?php 
    echo "
    <form class='form-add' action='#' method='post' enctype='multipart/form-data'>
        <h1>Thêm sản phẩm mới</h1>
        <label for='TenSP'>Tên sản phẩm</label>
        <input type='text' id='TenSP' name='TenSP'> <br>

        <label for='DonGia'>Đơn giá	</label>
        <input type='number' id='DonGia' name='DonGia' > <br>

        <label for='HinhAnhSP' >Ảnh sản phẩm</label>
        <input type='file' id='HinhAnhSP' name='myFile'> <br>

        <label for='TenDanhMuc'>Loại sản phẩm</label>
        <input type='number' id='TenDanhMuc' name='TenDanhMuc' > <br>

        <label for='NCC'>Nhà cung cấp</label>
        <input type='text' id='NCC' name='NCC' > <br>

        <label for='soluong'>Số lượng</label>
        <input type='number' id='soluong' name='soluong' > <br>

        <div class='wrap_textarea'>
            <label for='Mota'>Mô tả sản phẩm</label>
            <textarea type='number' id='Mota' name='Mota' ></textarea>
        </div><br>

        <div class='act_submit'>
            <button type='submit' name='add'>Thêm</button>
            <button type='submit' name='cancle'>Quay lại</button>
        </div>
    </form>
    ";
    if(isset($_REQUEST["add"])){
        include_once('./Controller/c_Product.php');
        $product = new controllProduct();
        $addProd = $product -> addProduct();
        if($addProd[1]==200){
            if($addProd[0]){
                echo "<script>alert('Thêm sản phẩm thành công'); window.location.replace('http://localhost:81/LTechShop/index.php?addPr');</script>";
            }else{
                echo "<script>alert('Thêm sản phẩm không thành công') history.back();</script>";
            }
        }else{
            echo "<script>alert('Có vấn đề hình ảnh') history.back();</script>";
        }
        

    }elseif(isset($_REQUEST["cancle"])){
        echo "<script>window.location.replace('http://localhost:81/LTechShop/index.php?MP=1');</script>";
    }
?>
