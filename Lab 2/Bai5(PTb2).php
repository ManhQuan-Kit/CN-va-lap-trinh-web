<?php
// ...existing code...
// Debug: bật khi dev; tắt trên production
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Utility: giải phương trình bậc 1 (ax + b = 0)
function giai_pt_bac_1($a, $b) {
    $a = (float)$a;
    $b = (float)$b;
    if ($a == 0.0) {
        if ($b == 0.0) return "Phương trình có vô số nghiệm";
        return "Phương trình vô nghiệm";
    }
    $x = -$b / $a;
    return "x = " . round($x, 2);
}

// Giải phương trình bậc 2 ax^2 + bx + c = 0
function giai_pt_bac_2($a, $b, $c) {
    // Kiểm tra đầu vào số
    if (!is_numeric($a) || !is_numeric($b) || !is_numeric($c)) {
        return "Hệ số phải là số";
    }

    $a = (float)$a;
    $b = (float)$b;
    $c = (float)$c;

    // Nếu a == 0 => giảm về b*x + c = 0
    if ($a == 0.0) {
        return giai_pt_bac_1($b, $c);
    }

    $delta = $b * $b - 4 * $a * $c;

    if ($delta < 0) {
        return "Phương trình vô nghiệm";
    } elseif ($delta == 0.0) {
        $x = -$b / (2 * $a);
        return "Phương trình có nghiệm kép x1 = x2 = " . round($x, 2);
    } else {
        $sqrtDelta = sqrt($delta);
        $x1 = (-$b + $sqrtDelta) / (2 * $a);
        $x2 = (-$b - $sqrtDelta) / (2 * $a);
        return "Phương trình có 2 nghiệm phân biệt x1 = " . round($x1, 2) . ", x2 = " . round($x2, 2);
    }
}

// Xử lý form
$a_raw = $_POST['a'] ?? '';
$b_raw = $_POST['b'] ?? '';
$c_raw = $_POST['c'] ?? '';
$result = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Trim và validate bắt buộc
    $a_raw = trim($a_raw);
    $b_raw = trim($b_raw);
    $c_raw = trim($c_raw);

    if ($a_raw === '' || $b_raw === '' || $c_raw === '') {
        $result = "Phải nhập đủ hệ số a, b, c";
    } elseif (!is_numeric($a_raw) || !is_numeric($b_raw) || !is_numeric($c_raw)) {
        $result = "Hệ số phải là số";
    } else {
        $result = giai_pt_bac_2($a_raw, $b_raw, $c_raw);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Giải phương trình bậc 2</title>
</head>
<body>
<form name="giai_pt_bac2" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8'); ?>" method="post">
<table width="806" border="1">
<tr>
<td colspan="4" bgcolor="#336699"><strong>Giải phương trình bậc 2</strong></td>
</tr>
<tr>
<td width="83">Phương trình </td>
<td width="236">
<input name="a" type="text" value="<?php echo htmlspecialchars($a_raw, ENT_QUOTES, 'UTF-8'); ?>" /> X^2 +
</td>
<td width="218">
<input name="b" type="text" value="<?php echo htmlspecialchars($b_raw, ENT_QUOTES, 'UTF-8'); ?>" /> X +
</td>
<td width="241">
<input name="c" type="text" value="<?php echo htmlspecialchars($c_raw, ENT_QUOTES, 'UTF-8'); ?>" /> = 0
</td>
</tr>
<tr>
<td colspan="4">
Nghiệm
<input name="kq" type="text" id="kq" readonly="readonly" value="<?php echo htmlspecialchars($result, ENT_QUOTES, 'UTF-8'); ?>" style="width:90%;"/>
</td>
</tr>
<tr>
<td colspan="4" align="center" valign="middle"><input type="submit" name="giai" value="Giải" /></td>
</tr>
</table>
</form>
</body>
</html>