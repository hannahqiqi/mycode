<?php

    $keywords = @$_GET['keywords'];
    $pageNum = isset($_GET['pageNum']) ? $_GET['pageNum'] : 1;
    
    $conn = new mysqli('localhost', 'root', '', 'samp_db');
    
    $pageSize = 5;
    $count = $conn->query(" SELECT count(id) as count FROM tbd_goods WHERE goods_name LIKE '%$keywords%' ");

    $countRow = $count->fetch_row();
    if($countRow) $totalCount = $countRow[0];

    $totalPage = ceil($totalCount/$pageSize);
    $pageNum = $pageNum > $totalPage ? $totalPage : $pageNum;
    $pageNum = $pageNum < 1 ? 1 : $pageNum;
    $startIndex = ($pageNum - 1) * $pageSize;
    
    $sql = " SELECT * FROM tbd_goods WHERE goods_name LIKE '%$keywords%' limit $startIndex, $pageSize";
    $results = $conn->query($sql);

?>


    <div style="text-align: center;">
                <a href='search.php?pageNum=<?php echo ($pageNum - 1) < 1 ? 1 : ($pageNum - 1) ?>'>上一页</a>
                <a href='search.php?pageNum=<?php echo ($pageNum + 1) > $totalPage ? $totalPage : ($pageNum + 1) ?>'>下一页</a>
            </div>
