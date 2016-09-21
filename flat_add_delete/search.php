<?php
	$keywords = @$_GET['keywords'];
	$keywordsParam = '';
	if($keywords) {
		$keywordsParam = " where goods_name like '%$keywords%' ";
	}
	
	$conn = new mysqli('localhost', 'root', '', 'samp_db');
	
	$query = " select count(1) from tbd_goods $keywordsParam ";
	$result = $conn->query($query);
	$ret = $result->fetch_row();
	$count = $ret[0];
	
	$pageSize = 5;
	$totalPage = ceil($count/$pageSize);
	$pageNum = isset($_GET['pageNum']) ? $_GET['pageNum'] : 1;
	$pageNum = $pageNum > $totalPage ? $totalPage : $pageNum;
	$pageNum = $pageNum < 1 ? 1 : $pageNum;
	
	$index = ($pageNum - 1) * $pageSize; 
	
	$sql = " select * from tbd_goods $keywordsParam limit $index, $pageSize ";
	echo $sql;
	$results = $conn->query($sql);
	
?>

<html>
	
	<head>
		<title>search</title>
		<style>
			.wrapper {
				width: 450px;
				margin: 0 auto;
				padding: 50px;
			}
			
			.tbl-goods {
				width: 100%;
				border-collapse: collapse;
			}
			
			.tbl-goods th, td {
				border: 1px solid gray;
			}
		</style>
	</head>

	<body>
		<div class="wrapper">
			<form action="search.php" method="get">
				<input type="text" name="keywords" value="<?php echo $keywords ?>">
				<button type="submit">Search</button>
			</form>
			<form action="add.html" method="post">
				<button type="submit">Add</button>
			</form>
			<table class="tbl-goods">
				<thead>
					<tr>
						<th>Id</th>
						<th>Name</th>
						<th>Price</th>
						<th>Operate</th>
					</tr>
				</thead>
				<tbody>
					<?php
						while($row = $results->fetch_row()) {
							echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . 
							     "</td><td style='text-align:center;'>
								 <a href='delete.php?id=$row[0]'>Delete</a>
								 <a href='edit.php?id=$row[0]&name=$row[1]&price=$row[2]'>Edit</a><tr></tr>";
						}
					?>
				</tbody>
			</table>
			
			<div style="text-align: center; margin-top: 10px;">
				<a href="search.php?pageNum=<?php echo $pageNum - 1 ?>&keywords=<?php echo $keywords ?>">上一页</a>
				<a href="search.php?pageNum=<?php echo $pageNum + 1 ?>&keywords=<?php echo $keywords ?>">下一页</a>
				
			</div>
			
		</div>
	</body>

</html>
