<?php
session_start();
if(isset($_SESSION["user"])){
    session_destroy();
    echo "<script>alert('logout success！');window.location.href='../../index.php'</script>";
}
?>