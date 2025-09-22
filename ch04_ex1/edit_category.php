<?php
// filepath: d:\Xampp\htdocs\ex_starts\ch04_ex1\edit_category.php
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
$name = trim(filter_input(INPUT_POST, 'name', FILTER_UNSAFE_RAW));
if ($category_id === false || empty($name)) {
    $error = "Dữ liệu không hợp lệ.";
    include('error.php');
    exit();
}
require_once('database.php');
$stmt = $db->prepare("UPDATE categories SET categoryName = :name WHERE categoryID = :id");
$stmt->execute([':name' => $name, ':id' => $category_id]);
header("Location: category_list.php");
exit();
?>