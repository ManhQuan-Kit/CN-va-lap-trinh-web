<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Danh sách Thể Loại</title>
</head>
<body>
<?php include_once('../connect.php'); ?>
<table border="1" align="center" width="600">
	<tr align="center">
		<td>Tên Thể Loại</td>
		<td>Thứ Tự</td>
		<td>Ẩn Hiện</td>
		<td>Biểu Tượng</td>
		<td colspan="2"><a href="theloai_them.php">Thêm</a></td>
	</tr>
<?php 
$sql= "SELECT * FROM theloai";
$results = mysqli_query($connect,$sql);
while($rows = mysqli_fetch_assoc($results)){ ?>
	<tr align="center">
		<td><?php echo $rows['TenTL']; ?></td>
		<td><?php echo $rows['ThuTu']; ?></td>
		<td><?php echo ($rows['AnHien']==1) ? "Hiện" : "Ẩn"; ?></td>
		<td><img src="../image/<?php echo $rows['icon'] ?>" width="40" height="40" /></td>
		<td><a href="theloai_sua.php?idTL=<?php echo $rows['idTL'];?>">Sửa</a></td>
		<td><a href="theloai_xoa.php?idTL=<?php echo $rows['idTL'];?>" onclick="return confirm('Bạn chắc chắn muốn xóa?');">Xóa</a></td>
	</tr>
<?php } 
mysqli_close($connect);
?>
</table>
</body>
</html>
