<?php
// filepath: d:\Xampp\htdocs\ex_starts\ch04_ex1\index.php
// ...existing code...
require_once('database.php');

// Get category ID (int)
$category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
if ($category_id === null || $category_id === false) {
    $category_id = 1;
}

// Get name for current category
$stmt = $db->prepare("SELECT * FROM categories WHERE categoryID = :id");
$stmt->execute([':id' => $category_id]);
$category = $stmt->fetch();
$category_name = $category ? $category['categoryName'] : 'Không rõ';

// Get all categories
$categories = $db->query('SELECT * FROM categories ORDER BY categoryID')->fetchAll();

// Get products for selected category
$stmt = $db->prepare("SELECT * FROM products WHERE categoryID = :id ORDER BY productID");
$stmt->execute([':id' => $category_id]);
$products = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8" />
    <title>Quản lý sản phẩm</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>
<body>
<div id="page">
  <div id="header"><h1>Quản lý sản phẩm</h1></div>
  <div id="main">
    <h1>Danh sách sản phẩm</h1>
    <div id="sidebar">
      <h2>Danh mục</h2>
      <ul class="nav">
      <?php foreach ($categories as $c) : ?>
        <li><a href="?category_id=<?php echo (int)$c['categoryID']; ?>">
          <?php echo htmlspecialchars($c['categoryName'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>
        </a></li>
      <?php endforeach; ?>
      </ul>
    </div>

    <div id="content">
      <h2><?php echo htmlspecialchars($category_name, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></h2>
      <table>
        <tr><th>Mã</th><th>Tên</th><th class="right">Giá</th><th>&nbsp;</th></tr>
        <?php foreach ($products as $p) : ?>
        <tr>
          <td><?php echo htmlspecialchars($p['productCode']); ?></td>
          <td><?php echo htmlspecialchars($p['productName']); ?></td>
          <td class="right"><?php echo htmlspecialchars($p['listPrice']); ?></td>
          <td>
            <form action="delete_product.php" method="post" accept-charset="UTF-8">
              <input type="hidden" name="product_id" value="<?php echo (int)$p['productID']; ?>" />
              <input type="hidden" name="category_id" value="<?php echo (int)$p['categoryID']; ?>" />
              <input type="submit" value="Xóa" />
            </form>
          </td>
        </tr>
        <?php endforeach; ?>
      </table>
      <p><a href="add_product_form.php">Thêm sản phẩm</a></p>
      <p><a href="category_list.php">Quản lý danh mục</a></p>
    </div>
  </div>

  <div id="footer">
    <p>&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p>
  </div>
</div>
</body>
</html>