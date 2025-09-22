<?php
// ...existing code...
// An toàn hơn: dùng filter_input và kiểm tra chuỗi trước khi xử lý
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
$code = trim((string) filter_input(INPUT_POST, 'code', FILTER_UNSAFE_RAW));
$name = trim((string) filter_input(INPUT_POST, 'name', FILTER_UNSAFE_RAW));
$price_raw = trim((string) filter_input(INPUT_POST, 'price', FILTER_UNSAFE_RAW));

var_dump($_POST);

// Nếu trang được truy cập trực tiếp (không phải POST), báo lỗi nhẹ
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $error = "Form chưa được gửi.";
    include('error.php');
    exit();
}

// Chuẩn hoá số tiền: cho phép nhập dấu phẩy
$price_raw = str_replace(',', '.', $price_raw);
$price = ($price_raw === '') ? false : filter_var($price_raw, FILTER_VALIDATE_FLOAT);

// Kiểm tra dữ liệu
if ($category_id === false || $category_id === null || $code === '' || $name === '' || $price === false) {
    $error = "Dữ liệu sản phẩm không hợp lệ. Vui lòng kiểm tra các trường (danh mục, mã, tên, giá).";
    include('error.php');
    exit();
}

require_once('database.php');

try {
    $stmt = $db->prepare("INSERT INTO products (categoryID, productCode, productName, listPrice) VALUES (:cat, :code, :name, :price)");
    $stmt->execute([
        ':cat' => $category_id,
        ':code' => $code,
        ':name' => $name,
        ':price' => $price
    ]);
} catch (Exception $e) {
    $error = "Lỗi khi thêm sản phẩm: " . $e->getMessage();
    include('error.php');
    exit();
}

header("Location: index.php?category_id=" . $category_id);
exit();
?>
// ...existing code...