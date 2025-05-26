
 var message = "<?php echo $message; ?>";

 // Nếu có thông báo, hiển thị và tự động ẩn sau 3 giây
 if (message) {
     var messageElement = document.querySelector('.message');
     
     if (messageElement) {
         // Đặt thời gian để ẩn thông báo sau 3 giây
         setTimeout(function() {
             messageElement.style.display = 'none';
         }, 5000); 
     }
 }