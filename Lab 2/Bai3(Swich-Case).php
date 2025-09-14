<?php
// ...existing code...
// Debug: tắt trên production nếu cần
error_reporting(E_ALL);
ini_set('display_errors', 1);

$so_raw = $_POST['so'] ?? '';
$chu = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $so_raw = trim($so_raw);

    if ($so_raw === '') {
        $error = 'Chưa nhập số';
    } elseif (!is_numeric($so_raw) || intval($so_raw) != floatval($so_raw)) {
        $error = 'Phải nhập số nguyên';
    } else {
        $n = (int)$so_raw;
        if ($n < 0 || $n > 9) {
            $error = 'Nhập số trong khoảng 0-9';
        } else {
            switch ($n) {
                case 0: $chu = "Không"; break;
                case 1: $chu = "Một"; break;
                case 2: $chu = "Hai"; break;
                case 3: $chu = "Ba"; break;
                case 4: $chu = "Bốn"; break;
                case 5: $chu = "Năm"; break;
                case 6: $chu = "Sáu"; break;
                case 7: $chu = "Bảy"; break;
                case 8: $chu = "Tám"; break;
                case 9: $chu = "Chín"; break;
                default: $chu = "Không hợp lệ"; break;
            }
        }
    }

    if ($error !== '') {
        $chu = $error; // hiển thị lỗi trong ô kết quả
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Xuất số thành chữ</title>
</head>
<body>
<form name="xuat_so" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8'); ?>" method="POST">
<table width="519" border="1">
<tr>
<td colspan="3" align="center"><strong>Đọc số</strong></td>
</tr>
<tr>
<td>Nhập số (0-9)</td>
<td width="69" rowspan="2" align="center" style="vertical-align: middle;">
    <input type="submit" name="submit" id="submit" value="Xuất" />
</td>
<td> Bằng chữ</td>
</tr>
<tr>
<td width="177">
<input type="text" name="so" id="so" value="<?php echo htmlspecialchars($so_raw, ENT_QUOTES, 'UTF-8'); ?>" />
</td>
<td width="232">
<input type="text" name="chu" id="chu" readonly="readonly" value="<?php echo htmlspecialchars($chu, ENT_QUOTES, 'UTF-8'); ?>" />
</td>
</tr>
</table>
</form>
</body>
</html>