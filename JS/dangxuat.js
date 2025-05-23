
function confirmLogout() {
    if (confirm("Bạn có chắc chắn muốn đăng xuất không?")) {
        window.location.href = '../logout.php';
    }
}
