<?php
include("class/clsdangnhap.php");
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập hệ thống quản lý kho</title>
    <link rel="stylesheet" href="CSS/dangnhap.css">
</head>
<body>
    <div class="login-container">
        <h2>ĐĂNG NHẬP HỆ THỐNG</h2>
        
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form method="POST" action="login.php">
            <div class="form-group">
                <label for="username">Tên đăng nhập</label>
                <input type="text" id="username" name="username" required>
            </div>
            
            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Đăng nhập</button>
           <button type="reset" class="btn-cancel">Hủy</button>
        </form>
    </div>
</body>
</html>