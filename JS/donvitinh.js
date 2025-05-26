function goiYDonViTinh() {
    const input = document.getElementById("donViTinh");
    const value = input.value.toLowerCase();
    const loi = document.getElementById("donViTinhLoi"); 
    let ketQua = "";

    if (value === "c") ketQua = "Cái";
    else if (value === "l") ketQua = "Lít";
    else if (value === "g") ketQua = "Gr";
    else if (value === "k") ketQua = "Kg";

    if (ketQua) {
        input.value = ketQua;
        loi.textContent = ""; 
    } else if (value === "") {
        loi.textContent = ""; 
    } else {
           input.value = "";
        loi.textContent = "Đơn vị tính chỉ được nhập: Cái, Lít, Gr, Kg";
    }
}