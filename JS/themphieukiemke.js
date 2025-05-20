// Gắn sự kiện sau khi DOM sẵn sàng
document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById("timNguyenLieu");
    const goiY = document.getElementById("goiYNguyenLieu"); 
    input.addEventListener("keyup", timNguyenLieu);
    // Ẩn gợi ý khi click ra ngoài
    document.addEventListener("click", function (event) {
        if (!input.contains(event.target) && !goiY.contains(event.target)) {
            goiY.innerHTML = "";
            input.value = ""; 
        }
    });
    const nutLuuPhieu = document.getElementById("luuPhieu");
    if (nutLuuPhieu) {
        nutLuuPhieu.addEventListener("click", function (event) {
            event.preventDefault();
            const tbody = document.getElementById("tbodyNguyenLieu");
            const soDong = tbody.querySelectorAll("tr").length;

            if (soDong === 0) {
                alert("Vui lòng thêm ít nhất một nguyên liệu ");
                return;
            }
             if (!kiemTraSoLuongThucTe()) {
        return; 
    }
            document.querySelector("form").submit();
        });
        }
});

function timNguyenLieu() {
    const input = document.getElementById("timNguyenLieu").value.toLowerCase();
    const goiY = document.getElementById("goiYNguyenLieu");
    goiY.innerHTML = "";

    if (input.length === 0) return;
      // Duy nhất mỗi maNL
      const dsNguyenLieuDuyNhat = Array();

      nguyenLieus.forEach(nl => {
          // Nếu chưa có nguyên liệu này trong danh sách duy nhất, thì thêm vào
          if (!dsNguyenLieuDuyNhat.some(item => item.maNL === nl.maNL)) {
              dsNguyenLieuDuyNhat.push(nl);
          }
      });
  
      const ketQua = dsNguyenLieuDuyNhat.filter(nl =>
        nl.maNL.toLowerCase().includes(input) ||
        nl.tenNguyenLieu.toLowerCase().includes(input)
    );

    ketQua.forEach(nl => {
        const div = document.createElement("div");
        div.textContent = `${nl.maNL} - ${nl.tenNguyenLieu}`;
        div.onclick = () => chonNguyenLieu(nl);
        div.style.cursor = "pointer";
        div.style.padding = "5px";
        div.style.border = "1px solid #ccc";
        goiY.appendChild(div);
    });
}
function chonNguyenLieu(nl) {
    const tbody = document.getElementById("tbodyNguyenLieu");

    // Lấy tất cả các lô có cùng maNL (tức là các HSD khác nhau)
    const cacLoNguyenLieu = nguyenLieus.filter(item => item.maNL === nl.maNL);

    cacLoNguyenLieu.forEach(lo => {
        // Kiểm tra xem mã nguyên liệu + ngày nhập (HSD) đã có chưa
        const daTonTai = Array.from(tbody.querySelectorAll('input[name="maNL[]"]'))
            .some((input, idx) => {
                const hsdInput = tbody.querySelectorAll('input[name="ngayNhap[]"]')[idx];
                return input.value === lo.maNL && hsdInput.value === lo.ngayNhap;
            });

        if (daTonTai) {
            return;
        }

        // Tạo dòng mới cho từng lô nguyên liệu
        const row = document.createElement("tr");
        row.innerHTML = `
            <td><input type="text" name="maNL[]" class="form-control" value="${lo.maNL}" readonly></td>
            <td><input type="text" class="form-control" value="${lo.tenNguyenLieu}" readonly></td>
            <td><input type="number" name="soLuongTon[]" class="form-control" value="${lo.soLuongTon}" readonly></td>
            <td><input type="number" name="soLuongThucTe[]" class="form-control" oninput="capNhatChenhLech(this)" required min="0" step="0.1"></td>
            <td><input type="number" class="form-control soLuongChenhLech" readonly></td>
            <td><input type="text" name="ngayNhap[]" class="form-control" value="${lo.ngayNhap}" readonly></td>
            <td><button type="button" class="nut-xoa" onclick="xoaDong(this)">X</button></td>
        `;
        tbody.appendChild(row);
    });

    // Xóa gợi ý và input tìm kiếm
    document.getElementById("goiYNguyenLieu").innerHTML = "";
    document.getElementById("timNguyenLieu").value = "";
}
function kiemTraSoLuongThucTe() {
    const inputs = document.querySelectorAll('input[name="soLuongThucTe[]"]');
    for (let input of inputs) {
        if (input.value === '' || isNaN(input.value) || parseFloat(input.value) < 0) {
            alert("Vui lòng nhập số lượng thực tế hợp lệ (không để trống và không âm).");
            input.focus();
            return false;
        }
    }
    return true;
}

function capNhatChenhLech(input) {
    const row = input.closest("tr");
    const slTon = parseFloat(row.querySelector('input[name="soLuongTon[]"]').value) || 0;
    const slThucTe = parseFloat(input.value) || 0;
    row.querySelector(".soLuongChenhLech").value = slThucTe - slTon;
}
function xoaDong(btn) {
    const row = btn.closest("tr");
    row.remove();
}