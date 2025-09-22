<?php
// filepath: d:\Xampp\htdocs\ex_starts\ch04_ex1\delete_product.php
$product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);

if ($product_id === false) {
    $error = "ID sản phẩm không hợp lệ.";
    include('error.php');
    exit();
}

require_once('database.php');
$stmt = $db->prepare("DELETE FROM products WHERE productID = :id");
$stmt->execute([':id' => $product_id]);

header("Location: index.php?category_id=" . ($category_id ?: 1));
exit();
?>