<!DOCTYPE html>
<html>
	<body>
		<h1>DATABASE CONNECTION</h1>

		<?php
		ini_set('display_errors', 1);
		echo "Hello Cloud computing class 0818!";
		?>

		<?php
		if (empty(getenv("DATABASE_URL"))){
			echo '<p>The DB does not exist</p>';
			$pdo = new PDO('pgsql:host=localhost;port=5432;dbname=mydb', 'postgres', '123456');
		}  
		else{
			echo '<p>The DB exists</p>';
			echo getenv("dbname");
			$db = parse_url(getenv("DATABASE_URL"));
			$pdo = new PDO("pgsql:" . sprintf(
			"host=ec2-23-21-129-125.compute-1.amazonaws.com;port=5432;user=lrqgdgzdowigqc;password=8652e83044024491ba444c1d161044f803b99c9101bd7d129e8a6a6db78b5bea;dbname=deh478l9lii3uq",
			$db["host"],
			$db["port"],
			$db["user"],
			$db["pass"],
			ltrim($db["path"], "/")
			));
		}  

		$sql = "SELECT * FROM asm2 ORDER BY shopid";
		$stmt = $pdo->prepare($sql);
		//Thiết lập kiểu dữ liệu trả về
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$stmt->execute();
		$resultSet = $stmt->fetchAll();
		echo '<p>Students information:</p>';
		?>

		<div id="container">
			<table class="table table-bordered table-condensed">
				<thead>
				<tr>
				<th>Shop ID</th>
				<th>Accountant</th>
				<th>Revenue</th>
				<th>Last Time Check</th>
				</tr>
				</thead>
				<tbody>

				<?php
				// tạo vòng lặp 
				//while($r = mysql_fetch_array($result)){
				foreach ($resultSet as $row) {
				?>

				<tr>
				<td scope="row"><?php echo $row['shopid'] ?></td>
				<td><?php echo $row['accountant'] ?></td>
				<td><?php echo $row['revenue'] ?></td>
				<td><?php echo $row['timecheck'] ?></td>
				</tr>

				<?php
				}
				?>

				</tbody>
			</table>
		</div>
	</body>
</html>
