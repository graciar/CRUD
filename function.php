<?php
function quit() {
   header("Location: login.php", true, 303);
   die();
}
function home(){
   header("Location: home.php", true, 303);
   exit();  // important to stop script execution after redirect}
}
?>
