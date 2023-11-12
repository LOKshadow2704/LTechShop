<?php 
    include_once("./Controller/c_Product.php");
    $prod= new controllProduct();
    $row = $prod->getOneProduct($_REQUEST['update']);
    $row = mysql_fetch_assoc($row);
    echo "
    <form class='form-update' action='#' method='post' enctype='multipart/form-data'>
        <h1>Chỉnh sửa sản phẩm</h1>
        <label for='TenSP'>Tên sản phẩm</label>
        <input type='text' id='TenSP' name='TenSP' value=''> <br>

        <label for='DonGia'>Đơn giá	</label>
        <input type='number' id='DonGia' name='DonGia'  value=''> <br>

        <label for='HinhAnhSP' >Ảnh sản phẩm</label>
        <input type='file' id='HinhAnhSP' name='myFile' value=''> <br>

        <label for='TenDanhMuc'>Loại sản phẩm</label>
        <input type='text' id='TenDanhMuc' name='TenDanhMuc'  value=''> <br>

        <label for='NCC'>Nhà cung cấp</label>
        <input type='number' id='NCC' name='NCC'  value=''> <br>

        <div class='wrap_textarea'>
            <label for='Mota'>Mô tả sản phẩm</label>
            <textarea type='number' id='Mota' name='Mota' ></textarea>
        </div><br>

        <div class='act_submit'>
            <button type='submit' name='update'>Chỉnh sửa</button>
            <button type='submit' name='cancle'>Quay lại</button>
        </div>
    </form>
    ";
?>
