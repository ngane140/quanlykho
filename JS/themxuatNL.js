document.addEventListener("DOMContentLoaded", function () {
    const inputNL = document.getElementById("timNL");
    const goiY = document.getElementById("suggestions");
    
    // Sự kiện keyup để tìm kiếm nguyên liệu
    inputNL.addEventListener("keyup", timNguyenLieu);

    // Ẩn gợi ý khi click ra ngoài
    document.addEventListener("click", function (event) {
        if (!inputNL.contains(event.target) && !goiY.contains(event.target)) {
            goiY.innerHTML = '';
            inputNL.value = '';
        }
    });
});

function timNguyenLieu() {
    var keyword = document.getElementById("timNL").value;
    if (keyword.trim().length === 0) {
        document.getElementById("suggestions").innerHTML = '';
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open("GET", "../class/clstimNL.php?q=" + keyword, true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            var materials = JSON.parse(this.responseText);
            var suggestions = document.getElementById("suggestions");
            suggestions.innerHTML = '';

            if (materials.length > 0) {
                materials.forEach(function(material) {
                    var suggestion = document.createElement("div");
                    suggestion.innerHTML = material.maNL + " - " + material.tenNguyenLieu + 
                                         " (Tồn: " + material.soLuongTon + ")";
                    suggestion.onclick = function() {
                        document.getElementById("timNL").value = material.tenNguyenLieu;
                        document.getElementById("maNL").value = material.maNL;
                        suggestions.innerHTML = '';
                        themNguyenLieuVaoBang(material);
                    };
                    suggestions.appendChild(suggestion);
                });
            } else {
                suggestions.innerHTML = "Không tìm thấy nguyên liệu";
            }
        } else {
            console.error("Lỗi yêu cầu: " + xhr.status);
        }
    };
    xhr.send();
}

function themNguyenLieuVaoBang(material) {
    var tableBody = document.getElementById("bangNguyenLieu").querySelector("tbody");

    // Kiểm tra trùng mã nguyên liệu
    var rows = tableBody.querySelectorAll("tr");
    for (var i = 0; i < rows.length; i++) {
        var maNLCell = rows[i].cells[0];
        if (maNLCell.textContent === material.maNL) {
            alert("Nguyên liệu này đã được thêm vào bảng.");
            return;
        }
    }

    // Thêm dòng mới
    var row = tableBody.insertRow();
    var cellMaNL = row.insertCell(0);
    var cellTenNL = row.insertCell(1);
    var cellTonKho = row.insertCell(2);
    var cellSoLuongXuat = row.insertCell(3);
    var cellXoa = row.insertCell(4);

    cellMaNL.textContent = material.maNL;
    cellTenNL.textContent = material.tenNguyenLieu;
    cellTonKho.textContent = material.soLuongTon;

    var inputSL = document.createElement("input");
    inputSL.type = "number";
    inputSL.name = "soLuongXuat[]";
    inputSL.min = "1";
    inputSL.max = material.soLuongTon; // Giới hạn số lượng xuất <= tồn kho
    inputSL.value = "1";
    inputSL.required = true;
    cellSoLuongXuat.appendChild(inputSL);
    
    // Nút xoá
    cellXoa.innerHTML = '<button type="button" class="nut-xoa" onclick="xoaDong(this)">X</button>';
}

function xoaDong(btn) {
    const row = btn.closest("tr");
    row.remove();
}

function kiemTraTruocKhiXuat(event) {
    event.preventDefault();

    const table = document.getElementById("bangNguyenLieu").getElementsByTagName("tbody")[0];
    const soLuongNguyenLieu = table.getElementsByTagName("tr").length;
    
    if (soLuongNguyenLieu === 0) {
        alert("Vui lòng thêm ít nhất một nguyên liệu.");
        return;
    }

    // Thu thập các nguyên liệu đã được chọn
    const materials = [];
    const rows = table.getElementsByTagName("tr");
    let isValid = true;
    
    for (let i = 0; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName("td");
        const maNL = cells[0].textContent.trim();
        const tonKho = parseInt(cells[2].textContent);
        const soLuongXuat = parseInt(cells[3].querySelector('input').value);
        
        if (soLuongXuat > tonKho) {
            alert(`Số lượng xuất vượt quá tồn kho cho nguyên liệu ${maNL}`);
            isValid = false;
            break;
        }
        
        materials.push({ 
            maNL: maNL, 
            soLuongXuat: soLuongXuat 
        });
    }

    if (!isValid) return;

    const idNguoiDung = document.getElementById("idNguoiDung").value.trim();
    if (idNguoiDung === "") {
        alert("Không có ID người dùng.");
        return;
    }

    const formData = new FormData();
    formData.append("idNguoiDung", idNguoiDung);
    formData.append("materials", JSON.stringify(materials));
    
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../class/clsthemyeucauXuatNL.php", true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            if (xhr.responseText.trim() === 'success') {
                alert("Yêu cầu xuất nguyên liệu đã được lưu!");
                window.location.href = 'yeucauXuatNL.php';
            } else {
                alert("Có lỗi xảy ra: " + xhr.responseText);
            }
        } else {
            alert("Lỗi kết nối.");
        }
    };
    xhr.send(formData);
}