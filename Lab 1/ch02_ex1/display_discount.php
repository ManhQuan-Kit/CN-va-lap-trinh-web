<?php
header("Content-Type: text/html; charset=UTF-8");

// Lấy dữ liệu từ form HTML
$product_description = isset($_POST['product_description']) ? $_POST['product_description'] : '';
$list_price = isset($_POST['list_price']) ? (float)$_POST['list_price'] : 0;
$discount_percent = isset($_POST['discount_percent']) ? (float)$_POST['discount_percent'] : 0;

// Tính toán giá chiết khấu
$discount_amount = $list_price * $discount_percent * 0.01;
$discount_price = $list_price - $discount_amount;

// Định dạng dữ liệu để hiển thị
$list_price_formatted = "₫" . number_format($list_price, );
$discount_percent_formatted = $discount_percent . "%";
$discount_formatted = "₫" . number_format($discount_amount, );
$discount_price_formatted = "₫" . number_format($discount_price, );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8" />
    <title>Máy tính chiết khấu sản phẩm</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>
<body>
    <div id="content">
        <h1>Máy tính chiết khấu sản phẩm</h1>

        <label>Mô tả sản phẩm:</label>
        <span><?php echo htmlspecialchars($product_description); ?></span><br />

        <label>Giá niêm yết:</label>
        <span><?php echo $list_price_formatted; ?></span><br />

        <label>Phần trăm chiết khấu:</label>
        <span><?php echo $discount_percent_formatted; ?></span><br />

        <label>Số tiền chiết khấu:</label>
        <span><?php echo $discount_formatted; ?></span><br />

        <label>Giá sau chiết khấu:</label>
        <span><?php echo $discount_price_formatted; ?></span><br />

        <p>&nbsp;</p>
    </div>
</body>
</html>