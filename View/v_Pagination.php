<?php 
    echo'<div class="pagination">';
    if ($current_page > 1 && $total_page > 1){
        echo '<a href="index.php?page='.($current_page-1).'">Prev</a> | ';
    }

    // Lặp khoảng giữa
    for ($i = 1; $i <= $total_page; $i++){
        // Nếu là trang hiện tại thì hiển thị thẻ span
        // ngược lại hiển thị thẻ a
        if ($i == $current_page){
            echo '<span>'.$i.'</span> | ';
        }
        else{
            echo '<a href="index.php?viewP=1&page='.$i.'">'.$i.'</a> | ';
        }
    }

    // nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
    if ($current_page < $total_page && $total_page > 1){
        echo '<a href="index.php?viewP=1&page='.($current_page+1).'">Next</a> | ';
    }
    echo '</div>';
?>