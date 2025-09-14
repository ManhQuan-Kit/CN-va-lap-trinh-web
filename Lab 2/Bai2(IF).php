<?php
// Hiển thị lỗi (chỉ debug)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Khởi tạo biến
$a_raw = $_POST['a'] ?? '';
$b_raw = $_POST['b'] ?? '';
$a = null;
$b = null;
$nghiem = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Trim và chuẩn hoá input
    $a_raw = trim($a_raw);
    $b_raw = trim($b_raw);

    // Validate a
    if ($a_raw === '') {
        $errors[] = 'Chưa nhập hệ số a';
    } elseif (!is_numeric($a_raw)) {
        $errors[] = 'Hệ số a phải là số';
    } else {
        $a = (float)$a_raw;
    }

    // Validate b
    if ($b_raw === '') {
        $errors[] = 'Chưa nhập hệ số b';
    } elseif (!is_numeric($b_raw)) {
        $errors[] = 'Hệ số b phải là số';
    } else {
        $b = (float)$b_raw;
    }

    // Nếu không có lỗi thì giải phương trình
    if (empty($errors)) {
        if ($a == 0.0) {
            if ($b == 0.0) {
                $nghiem = "Phương trình có vô số nghiệm";
            } else {
                $nghiem = "Phương trình vô nghiệm";
            }
        } else {
            $x = -($b / $a);
            $x = round($x, 2);
            $nghiem = "x = $x";
        }
    } else {
        // Gom các lỗi để hiển thị (trong ô nghiệm)
        $nghiem = implode(' ; ', $errors);
    }
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<title>Giải phương trình bậc 1 - Phan2(IF)</title>
</head>
<body>
<!-- Yêu cầu: đặt tên cho form, method post, action là tên trang -->
<form name="giai_pt_bac1" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8'); ?>" method="post">
<table width="744" border="1">
<tr>
<td colspan="3" bgcolor="#336699" align="center"><strong>Giải phương trình bậc 1</strong></td>
</tr>
<tr>
<td width="120">Phương trình</td>
<td width="250">
<input name="a" type="text" value="<?php echo htmlspecialchars($a_raw, ENT_QUOTES, 'UTF-8'); ?>" /> X +
</td>
<td width="352">
<input name="b" type="text" value="<?php echo htmlspecialchars($b_raw, ENT_QUOTES, 'UTF-8'); ?>" /> = 0
</td>
</tr>
<tr>
<td colspan="3">
Nghiệm:
<!-- TextField nghiệm không cho phép nhập / chỉnh sửa -->
<input name="kq" type="text" readonly="readonly" value="<?php echo htmlspecialchars($nghiem, ENT_QUOTES, 'UTF-8'); ?>" />
</td>
</tr>
<tr>
<td colspan="3" align="center" valign="middle">
<!-- Button để thực hiện giải phương trình -->
<input type="submit" name="giai" value="Giải" />
</td>
</tr>
</table>
</form>
</body>
</html>