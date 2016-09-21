<html>
    <head>
        <title>PDO</title>
    </head>
    <body>
        <?php

            $conn = new PDO('mysql:host=localhost;dbname=samp_db;charset=utf8mb4', 'root', '');
            //$result = $conn->query(" SELECT * FROM tbd_goods ");
            //foreach($result as $row) {
                //echo $row['id'] . ' ' . $row['goods_name'] . ' ' . $row['goods_price'] . "<br />";
            //}
            
            
            //$stmt = $conn->query(" SELECT * FROM tbd_goods ");
            
            //$row_count = $stmt->rowCount();
            //echo $row_count . "<br />"  ;
            
            //while($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                //echo $row->id . ' ' . $row->goods_name . ' ' . $row->goods_price . "<br />";
            //}
            
            //$result = $conn->exec(" INSERT INTO tbd_goods(goods_name, goods_price) VALUES('cheese', 19) ");
            //$insertId = $conn->lastInsertId();
            //echo $insertId;
            
            //$affected_rows = $conn->exec(" UPDATE tbd_goods SET goods_name='chicken' WHERE id=57 ");
            //echo $affected_rows . 'were affected.';
            
            
            //$stmt = $conn->prepare(" SELECT * FROM tbd_goods WHERE goods_name=? ");
            //$stmt->execute(array("cheese"));
            //$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //var_dump($rows);
            /*foreach ($rows as $row) {
                echo $row['id'] . '' . $row['goods_name'] . '' . $row['goods_price'];
            }*/
            
            
            
        ?>
    </body>
</html>

