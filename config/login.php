<?php 
require_once "config.php"; 

$emailErr = $passwordErr = '';
//$hashedPassword = SHA1($_POST['password']);
$hashedPassword = $_POST['password'];

if(empty(trim($_POST['email']))){
    $emailErr = "You have to write something here.";
    header('Location:../index.php?emailErr='.$emailErr);

  } elseif(empty(trim($_POST['password']))){
    $passwordErr = "You have to write something here.";
    header('Location:../index.php?passwordErr='.$passwordErr);
}

if(empty($emailErr) && empty($passwordErr)){
    $sql = "SELECT * FROM MANAGER WHERE mail=:email AND manager_password=:manager_password";
    
    $dataBinded=array(
        ':email'   => $_POST['email'],
        ':manager_password'=> $hashedPassword
    );


    $pre = $pdo->prepare($sql); 
    $pre->execute($dataBinded);
    $user = current($pre->fetchAll(PDO::FETCH_ASSOC));

    if(empty($user)){ 
        $loginErr = "Email or password incorrect";
        var_dump($_SESSION);
        header('Location:../index.php?loginErr'.$loginErr);

    }else{
        var_dump($_SESSION);
        $_SESSION['user'] = $user; // si on veut acceder à user_id on dit / $_SESSION['user']['user_id'] = $display / par exemple
        $_SESSION['login'] = true;
        $_SESSION['role'] = $user['manager_role']; // getting the role of the connected user (0 for none and 1 for admin)
    }
    header('Location:../index.php');
}
?>