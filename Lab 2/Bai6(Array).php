<?php
// Debug: bật khi dev; tắt trên production
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Hàm tạo mảng ngẫu nhiên độ dài $n
function tao_mang_ngau_nhien($n, $min = 0, $max = 20) {
    $n = max(0, (int)$n);
    $m = [];
    for ($i = 0; $i < $n; $i++) {
        $m[] = mt_rand($min, $max);
    }
    return $m;
}

// Hàm xuất mảng thành chuỗi
function xuat_mang($mang) {
    if (empty($mang)) return '';
    return implode(', ', $mang);
}

// Hàm tìm max
function tim_max($mang) {
    if (empty($mang)) return '';
    return max($mang);
}

// Hàm tìm min
function tim_min($mang) {
    if (empty($mang)) return '';
    return min($mang);
}

// Hàm tính tổng
function tinh_tong($mang) {
    if (empty($mang)) return 0;
    return array_sum($mang);
}

// Xử lý form
$so_phan_tu_raw = $_POST['so_phan_tu'] ?? '';
$so_phan_tu_raw = trim($so_phan_tu_raw);
$error = '';
$mang_so = [];
$mang_str = '';
$gtln = '';
$gtnn = '';
$tong = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($so_phan_tu_raw === '') {
        $error = 'Chưa nhập số phần tử.';
    } elseif (!ctype_digit($so_phan_tu_raw)) {
        $error = 'Số phần tử phải là số nguyên không âm.';
    } else {
        $n = (int)$so_phan_tu_raw;
        $max_allowed = 100; // giới hạn tránh sinh mảng quá lớn
        if ($n < 1) {
            $error = 'Số phần tử phải lớn hơn 0.';
        } elseif ($n > $max_allowed) {
            $error = "Giới hạn số phần tử là $max_allowed.";
        } else {
            $mang_so = tao_mang_ngau_nhien($n, 0, 20);
            $mang_str = xuat_mang($mang_so);
            $gtln = tim_max($mang_so);
            $gtnn = tim_min($mang_so);
            $tong = tinh_tong($mang_so);
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>PHÁT SINH MẢNG VÀ TÍNH TOÁN</title>
    <meta charset="utf-8">
    <style>
    *{ font-family: Tahoma; }
    table{ width: 420px; margin: 60px auto; }
    table th{ background: #66CCFF; padding: 10px; font-size: 18px; }
    input[type="text"]{ width: 100%; box-sizing: border-box; }
    .err{ color: red; font-weight: bold; }
    </style>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8'); ?>" method="POST">
        <table>
            <thead>
                <tr><th colspan="2">PHÁT SINH MẢNG VÀ TÍNH TOÁN</th></tr>
            </thead>
            <tbody>
                <tr>
                    <td>Nhập số phần tử:</td>
                    <td><input type="text" name="so_phan_tu" value="<?php echo htmlspecialchars($so_phan_tu_raw, ENT_QUOTES, 'UTF-8'); ?>"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Phát sinh và tính toán"></td>
                </tr>
                <?php if ($error !== ''): ?>
                <tr>
                    <td colspan="2" class="err"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
                <?php endif; ?>
                <tr>
                    <td>Mảng:</td>
                    <td><input type="text" name="mang_so" disabled="disabled" value="<?php echo htmlspecialchars($mang_str, ENT_QUOTES, 'UTF-8'); ?>"></td>
                </tr>
                <tr>
                    <td>GTLN (MAX) trong mảng:</td>
                    <td><input type="text" name="gtln" disabled="disabled" value="<?php echo htmlspecialchars($gtln, ENT_QUOTES, 'UTF-8'); ?>"></td>
                </tr>
                <tr>
                    <td>GTNN (MIN) trong mảng:</td>
                    <td><input type="text" name="ttnn" disabled="disabled" value="<?php echo htmlspecialchars($gtnn, ENT_QUOTES, 'UTF-8'); ?>"></td>
                </tr>
                <tr>
                    <td>Tổng mảng:</td>
                    <td><input type="text" name="tong" disabled="disabled" value="<?php echo htmlspecialchars($tong, ENT_QUOTES, 'UTF-8'); ?>"></td>
                </tr>
            </tbody>
        </table>
    </form>
</body>
</html>