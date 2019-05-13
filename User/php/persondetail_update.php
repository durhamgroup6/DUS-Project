<?php
session_start();
$email = $_SESSION['user']['Email'];
if (isset($_POST['submit']) && $_POST['submit'] == "update") {
    $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
    $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    if (trim($firstname) == "") {
        ?>
        <script>
            window.alert("Enter Firstname!");
            history.go(-1);
        </script>
        <?php
        die();
    } elseif (trim($lastname) == "") {
        ?>
        <script>
            window.alert("Enter Lastname!");
            history.go(-1);
        </script>
        <?php
        die();
    } elseif (trim($phone) == "") {
        ?>
        <script>
            window.alert("Enter Phone Number!");
            history.go(-1);
        </script>
        <?php
        die();
    } elseif (trim($password) == "") {
        ?>
        <script>
            window.alert("Enter Password!");
            history.go(-1);
        </script>
        <?php
        die();
    }
    include '../database/database.php';
    $stmt = $pdo->query("SELECT * FROM user WHERE email='$email'");
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if($user['Password']!=$password) {
        $salt = "knock_knock_whos_there?";
        $password_hash = $password . $email . $salt;
        $password_hash = password_hash($password_hash, PASSWORD_DEFAULT);
        $sql = "Update user set Firstname='$firstname',Lastname='$lastname',Phone='$phone',Password = '$password_hash' where Email = '$email'";
    }else{
        $sql = "Update user set Firstname='$firstname',Lastname='$lastname',Phone='$phone',Password = '$password' where Email = '$email'";
    }
    $pdo->query($sql);
    $stmt = $pdo->query("SELECT * FROM user WHERE email='" . $email . "';");
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $_SESSION["user"] = $user;
    echo '<script>alert("update success!");history.go(-1)</script>';

}
?>