<?php 
include_once('../connect.php');

// upload hình ảnh
$icon = $_FILES['image']['name'];
$tmp = $_FILES['image']['tmp_name'];
move_uploaded_file($tmp,"../image/".$icon);

// lấy dữ liệu từ form
$theloai = $_POST['TenTL'];
$thutu = $_POST['ThuTu'];
$an = $_POST['AnHien'];

// thêm vào DB
$sql = "INSERT INTO theloai (TenTL,ThuTu,AnHien,icon) 
        VALUES('$theloai','$thutu','$an','$icon')";

if(mysqli_query($connect,$sql)){
    echo "<script>alert('Thêm thành công'); location.href='theloai.php';</script>";
} else {
    echo "Lỗi: " . mysqli_error($connect);
}
?>
