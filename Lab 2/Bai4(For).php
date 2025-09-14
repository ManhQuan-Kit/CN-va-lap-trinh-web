<?php
// ...existing code...
// Debug: bật khi dev; tắt trên production
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Nhận dữ liệu thô
$so_dau_raw = $_POST['so_dau'] ?? '';
$so_cuoi_raw = $_POST['so_cuoi'] ?? '';

// Khởi tạo kết quả
$tong = '';
$tich = '';
$tong_chan = '';
$tong_le = '';
$error = '';

// Xử lý khi submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $so_dau_raw = trim($so_dau_raw);
    $so_cuoi_raw = trim($so_cuoi_raw);

    // Validate: bắt buộc và phải là số nguyên
    if ($so_dau_raw === '' || $so_cuoi_raw === '') {
        $error = 'Phải nhập cả số bắt đầu và số kết thúc.';
    } elseif (filter_var($so_dau_raw, FILTER_VALIDATE_INT) === false || filter_var($so_cuoi_raw, FILTER_VALIDATE_INT) === false) {
        $error = 'Cần nhập số nguyên hợp lệ.';
    } else {
        $so_dau = (int)$so_dau_raw;
        $so_cuoi = (int)$so_cuoi_raw;

        // Nếu so_dau > so_cuoi thì đổi chỗ (hoặc bạn có thể thông báo lỗi)
        if ($so_dau > $so_cuoi) {
            // Hoán vị để đảm bảo for chạy đúng
            $tmp = $so_dau;
            $so_dau = $so_cuoi;
            $so_cuoi = $tmp;
        }

        // Tính toán
        $sum = 0;
        $sum_even = 0;
        $sum_odd = 0;

        $range_length = $so_cuoi - $so_dau + 1;

        // Tránh tính tích quá lớn hoặc tốn thời gian: giới hạn độ dài dải số
        $compute_product = true;
        $max_range_for_product = 30; // nếu cần thay đổi, giảm để an toàn hơn
        if ($range_length > $max_range_for_product) {
            $compute_product = false;
            $product_result = 'Quá lớn để tính';
        } else {
            $product_result = 1;
        }

        for ($i = $so_dau; $i <= $so_cuoi; $i++) {
            $sum += $i;
            if ($i % 2 == 0) $sum_even += $i;
            else $sum_odd += $i;

            if ($compute_product) {
                $product_result *= $i;
            }
        }

        // Gán kết quả (định dạng)
        $tong = (string)$sum;
        $tong_chan = (string)$sum_even;
        $tong_le = (string)$sum_odd;
        $tich = $compute_product ? (string)$product_result : $product_result;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Tính tổng / tích - For</title>
</head>
<body>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8'); ?>" method="post">
<table width="728" border="1">
<tr>
<td width="122">&nbsp;</td>
<td width="76">Số bắt đầu</td>
<td width="169">
<input type="text" name="so_dau" id="so_dau" value="<?php echo htmlspecialchars($so_dau_raw, ENT_QUOTES, 'UTF-8'); ?>"/>
</td>
<td width="152">Số kết thúc</td>
<td width="175">
<input type="text" name="so_cuoi" id="so_cuoi" value="<?php echo htmlspecialchars($so_cuoi_raw, ENT_QUOTES, 'UTF-8'); ?>"/>
</td>
</tr>

<tr>
<td colspan="5">Kết quả
<?php if ($error !== ''): ?>
    &nbsp; <span style="color:red;"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></span>
<?php endif; ?>
</td>
</tr>

<tr>
<td>Tổng các số</td>
<td colspan="4">
<input type="text" name="tong" id="tong" readonly="readonly" value="<?php echo htmlspecialchars($tong, ENT_QUOTES, 'UTF-8'); ?>"/>
</td>
</tr>

<tr>
<td>Tích các số</td>
<td colspan="4">
<input type="text" name="tich" id="tich" readonly="readonly" value="<?php echo htmlspecialchars($tich, ENT_QUOTES, 'UTF-8'); ?>"/>
</td>
</tr>

<tr>
<td>Tổng các số chẵn</td>
<td colspan="4">
<input type="text" name="tong_chan" id="tong_chan" readonly="readonly" value="<?php echo htmlspecialchars($tong_chan, ENT_QUOTES, 'UTF-8'); ?>"/>
</td>
</tr>

<tr>
<td>Tổng các số lẻ</td>
<td colspan="4">
<input type="text" name="tong_le" id="tong_le" readonly="readonly" value="<?php echo htmlspecialchars($tong_le, ENT_QUOTES, 'UTF-8'); ?>"/>
</td>
</tr>

<tr>
<td colspan="5"><input type="submit" name="button" id="button" value="Tính toán" /></td>
</tr>
</table>
</form>
</body>
</html>