<?php
// filepath: d:\Xampp\htdocs\ex_starts\ch04_ex1\add_product_form.php
require('database.php');
$query = 'SELECT * FROM categories ORDER BY categoryID';
$categories = $db->query($query)->fetchAll();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="utf-8" />
  <title>Thêm sản phẩm</title>
  <link rel="stylesheet" type="text/css" href="main.css" />
</head>
<body>
<div id="page">
  <div id="header"><h1>Quản lý sản phẩm</h1></div>
  <div id="main">
    <h1>Thêm sản phẩm</h1>
    <form action="add_product.php" method="post" id="add_product_form" accept-charset="UTF-8">
      <label>Danh mục:</label>
      <select name="category_id">
      <?php foreach ($categories as $category) : ?>
        <option value="<?php echo (int)$category['categoryID']; ?>">
          <?php echo htmlspecialchars($category['categoryName'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>
        </option>
      <?php endforeach; ?>
      </select><br />

      <label>Mã:</label>
      <input type="text" name="code" /><br />

      <label>Tên:</label>
      <input type="text" name="name" /><br />

      <label>Giá:</label>
      <input type="text" name="price" /><br />

      <label>&nbsp;</label>
      <input type="submit" value="Thêm sản phẩm" /><br />
    </form>
    <p><a href="index.php">Xem danh sách sản phẩm</a></p>
  </div>
  <div id="footer"><p>&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p></div>
</div>
</body>
</html>