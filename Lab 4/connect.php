<?php 
$connect = mysqli_connect('localhost','root','','tintuc');

//Nếu có lỗi xảy ra thì dừng đoạn mã và in ra thông báo lỗi.
if(mysqli_connect_errno() !== 0){
    die("Error: Could not connect to the database. " . mysqli_connect_error());
}

//Thiết lập charset UTF8
mysqli_set_charset($connect,'utf8mb4');
?>
