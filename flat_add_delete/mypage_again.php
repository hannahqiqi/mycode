<html>
    <head>
        <title>mypage_again</title>
        <style>
            body {
                font-size: 12px;
                font-family: verdana;
                width: 100%;
            }
            
            .wrapper {
                width:500px;
                margin: 0 auto;
                padding: 100px;
            }
            
            .tbd-goods {
                text-align: center;
                margin: 0 auto;
                width: 80%;
                border-collapse: collapse;
            }
            
            .tbd-goods td{
                border: 1px solid gray;
            }
            
            .formi {
                display: inline;
            }
            
            div.page a {
                border: 1px solid #aaaadd;
                text-decoration: none;
                padding: 2px 5px 2px 5px;
                margin: 1.5px;
            }
            
            div.page span.current {
                border: 1px solid #000099;
                background-color: #000099;
                color: #fff;
                padding: 4px 6px 4px 6px;
                margin: 2px;
                font-weight: bold;
            }
            
            div.page span.disable {
                border: 1px solid #eee;
                padding: 2px 5px 2px 5px;
                margin: 2px;
                color: #ddd;
            }
            
            div.page {
                text-align: center;
            }
            
            div.content {
                height: 150px;
            }
            
        </style>
    </head>
    <body>
        
        <?php
        
        //$page = @$_GET['p'];
        $pageNum = isset($_GET['pageNum']) ? $_GET['pageNum'] : 1;
        //$pageNum = $pageNum < 1 ? 1 : $pageNum;
        
        $conn = new mysqli('localhost', 'root', '', 'samp_db');
        if(!$conn) {
            echo "数据连接失败";
            exit();
        }
        
        ?>
        <div class="wrapper">
            <div class="content">
                <table class="tbd-goods">
                    
                    <?php
                        $pageSize = 5;
                        $startIndex = ($pageNum - 1) * $pageSize;
                        $count = $conn->query(" SELECT COUNT(*) AS count FROM tbd_goods ");
                        $countRow = $count->fetch_row();
                        if($countRow) {
                            $totalCount = $countRow[0];
                            //echo $totalCount;
                        }
                        $totalPage = ceil($totalCount/$pageSize);
                        //echo $totalPage;
                        //$pageNum = $pageNum > $totalPage ? $totalPage : $pageNum;
                        $sql = " SELECT * FROM tbd_goods LIMIT $startIndex, $pageSize ";
                        //echo $sql;
                        echo "<tr><td>id</td><td>goods_name</td><td>goods_price</td></tr>";
                        if($results = $conn->query($sql)) {
                            while($row = $results->fetch_assoc()) {
                                echo "<tr><td>{$row['id']}</td><td>{$row['goods_name']}</td><td>{$row['goods_price']}</td></tr>";
                            }
                            $results->free();
                        }
                        $conn->close();
                            
                    ?>
                
                </table>
            </div>
            
           <div class="page">
                <?php
                if($pageNum > 1) {
                                echo "<a href='mypage_again.php?pageNum=1'>首页</a>";
                                echo "<a href='mypage_again.php?pageNum=".($pageNum -1)."'><上一页</a>";
                            } else {
                                echo "<span class='disable'>首页</span>";
                                echo "<span class='disable'>上一页</span>";
                            }
                    
                    $showPage = 5;
                    $pageOffset = ($showPage - 1)/2;
                    $start = 1;
                    $end = $totalPage;
                            
                    if($totalPage > $showPage) {
                        if($pageNum > ($pageOffset + 1)) {
                            echo "...";
                        }
                        if($pageNum > $pageOffset) {
                            $start = $pageNum - $pageOffset;
                            $end = $totalPage > $pageNum + $pageOffset ? $pageNum + $pageOffset : $totalPage;
                        } else {
                            $start = 1;
                            $end = $totalPage > $showPage ? $showPage : $totalPage;
                        }
                        if ($pageNum+$pageOffset > $totalPage) {
                            $start = $start - ($pageNum + $pageOffset - $end);
                        }
                    }
                    
                    for($i=$start;$i<=$end;$i++) {
                        if($pageNum == $i) {
                            echo "<span class='current'>{$i}</span>";
                        } else {
                            echo "<a href='mypage_again.php?pageNum=".$i."'>{$i}</a>";
                        }
                    }
                    if($totalPage>$showPage && $totalPage >$pageNum+$pageOffset) {
                        echo "...";
                    }
                            
                if($pageNum < $totalPage) {
                    echo "<a href='mypage_again.php?pageNum=".($pageNum + 1)."'>下一页></a>";
                    echo "<a href='mypage_again.php?pageNum=".$totalPage."'>尾页</a>";    
                } else {
                    echo "<span class='disable'>下一页</span>";
                    echo "<span class='disable'>尾页</span>";
                }        
                ?>
                
                <span>共有<?php echo $totalPage ?>页，</span>
                <form class="formi" action="mypage_again.php" method="get">
                        <span>到第<input type="text" name="pageNum" size="2">页</span>
                        <span><button type="submit">确定</button></span>
                </form>
           </div> 
       </div>
    </body>
</html>