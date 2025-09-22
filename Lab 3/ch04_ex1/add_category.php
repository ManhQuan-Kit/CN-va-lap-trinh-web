<?php
// filepath: d:\Xampp\htdocs\ex_starts\ch04_ex1\add_category.php
$name = trim(filter_input(INPUT_POST, 'name', FILTER_UNSAFE_RAW));
if (empty($name)) {
    $error = "Tên danh mục không được rỗng.";
    include('error.php');
    exit();
}
require_once('database.php');
$stmt = $db->prepare("INSERT INTO categories (categoryName) VALUES (:name)");
$stmt->execute([':name' => $name]);
header("Location: category_list.php");
exit();
?>