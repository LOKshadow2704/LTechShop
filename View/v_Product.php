<?php
include_once "./Controller/c_Product.php";
class viewProduct
{
    public function getProductbyManager()
    {
        $pro = new controllProduct();
        $table = $pro->getProductbyManager();
        if (!$table) {
            echo "ERROR";
        } elseif (mysql_num_rows($table) == 0) {
            echo "0 result";
        } else {
            echo "<a href='index.php?addPr'><button class='button-68 add' role='button'>Thêm sản phẩm mới</button></a>";
            echo "<table class='table_product'>";
            echo "<thead>";
            echo "<tr>";
            echo "<td>Mã sản phẩm</td><td>Tên sản phẩm</td><td>Loại sản phẩm</td><td>Đơn giá </td><td>Ảnh sản phẩm </td><td>Nhà cung cấp</td><td>Tác vụ</td>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while ($row = mysql_fetch_assoc($table)) {
                echo "<tr>";
                echo "<td>" . $row['IDSanPham'] . "</td><td>" . $row['TenSP'] . "</td><td>" . $row['TenDanhMuc'] . "</td><td>" . number_format($row["DonGia"], 0, ",", ".") . "</td><td><img src='" . $row['HinhAnhSP'] . "' width='100%'></td><td>" . $row['NCC'] . "</td><td><div class='act'><a href='index.php?update=" . $row['IDSanPham'] . "'><button class='button-68 update' role='button'>Chỉnh sửa</button></a> <a href='index.php?delete=" . $row['IDSanPham'] . "' onclick='return confirm(\"" . "Bạn có chắc chắn muốn xóa sản phẩm " . $row['TenSP'] . " ?" . "\");'><button class='button-68 delete' role='button'>Xóa</button></a></div></td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        }
    }

    public function viewSuggestProduct()
    {
        $cProduct = new controllProduct();
        $tableProduct = $cProduct->getSuggestProduct();
        if (mysql_num_rows($tableProduct) > 0) {
            $count = 0;

            echo "<div class='Suggest_product'>";
            echo "<h1>Sản phẩm gợi ý cho bạn</h1>";
            while ($row = mysql_fetch_assoc($tableProduct)) {

                if ($count == 0) {

                    echo "<ul>";
                }
                echo "<li> <a href='index.php?pi=" . $row['IDSanPham'] . "'>";
                echo "<br>";
                echo "<img width=280px height=200px src=" . $row['HinhAnhSP'] . ">";
                echo "<br> <p style='color: black'><b>" . $row["TenSP"] . "</b></p>";
                echo "<br><br>";
                echo "<p style= 'color: red'>" . number_format($row["DonGia"], 0, ",", ".") . " VNĐ</p>";
                echo "<br><br> </a></li>";
                $count++;
                if ($count % 4 == 0) {
                    echo "</ul>";
                    $count = 0;
                }
            }

            echo "</div>";
        } else {
            echo "o result";
        }
    }

    public function viewAllProduct()
    {
        $cProduct = new controllProduct();
        // phân trang
        // lấy tổng số sản phẩm có trong db
        $total_products = $cProduct->getNumberProduct();

        // trang hiển tại
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        $limit = 8;

        // tính tổng số trang
        $total_page = ceil($total_products / $limit);
        // Giới hạn current_page trong khoảng 1 đến total_page
        if ($current_page > $total_page) {
            $current_page = $total_page;
        } else if ($current_page < 1) {
            $current_page = 1;
        }

        // Tìm vị trí bắt đầu  của trang hien tai
        $start = ($current_page - 1) * $limit;
        // sản phẩm dduoc lấy từ vị trí $start tới $limit
        $tableProduct = $cProduct->getProductFromTo($start, $limit);
        if (mysql_num_rows($tableProduct) > 0) {
            $count = 0;

            echo "<div class='Suggest_product'>";
            echo "<h1>Danh sách sản phẩm</h1>";
            while ($row = mysql_fetch_assoc($tableProduct)) {

                if ($count == 0) {

                    echo "<ul>";
                }
                echo "<li> <a href='index.php?pi=" . $row['IDSanPham'] . "'>";
                echo "<br>";
                echo "<img width=280px height=200px src=" . $row['HinhAnhSP'] . ">";
                echo "<br> <p style='color: black'><b>" . $row["TenSP"] . "</b></p>";
                echo "<br><br>";
                echo "<p style= 'color: red'>" . number_format($row["DonGia"], 0, ",", ".") . " VNĐ</p>";
                echo "<br><br> </a></li>";
                $count++;
                if ($count % 4 == 0) {
                    echo "</ul>";
                    $count = 0;
                }
            }
            include "View/v_Pagination.php";
            echo "</div>";

        } else {
            echo "o result";
        }
    }

}
