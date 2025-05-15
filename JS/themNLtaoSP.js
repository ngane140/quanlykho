
    function addNguyenLieu() {
    const container = document.getElementById('nguyenlieu-container');
    const row = document.querySelector('.nguyenlieu-row').cloneNode(true);

    // Xóa giá trị các trường input và select trong row mới
    row.querySelectorAll('input').forEach(input => input.value = '');
    row.querySelector('select').selectedIndex = 0;

    // Gắn lại sự kiện onchange cho select nguyên liệu
    row.querySelector('select').setAttribute("onchange", "capNhatDonViTinh(this)");

    // Cập nhật đơn vị tính và min/step khi thêm row mới (dữ liệu select về mặc định)
    const selectElement = row.querySelector('select');
    capNhatDonViTinh(selectElement);

    container.appendChild(row);
}

function removeRow(button) {
    const container = document.getElementById('nguyenlieu-container');
    if (container.children.length > 1) {
        button.parentElement.remove();
    } else {
        alert("Phải có ít nhất một nguyên liệu.");
    }
}

// Cập nhật đơn vị tính và min, step của số lượng khi chọn nguyên liệu
function capNhatDonViTinh(selectElement) {
    const dvt = selectElement.options[selectElement.selectedIndex].getAttribute('data-dvt') || '';
     const row = selectElement.closest('.nguyenlieu-row');
    const donViTinhInput = row.querySelector('input[name="donViTinhNL[]"]');
    const soLuongInput = row.querySelector('input[name="soLuongNL[]"]');

    donViTinhInput.value = dvt;

    // Điều chỉnh min và step của input số lượng theo đơn vị tính
   if (dvt.toLowerCase() === 'cái') {
        soLuongInput.min = 1;
        soLuongInput.step = 1;
    } else {
        soLuongInput.min = 0.001;
        soLuongInput.step = 0.001;
    }
    
}
