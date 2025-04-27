<?php
session_start();
session_unset(); // Xóa tất cả các biến session
session_destroy();
header('Location: login.php');
exit();
?>