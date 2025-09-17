<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Sửa Thể Loại</title>
</head>
<body>
<?php 
include("../connect.php");
$id = $_GET['idTL'];
$sql="SELECT * FROM theloai WHERE idTL=$id";
$results = mysqli_query($connect,$sql);
$d = mysqli_fetch_array($results);
?>
<form method="post" enctype="multipart/form-data">
<table width="400">
<tr>
	<td align="right">Tên Thể Loại</td>
	<td><input type="text" name="TenTL" value="<?php echo $d['TenTL'];?>" /></td>
</tr>
<tr>
	<td align="right">Thứ Tự</td>
	<td><input type="text" name="ThuTu" value="<?php echo $d['ThuTu'];?>" /></td>
</tr>
<tr>
	<td align="right">Ẩn Hiện</td>
	<td>
		<select name="AnHien">
			<option value="0" <?php if($d['AnHien']==0) echo "selected";?>>Ẩn</option>
			<option value="1" <?php if($d['AnHien']==1) echo "selected";?>>Hiện</option>
		</select>
	</td>
</tr>
<tr>
	<td align="right">Icon</td>
	<td><img src="../image/<?php echo $d['icon'] ?>" width="40" height="40" /></td>
</tr>
<tr>
	<td></td>
	<td>
		<input type="file" name="image" />
		<input type="hidden" name="ten_anh" value="<?php echo $d['icon']; ?>" >
	</td>
</tr>
<tr>
	<td></td>
	<td>
		<input type="submit" name="Sua" value="Sửa" />
	</td>
</tr>
</table>
</form>

<?php
if(isset($_POST['Sua'])){
	$theloai = $_POST['TenTL'];
	$thutu = $_POST['ThuTu'];
	$an = $_POST['AnHien'];
	$icon = $_POST['ten_anh'];

	// nếu có file mới thì update
	if($_FILES['image']['name'] != ""){
		$icon = $_FILES['image']['name'];
		move_uploaded_file($_FILES['image']['tmp_name'],"../image/".$icon);
		// xóa ảnh cũ
		$old="../image/".$_POST['ten_anh'];
		if(file_exists($old)) unlink($old);
	}

	$sl="UPDATE theloai SET TenTL='$theloai', ThuTu='$thutu', AnHien='$an', icon='$icon' WHERE idTL=$id";

	if(mysqli_query($connect,$sl)){
		echo "<script>alert('Sửa thành công'); location.href='theloai.php';</script>";
	} else {
		echo "Lỗi: " . mysqli_error($connect);
	}
}
?>
</body>
</html>
