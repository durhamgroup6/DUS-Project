<?php
include_once("../database.php");
$token = stripslashes(trim($_GET['token']));
$email = stripslashes(trim($_GET['email']));

$sql = "select * from user where Email='$email'";

$query = $pdo->query($sql);
$row = $query->fetch(PDO::FETCH_ASSOC);
if($row){
$mt = md5($row['UserID'].$row['Email'].$row['Password']);
if($mt==$token){
if(time()-$row['resetpasswordtime']>24*60*60){
  echo 'This link has expired！';
}else {
    if (isset($_POST['submit']) && $_POST['submit'] == 'reset') {
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $confirmPassword = filter_input(INPUT_POST, 'confirmPassword', FILTER_SANITIZE_STRING);
        if (trim($password) == "") {
            ?>
            <script>
                window.alert("Enter Password!");
                history.go(-1);
            </script>
            <?php
            die();
        } elseif ($password != $confirmPassword) {
            ?>
            <script>
                window.alert("The two passwords are not the same");
                history.go(-1);
            </script>
            <?php
            die();
        }
        $salt = "knock_knock_whos_there?";
        $password_hash = $password . $email . $salt;
        $password_hash = password_hash($password_hash, PASSWORD_DEFAULT);
        $sql = "Update user set Password = '$password_hash' where Email = '$email'";
        $pdo->query($sql);
        echo '<script>alert("reset success!"); window.location.href="../index.php";</script>';
    }
}
}else{
 echo 'invalid link '.$mt.' '.$token;
}
}else{
  echo 'wrong link！';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
</head>
<body>
<div class="wrapper">
    <div class="header">
        <h1>Reset Password</h1>
    </div>
    <div class="nav">
    </div>
    <form class="" action="" method="post">
        <div class="agileits_w3layouts_user agileits_w3layouts_user_agileits">
            <img src="../images/pw.png" width="22" height="22">
            <input type="password" name="password" placeholder="Password" required="">
        </div>
        <div class="agileits_w3layouts_user">
            <img src="../images/confirm.png" width="22" height="22">
            <input type="password" name="confirmPassword" placeholder="Confirm Password" required="">
        </div>

        <button type="submit" name="submit" value="reset">Reset</button>
    </form>
</div>
</body>
</html>

