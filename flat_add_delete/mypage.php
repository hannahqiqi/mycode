<html>
    <head>
        <title>mypage</title>
        <style>
            body {
                font-size: 12px;
                font-family: verdana;
                width: 100%;
            }
        </style>
    </head>
    <body>
        <?php

            $page = @$_GET['p'];


            $conn = new mysqli('localhost', 'root', '', 'samp_db');
            if ($conn->connect_errno) {
                printf('数据库连接失败');
                exit();
            }

            $pageSize = 5;
            $startIndex = ($page - 1) * $pageSize;
            $sql = " SELECT * FROM tbd_goods LIMIT $startIndex, $pageSize ";
            //echo $sql;
            
        ?>
        <div class="content" style="height: 180px">
            <table border=1 cellspacing=0 width=40% align=center>
                <tbody>
                    <?php
                        echo "<tr><td>id</td><td>goods_name</td><td>goods_price</td></tr>";
                        if ($result = $conn->query($sql)) { 
                            while($row = $result->fetch_assoc()) {
                            echo "<tr><td>{$row['id']}</td><td>{$row['goods_name']}</td>
                                <td>{$row['goods_price']}</td></tr>"; 
                            }
                            $result->free();
                        }
                        
                        $count = $conn->query(" SELECT COUNT(*) FROM tbd_goods ");
                        $countRow = $count->fetch_row();
                        if ($countRow) {
                            $totalCount = $countRow[0];
                        }
                        //echo $totalCount;
                        $totalPage = ceil($totalCount/$pageSize);
                        //echo $totalPage;
            
                        $conn->close();
                        
                        
                        
                        ?>
                    </tbody>
            </table>
        </div>
        <div class="page" style="text-align: center">
            <?php
            
                $showPage = 5;
                $pageOffset = ($showPage - 1)/2;
            
                if ($page > 1) {
                    echo "<a style='border: 1px solid #aaaadd; text-decoration:none; padding: 2px 5px 2px 5px; margin: 2px;' href='mypage.php?p=1'>首页</a>";
                    echo "<a style='border: 1px solid #aaaadd; text-decoration:none; padding: 2px 5px 2px 5px; margin: 2px;' href='mypage.php?p=".($page - 1)."'><上一页</a>";
                } else {
                    echo "<span style='border: 1px solid #eee; padding: 2px 5px 2px 5px; margin: 2px; color: #ddd;'>首页</span>";
                    echo "<span style='border: 1px solid #eee; padding: 2px 5px 2px 5px; margin: 2px; color: #ddd;'>上一页</span>";
                }
                
                $start = 1;
                $end = $totalPage;
                if ($totalPage > $showPage) {
                    if ($page > $pageOffset + 1) {
                        echo "...";
                    }
                    if ($page > $pageOffset) {
                        $start = $page - $pageOffset;
                        $end = $totalPage > $page+$pageOffset ? $page+$pageOffset : $totalPage;
                    } else {
                        $start = 1;
                        $end = $totalPage > $showPage ? $showPage : $totalPage;
                    }
                    if ($page+$pageOffset > $totalPage) {
                        $start = $start - ($page + $pageOffset - $end);
                    } 
                }
                
                for($i=$start; $i<=$end; $i++) {
                    if ($page == $i) {
                        echo "<span style='border: 1px solid #000099; background-color: #000099; padding: 4px 6px 4px 6px; margin: 2px; color: #fff; font-weight: bold;'>{$i}</span>";
                    } else {
                    echo "<a style='border: 1px solid #aaaadd; text-decoration:none; padding: 2px 5px 2px 5px; margin: 2px;' href='mypage.php?p=".$i."'>{$i}</a>";    
                    }
                }
                
                if ($totalPage > $showPage && $totalPage > $page + $pageOffset) {
                    echo "...";
                }
                
                if ($page < $totalPage) {
                    echo "<a style='border: 1px solid #aaaadd; text-decoration:none; padding: 2px 5px 2px 5px; margin: 2px;' href='mypage.php?p=".($page + 1)."'>下一页></a>";
                    echo "<a style='border: 1px solid #aaaadd; text-decoration:none; padding: 2px 5px 2px 5px; margin: 2px;' href='mypage.php?p=$totalPage'> 尾页</a>"; 
                } else {
                    echo "<span style='border: 1px solid #eee; padding: 2px 5px 2px 5px; margin: 2px; color: #ddd;'>下一页</span>";
                    echo "<span style='border: 1px solid #eee; padding: 2px 5px 2px 5px; margin: 2px; color: #ddd;'>尾页</span>";
                }
            
            ?>
            
    
                <span>共<?php echo $totalPage ?>页,</span>
                <form action="mypage.php" method="get" style="display: inline">
                    <span>到第<input type="text" name="p" size="2">页</span>
                    <span><button type="submit">确定</button></span>
                </form>
        </div>    
    </body>

</html>