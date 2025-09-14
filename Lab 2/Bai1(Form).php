<?php
// Hiệu chỉnh cho debug (bỏ trên production nếu cần)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Khởi tạo
$ten = '';
$ten_safe = '';
$xuat_ten = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ten = trim($_POST['ten'] ?? '');
    $ten_safe = htmlspecialchars($ten, ENT_QUOTES, 'UTF-8');
    if ($ten_safe !== '') {
        $xuat_ten = "Chào bạn " . $ten_safe;
    } else {
        $xuat_ten = "Bạn chưa nhập tên.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Chào các bạn</title>
</head>
<body>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
<table width="271" border="1">
<tr>
<td colspan="2" bgcolor="#336699" align="center"><strong>In lời chào</strong></td>
</tr>
<tr>
<td width="91">Họ tên bạn</td>
<td width="164">
<input type="text" name="ten" id="chao3" value="<?php echo $ten_safe; ?>" />
</td>
</tr>
<tr>
<td colspan="2">
<label><?php echo $xuat_ten; ?></label>
</td>
</tr>
<tr>
<td colspan="2" align="center" valign="middle">
<input type="submit" name="chao" id="chao" value="Xuất" />
</td>
</tr>
</table>
</form>
</body>
</html>