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
        <input type='text' id='TenDanhMuc' name='TenDanhMuc' > <br>

        <label for='NCC'>Nhà cung cấp</label>
        <input type='number' id='NCC' name='NCC' > <br>

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
?>
