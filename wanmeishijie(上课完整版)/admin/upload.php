<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form action="" method="post" enctype="multipart/form-data">
		<input type="file" name="upload_img" />
		<input type="submit" name="upload" value="上传"/>
	</form>
	<?php
		print_r( $_FILES );
	?>
</body>
</html>