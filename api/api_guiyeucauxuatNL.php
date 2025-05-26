<?php
require_once '../class/clsdsguiycxuatnl.php';
header('Content-Type: application/json');
$p = new qlykho();
$p->xuatds("select * from yeucauxuatnguyenlieu ORDER BY trangThai ASC, ngayYeuCau DESC");
?>