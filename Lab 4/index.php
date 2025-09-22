
// Gọi file connect
<?php  include_once('../connect.php'); ?>

// Câu lệnh SQL
$sql = "SELECT * FROM theloai ORDER BY ThuTu ASC";

// Thực thi
$result = mysqli_query($conn, $sql);

// Kiểm tra có dữ liệu không
if (!$result) {
    die("Lỗi truy vấn: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách Thể loại</title>
</head>
<body>
    <h1>Danh sách Thể loại</h1>
    <ul>
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <li>
                <?= $row['TenTL'] ?> 
                (Thứ tự: <?= $row['ThuTu'] ?>, 
                Ẩn/Hiện: <?= $row['AnHien'] ?>, 
                Icon: <?= $row['icon'] ?>)
            </li>
        <?php } ?>
    </ul>
</body>
</html>
