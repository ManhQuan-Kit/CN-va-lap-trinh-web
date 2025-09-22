<?php
// filepath: d:\Xampp\htdocs\ex_starts\ch04_ex1\edit_category_form.php
require_once('database.php');
$category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
if ($category_id === false) {
    $error = "ID danh mục không hợp lệ.";
    include('error.php');
    exit();
}
$stmt = $db->prepare("SELECT * FROM categories WHERE categoryID = :id");
$stmt->execute([':id' => $category_id]);
$category = $stmt->fetch();
if (!$category) {
    $error = "Không tìm thấy danh mục.";
    include('error.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="utf-8" />
  <title>Sửa danh mục</title>
  <link rel="stylesheet" type="text/css" href="main.css" />
</head>
<body>
<div id="page">
  <div id="header"><h1>Sửa danh mục</h1></div>
  <div id="main">
    <form action="edit_category.php" method="post" accept-charset="UTF-8">
      <input type="hidden" name="category_id" value="<?php echo (int)$category['categoryID']; ?>" />
      <label>Tên danh mục:</label>
      <input type="text" name="name" value="<?php echo htmlspecialchars($category['categoryName'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>" />
      <input type="submit" value="Lưu" />
    </form>
    <p><a href="category_list.php">Quay lại</a></p>
  </div>
  <div id="footer"><p>&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p></div>
</div>
</body>
</html>