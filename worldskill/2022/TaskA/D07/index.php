<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Number of Days</title>
	</head>
	<body>
		<h4>Calculate number of days</h4>
		<form>
			<label for="date1">Date 1:
				<input type="date" name="date1">
			</label>

			<label for="date2">Date 2:
				<input type="date" name="date2">
			</label>

			<input type="submit" name="submit" value="送出">
		</form>
		<?php
			if(isset($_GET["submit"])){
				$date1=$_GET["date1"];
				$date2=$_GET["date2"];
				$diff=abs(strtotime($date2)-strtotime($date1));
				$days=floor($diff/(60*60*24));
				?>
				<p>Output:<?php echo($days === 1 ? "one day" : "$days days") ?></p>
				<?php
			}
		?>
	</body>
</html>