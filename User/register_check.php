<?php
/**
 * Created by PhpStorm.
 * User: 陈子峰
 * Date: 2019/5/8
 * Time: 20:23
 */
$firstname=filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
$lastname=filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
$phone=filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
$email=filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$password=filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$confirmPassword=filter_input(INPUT_POST, 'confirmPassword', FILTER_SANITIZE_STRING);
//$question = filter_input(INPUT_POST, 'question1', FILTER_SANITIZE_STRING);
//$answer = filter_input(INPUT_POST, 'answer1', FILTER_SANITIZE_STRING);

if(trim($firstname)==""){
    ?>
    <script>
        window.alert("Enter Firstname!");
        history.go(-1);
    </script>
    <?php
    die();
}elseif (trim($lastname)==""){
    ?>
    <script>
        window.alert("Enter Lastname!");
        history.go(-1);
    </script>
    <?php
    die();
}elseif (trim($phone)==""){
    ?>
    <script>
        window.alert("Enter Phone Number!");
        history.go(-1);
    </script>
    <?php
    die();
}elseif (trim($email)==""){
    ?>
    <script>
        window.alert("Enter Email Address!");
        history.go(-1);
    </script>
    <?php
    die();
}elseif (trim($password)=="") {
    ?>
    <script>
        window.alert("Enter Password!");
        history.go(-1);
    </script>
    <?php
    die();
}elseif ($password != $confirmPassword) {
    ?>
    <script>
        window.alert("The two passwords are not the same");
        history.go(-1);
    </script>
    <?php
    die();
}

include 'database.php';
$stmt=$pdo->query("SELECT * FROM user WHERE email='".$email."';");
$user=$stmt->fetch(PDO::FETCH_ASSOC);
if(!empty($user)){
    ?>
    <script>
        window.alert("This username had been registered, choose another one and try again!");
        location.href="index.php";
    </script>
    <?php
    die();
}else{
    $salt = "knock_knock_whos_there?";
    $password_hash = $password.$email.$salt;
    $password_hash = password_hash($password_hash, PASSWORD_DEFAULT);
    $insert="INSERT INTO user(password,email, phone, firstname, lastname) VALUES('".$password_hash."', '".$email."', '".$phone."', '".$firstname."', '".$lastname."');";
    $pdo->exec($insert);
    if($pdo->lastInsertId()!=null){
        echo '<script>alert("register success!"); window.location.href="index.php";</script>';
    }
    die();
}
?>