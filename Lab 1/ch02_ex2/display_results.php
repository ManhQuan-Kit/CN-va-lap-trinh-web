<?php
    
    // Lấy dữ liệu từ form
    $investment = $_POST['investment'];
    $interest_rate = $_POST['interest_rate'];
    $years = $_POST['years'];

    // Kiểm tra hợp lệ số tiền đầu tư
    if ( empty($investment) ) {
        $error_message = 'Vui lòng nhập số tiền đầu tư.'; }
    else if ( !is_numeric($investment) )  {
        $error_message = 'Số tiền đầu tư phải là số hợp lệ.'; }
    else if ( $investment <= 0 ) {
        $error_message = 'Số tiền đầu tư phải lớn hơn 0.'; }

    // Kiểm tra hợp lệ lãi suất
    else if ( empty($interest_rate) ) {
        $error_message = 'Vui lòng nhập lãi suất hàng năm.'; }
    else if ( !is_numeric($interest_rate) )  {
        $error_message = 'Lãi suất phải là số hợp lệ.'; }
    else if ( $interest_rate <= 0 ) {
        $error_message = 'Lãi suất phải lớn hơn 0.'; }

    // Không có lỗi
    else {
        $error_message = ''; }

    // Nếu có lỗi, quay về trang nhập
    if ($error_message != '') {
        include('index.php');
        exit();
    }

    // Tính giá trị tương lai theo công thức lãi kép
    $future_value = $investment * pow(1 + $interest_rate * 0.01, $years);

    // Định dạng tiền và phần trăm
    $investment_f = number_format($investment, 2).' VNĐ';
    $yearly_rate_f = $interest_rate.'%';
    $future_value_f = number_format($future_value, 2).' VNĐ';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Máy tính giá trị tương lai</title>
    <link rel="stylesheet" type="text/css" href="main.css"/>
</head>
<body>
    <div id="content">
        <h1>Máy tính giá trị tương lai</h1>

        <label>Số tiền đầu tư:</label>
        <span><?php echo $investment_f; ?></span><br />

        <label>Lãi suất hàng năm:</label>
        <span><?php echo $yearly_rate_f; ?></span><br />

        <label>Số năm gửi:</label>
        <span><?php echo $years; ?></span><br />

        <label>Giá trị tương lai:</label>
        <span><?php echo $future_value_f; ?></span><br />
    </div>
</body>
</html>