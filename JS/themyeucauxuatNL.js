
document.addEventListener("DOMContentLoaded", function () {
    const inputSP = document.getElementById("timNL");
    const goiY = document.getElementById("suggestions"); 
    
    // Sự kiện keyup để tìm kiếm sản phẩm
    inputSP.addEventListener("keyup", timNguyenLieu);

    // Ẩn gợi ý khi click ra ngoài
    document.addEventListener("click", function (event) {
        if (!inputSP.contains(event.target) && !goiY.contains(event.target)) {
            goiY.innerHTML = ''; // Ẩn gợi ý
            inputSP.value = ''; // Xóa nội dung thanh tìm kiếm
        }
    });
});

function timNguyenLieu() {
var keyword = document.getElementById("timNL").value;
if (keyword.trim().length === 0) {
    document.getElementById("suggestions").innerHTML = ''; // Xóa gợi ý nếu từ khóa rỗng
    return;
}

var xhr = new XMLHttpRequest();
xhr.open("GET", "../class/clstimNL.php?q=" + keyword, true);
xhr.onload = function () {
    if (xhr.status === 200) {
        var products = JSON.parse(this.responseText);
        var suggestions = document.getElementById("suggestions");
        suggestions.innerHTML = ''; // Xóa gợi ý cũ

        if (products.length > 0) {
            products.forEach(function(product) {
                var suggestion = document.createElement("div");
                suggestion.innerHTML = product.maNL + " - " + product.tenNguyenLieu;
                suggestion.onclick = function() {
                   
                    document.getElementById("timNL").value = product.tenNguyenLieu; // Điền tên sản phẩm vào ô tìm kiếm
                    document.getElementById("maNL").value = product.maNL; // Lưu mã sản phẩm
                    suggestions.innerHTML = ''; // Xóa gợi ý sau khi chọn
                    themNguyenLieuVaoBang(product);
                };
                suggestions.appendChild(suggestion);
            });
        } else {
            suggestions.innerHTML = "Không tìm thấy Nguyên liệu";
        }
    } else {
        console.error("Lỗi yêu cầu: " + xhr.status);
    }
};
xhr.send();
}

function themNguyenLieuVaoBang(product) {
var tableBody = document.getElementById("bangNguyenLieu").querySelector("tbody");

// Kiểm tra trùng mã sản phẩm
var rows = tableBody.querySelectorAll("tr");
for (var i = 0; i < rows.length; i++) {
    var maSPCell = rows[i].cells[0];
    if (maSPCell.textContent === product.maNL) {
        alert("Nguyên Liệu này đã được thêm vào bảng.");
        return;
    }
}

// Thêm dòng mới
var row = tableBody.insertRow();
var cellMaSP = row.insertCell(0);
var cellTenSP = row.insertCell(1);
var cellSoLuong = row.insertCell(2);
var cellXoa = row.insertCell(3);


cellMaSP.textContent = product.maNL;
cellTenSP.textContent = product.tenNguyenLieu;

var inputSL = document.createElement("input");
inputSL.type = "number";
inputSL.name = "soLuong[]";
inputSL.min = "1";
inputSL.value = "1";
inputSL.required = true;
cellSoLuong.appendChild(inputSL);
// Nút xoá
cellXoa.innerHTML = '<button type="button" class="nut-xoa" onclick="xoaDong(this)">X</button>';
}
function xoaDong(btn) {
const row = btn.closest("tr");
row.remove();
}

function kiemTraTruocKhiLuu(event) {
event.preventDefault(); // Ngừng gửi form mặc định

// Lấy bảng sản phẩm và kiểm tra số lượng sản phẩm
const table = document.getElementById("bangNguyenLieu").getElementsByTagName("tbody")[0];
const soLuongSanPham = table.getElementsByTagName("tr").length;

if (soLuongSanPham === 0) {
    alert("Vui lòng thêm ít nhất một nguyên liệu.");
    return;
}

// Thu thập các sản phẩm đã được chọn
const products = [];
const rows = table.getElementsByTagName("tr");
for (let i = 0; i < rows.length; i++) {
    const cells = rows[i].getElementsByTagName("td");
    const maNL = cells[0].textContent.trim(); // Mã sản phẩm
    const soLuong = cells[2].querySelector('input').value.trim();
    products.push({ maNL, soLuong });
}
const idNguoiDung = document.getElementById("idNguoiDung").value.trim(); // Ví dụ lấy từ một input ẩn
// Gửi dữ liệu qua AJAX
if (idNguoiDung === "") {
    alert("Không có ID người dùng.");
    return;
}
const formData = new FormData();
formData.append("idNguoiDung", idNguoiDung);
formData.append("products", JSON.stringify(products)); // Chuyển mảng sản phẩm thành chuỗi JSON
formData.forEach((value, key) => {
    console.log(key + ": " + value);
});
const xhr = new XMLHttpRequest();
xhr.open("POST", "../class/clsthemyeucauXuatNL.php", true);
xhr.onload = function() {
    console.log(xhr.responseText); // Log phản hồi để kiểm tra chi tiết lỗi
    if (xhr.status === 200) {
        if (xhr.responseText.trim() === 'success') {
            alert("Yêu cầu xuất Nguyên liệu đã được lưu!");
            window.location.href = 'guiyeucauxuatnguyenlieu.php'; // Chuyển hướng sau khi lưu thành công
        } else {
            alert("Có lỗi xảy ra khi lưu yêu cầu.");
        }
    } else {
        alert("Lỗi kết nối.");
    }
};
xhr.send(formData);
}
