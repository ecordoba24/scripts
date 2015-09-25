<html>
<body>
	<?=$_GET['mensaje']?>
	<form action="upload.php" method="POST" enctype="multipart/form-data">
		<label for="archivo">Archivo:</label>
		<input type="file" name="archivo" id="archivo" />
		<input type="submit" name="subir" value="Subir"/>
	</form>
</body>
</html>