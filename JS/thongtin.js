$(document).ready(function(){
    // Kiểm tra thông tin người dùng khi blur ra khỏi trường input

    function ktemail() {
        let email = $("#email").val().trim();
        let btcq = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if(email.length == 0) {
            $("#errEmail").html("(Email không được để trống)<br>"); 
           // $("#email").focus();
            return false;
        } else if (!btcq.test(email)) {
            $("#errEmail").html("(Email không hợp lệ)<br>");
           // $("#email").focus();
            return false;
        } else {
            $("#errEmail").html("");
            return true;
        }
    }
    $("#email").blur(function(){
        ktemail();
    });

    function togglePassword() {
        let passwordField = document.getElementById("newPassword");
        if (passwordField.type === "newPassword") {
            passwordField.type = "text";
        } else {
            passwordField.type = "newPassword";
        }
    }
    
    function ktPassword() {
        let pw = $("input[name='newPassword']").val();
        let btcq = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*(),.?":{}|<>])[A-Za-z\d!@#$%^&*(),.?":{}|<>]{8,}$/;
        if (pw == "") {
            $("#errPW").html("Mật khẩu không được để trống");
            return false;
        } else if (pw.length < 8) {
            $("#errPW").html("Mật khẩu phải chứa ít nhất 8 ký tự");
            return false;
        }else if (!btcq.test(pw)) {
            $("#errPW").html("Mật khẩu phải gồm chữ hoa chữ thường số và kí tự đặt biệt");
            return false;
        } else {
            $("#errPW").html("");
            return true;
        }
    }
    
    $("input[name='newPassword']").blur(function () {
        ktPassword();
    });
    
    function ktSDT() {
        let sdt = $("#SDT").val();
        let btcq = /^(03|09|08|07)[0-9]{8}$/;
        if (sdt == "") {
            $("#errSDT").html("(Số điện thoại không được trống)<br>");
            return false;
        } else if (!btcq.test(sdt)) {
            $("#errSDT").html("(Số điện thoại có định dạng là 10 con số trong đó luôn bắt đầu 09, 03, 08, 07.)<br>");
            return false;
        } else {
            $("#errSDT").html("");
            return true;
        }
    }
    $("#SDT").blur(function(){
        ktSDT();
    });
    $("#btnsua").click(function(){
        if( !ktPassword()){
            alert("Định dạng mật khẩu không hợp lệ")
            return false;
        }
    })
    $("#btnthemnv").click(function(){
        if(!ktSDT() || !ktemail()){
            alert("Định dạng không hợp lệ")
            return false;
        }
    })

});
