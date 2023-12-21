<?php
require_once "config.php";

$emailErr = $passwordErr = '';

if (empty(trim($_POST['email']))) {
    $emailErr = "You have to write something here.";
    header('Location:../index.php?emailErr=' . $emailErr);
    exit();
} elseif (empty(trim($_POST['password']))) {
    $passwordErr = "You have to write something here.";
    header('Location:../index.php?passwordErr=' . $passwordErr);
    exit();
}

$sql = "SELECT manager_password FROM MANAGER WHERE mail=:email";
$dataBinded = array(':email' => $_POST['email']);

$pre = $pdo->prepare($sql);
$pre->execute($dataBinded);
$result = $pre->fetch(PDO::FETCH_ASSOC);
$hashedPasswordFromDB = $result['manager_password'];

// Password verificaiton
$givenPassword = $_POST['password'];
var_dump($givenPassword);
var_dump($hashedPasswordFromDB);

if (password_verify($givenPassword, $hashedPasswordFromDB)) {
    // Correct password
    var_dump("i'm here");
    $sql = "SELECT * FROM MANAGER WHERE mail=:email";

    $dataBinded = array(':email' => $_POST['email']);

    $pre = $pdo->prepare($sql);
    $pre->execute($dataBinded);
    $user = current($pre->fetchAll(PDO::FETCH_ASSOC));

    if (empty($user)) {
        $loginErr = "Email or password incorrect";
        header('Location:../index.php?loginErr=' . $loginErr);
        exit();
    } else {
        $_SESSION['user'] = $user;
        $_SESSION['login'] = true;
        $_SESSION['role'] = $user['manager_role'];
        header('Location:../index.php');
        exit();
    }
} else {
    // Incorrect password
    $loginErr = "Email or password incorrect";
    header('Location:../index.php?loginErr=' . $loginErr);
    exit();
}
?>
