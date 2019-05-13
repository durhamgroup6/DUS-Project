<?php
$email=filter_input(INPUT_POST, 'Email', FILTER_SANITIZE_STRING);
$password=filter_input(INPUT_POST, 'Password', FILTER_SANITIZE_STRING);

if(trim($email)==""){
    ?>
    <script>
        window.alert("Enter Email Address!");history.go(-1);
    </script>
    <?php
    die();
}elseif (trim($password)==""){
    ?>
    <script>
        window.alert("Enter password!");
        history.go(-1);
    </script>
    <?php
    die();
}

$salt = "knock_knock_whos_there?";
$password_hash = $password.$email.$salt;


include '../database/database.php';
$stmt = $pdo->query("SELECT password FROM user WHERE email='".$email."';");
$hash = $stmt->fetch(PDO::FETCH_ASSOC);
//echo $hash['password'];
if(empty($hash)){
    ?>
    <script>
        window.alert("Unregistered Email address! Register first please!")
        location.href="../../index.php";
    </script>
    <?php
    die();
}else {
    if (password_verify($password_hash, $hash['password'])) {
        session_start();
        $stmt = $pdo->query("SELECT * FROM user WHERE email='" . $email . "';");
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION["user"] = $user;
        //print_r($_SESSION);
        if ($_SESSION["user"]["Role"] == "admin") {
            header('Location: index_foradmin.php');
        } else {
            echo "<script>alert('login success！'); window.location.href='../../index.php';</script>";
        }

    }else{
        echo "<script>alert('login fail！'); history.go(-1);</script>";
    }
}
?>
