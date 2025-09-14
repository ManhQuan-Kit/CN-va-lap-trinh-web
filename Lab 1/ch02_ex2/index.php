<?php

    // Khởi tạo biến đầu file
    if (!isset($investment)) $investment = '';
    if (!isset($interest_rate)) $interest_rate = '';
    if (!isset($years)) $years = '';
    if (!isset($error_message)) $error_message = '';
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
    <?php if (!empty($error_message)) { ?>
        <p class="error"><?php echo $error_message; ?></p>
    <?php } // end if ?>
    <form action="display_results.php" method="post">

        <div id="data">
            <label>Số tiền đầu tư:</label>
            <input type="text" name="investment"
                value="<?php echo $investment; ?>"/><br />

            <label>Lãi suất hàng năm (%):</label>
            <input type="text" name="interest_rate"
                value="<?php echo $interest_rate; ?>"/><br /> 

            <label>Số năm gửi:</label>
            <input type="text" name="years"
                value="<?php echo $years; ?>"/><br />
        </div>

        <div id="buttons">
            <label>&nbsp;</label>
            <input type="submit" value="Tính toán"/><br />
        </div>

    </form>
    </div>
</body>
</html>