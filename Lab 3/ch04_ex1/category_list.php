<?php
// filepath: d:\Xampp\htdocs\ex_starts\ch04_ex1\category_list.php
require_once('database.php');
// Lấy danh sách danh mục
$categories = $db->query('SELECT * FROM categories ORDER BY categoryID')->fetchAll();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="utf-8" />
  <title>Quản lý danh mục</title>
  <link rel="stylesheet" type="text/css" href="main.css" />
</head>
<body>
<div id="page">
  <div id="header"><h1>Quản lý danh mục</h1></div>
  <div id="main">
    <h1>Danh sách danh mục</h1>
    <table>
      <tr><th>Tên</th><th>&nbsp;</th></tr>
      <?php foreach ($categories as $c) : ?>
      <tr>
        <td><?php echo htmlspecialchars($c['categoryName'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></td>
        <td>
          <a href="edit_category_form.php?category_id=<?php echo (int)$c['categoryID']; ?>">Sửa</a>
          <form action="delete_category.php" method="post" style="display:inline" accept-charset="UTF-8">
            <input type="hidden" name="category_id" value="<?php echo (int)$c['categoryID']; ?>" />
            <input type="submit" value="Xóa" onclick="return confirm('Bạn có chắc muốn xóa danh mục này?');" />
          </form>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>

    <h2>Thêm danh mục</h2>
    <form action="add_category.php" method="post" accept-charset="UTF-8">
      <label>Tên danh mục:</label>
      <input type="text" name="name" />
      <input type="submit" value="Thêm" />
    </form>

    <p><a href="index.php">Danh sách sản phẩm</a></p>
  </div>
  <div id="footer"><p>&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p></div>
</div>
</body>
</html>