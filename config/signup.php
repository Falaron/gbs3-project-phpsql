<?php 
require_once "config.php";

$username = $email = $password = $confirmPassword = "";
$usernameErr = $emailErr = $passwordErr = $confirmPasswordErr = "";
$role = 0;

// CHECKING IF USERNAME POST IS NOT EMPTY
if(empty(trim($_POST['username']))){
  $usernameErr = "You have to write something here.";
  header('Location:../signup.php?firstNameErr='.$firstNameErr);
} 


// CHECKING ALREADY USED EMAIL

if(empty(trim($_POST["email"]))){ // empty() function checks if the post is empty & trim() remove empty spaces in front or at the end 
  $emailErr = "You have to write something here.";
  header('Location:../signup.php?emailErr='.$emailErr); // display error thanks to span tag in form 

} else{
  $sql = "SELECT * FROM MANAGER WHERE mail=:email";

  $dataBinded=array(
    ':email'   => $_POST['email'],
  );
      
  $pre = $pdo->prepare($sql);
  $pre->execute($dataBinded);
  $user = current($pre->fetchAll(PDO::FETCH_ASSOC));

  if(!empty($user)){
    $emailErr = 'Email already in use'; // counts the number of existing user with this email
    header('Location:../signup.php?emailErr='.$emailErr);

  } else{
    $email = trim($_POST["email"]); // removing empty spaces to have a correct username
  }
}

// CHECKING PASSWORD 

// length
if(empty(trim($_POST["password"]))){
  $passwordErr = "You have to write something here.";
  header('Location:../signup.php?passwordErr='.$passwordErr); // span tag in html

} elseif(strlen(trim($_POST["password"])) < 8){ // managing password length with strlen()
  $passwordErr = "Password must have atleast 8 characters.";
  header('Location:../signup.php?passwordErr='.$passwordErr);

} else{
  $password = trim($_POST["password"]);
}

// password validation
if(empty(trim($_POST["confirmPassword"]))){
  $confirmPasswordErr = "Please confirm password.";
  header('Location:../signup.php?confirmPasswordErr='.$confirmPasswordErr);  

} else{
  $confirmPassword = trim($_POST["confirmPassword"]);

  if(empty($passwordErr) && ($password != $confirmPassword)){ // checking if both passwords matches 
    $confirmPasswordErr = "Password did not match.";
    header('Location:../signup.php?confirmPasswordErr='.$confirmPasswordErr);
  }
}

// CHECKING IF TEST ABOVE RETURNED ERRORS & 

if (empty($usernameErr) && empty($emailErr) && empty($passwordErr) && empty($confirmPasswordErr)) {
    $user_password = $_POST['password'];
    $options = [
        'cost' => 12,
    ];
    $hash = password_hash($user_password, PASSWORD_ARGON2I, $options);

    $sqlInsert = "INSERT INTO MANAGER(username, mail, manager_password, manager_role) VALUES (:username, :mail, :manager_password, :manager_role)";

    $dataBindedInsert = array(
        ':username' => $_POST['username'],
        ':mail' => $_POST['email'],
        ':manager_password' => $hash,
        ':manager_role' => $role
    );

    $preInsert = $pdo->prepare($sqlInsert);
    $preInsert->execute($dataBindedInsert);

    $_SESSION['user'] = $dataBindedInsert;
    $_SESSION['login'] = true;

    // Récupérer l'ID du manager
    $sqlSelectId = "SELECT * FROM MANAGER WHERE mail = :mail";
    $dataBindedSelectId = array(':mail' => $_POST['email']);

    $preSelectId = $pdo->prepare($sqlSelectId);
    $preSelectId->execute($dataBindedSelectId);

    $user = $preSelectId->fetch(PDO::FETCH_ASSOC);

    $_SESSION['role'] = $user['manager_role'];
    var_dump($_SESSION);

    header('Location: ../index.php');
    exit();
}
