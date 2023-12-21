<?php
require_once "config.php";

$token = isset($_POST['token']) ? $_POST['token'] : null;
var_dump($token);

if ($token) {
    $query = "SELECT * FROM RESET_TOKENS WHERE token = :token AND expiration > NOW()";
    $pre = $pdo->prepare($query);
    $pre->bindParam(':token', $token, PDO::PARAM_STR);
    $pre->execute();
    $tokenData = $pre->fetch(PDO::FETCH_ASSOC);

    if ($tokenData) {
        $manager_id = $tokenData['MANAGER_ID'];

        // CHECKING PASSWORD VALID
        // length
        if(empty(trim($_POST["password"]))){
          $passwordErr = "You have to write something here.";
          header('Location:../update-password.php?passwordErr='.$passwordErr); // span tag in html

        } elseif(strlen(trim($_POST["password"])) < 8) { // managing password length with strlen()
          $passwordErr = "Password must have atleast 8 characters.";
          header('Location:../update-password.php?passwordErr='.$passwordErr);

        } else{
          $password = trim($_POST["password"]);
        }

        // password validation
        if(empty(trim($_POST["confirmPassword"]))){
          $confirmPasswordErr = "Please confirm password.";
          header('Location:../update-password.php?confirmPasswordErr='.$confirmPasswordErr);  

        } else{
          $confirmPassword = trim($_POST["confirmPassword"]);

          if(empty($passwordErr) && ($password != $confirmPassword)){ // checking if both passwords matches 
            $confirmPasswordErr = "Password did not match.";
            header('Location:../update-password.php?confirmPasswordErr='.$confirmPasswordErr);
          }
        }

        // CHECKING IF TEST ABOVE RETURNED ERRORS

        if (empty($passwordErr) && empty($confirmPasswordErr)) {
            $sqlUpdate = "UPDATE MANAGER SET manager_password = :manager_password WHERE ID = :manager_id";
            $preUpdate = $pdo->prepare($sqlUpdate);
            $preUpdate->bindParam(':manager_password', $password, PDO::PARAM_STR);
            $preUpdate->bindParam(':manager_id', $manager_id, PDO::PARAM_INT);
            $preUpdate->execute();

            // Delete the token
            $sqlDeleteToken = "DELETE FROM RESET_TOKENS WHERE token = :token";
            $preDeleteToken = $pdo->prepare($sqlDeleteToken);
            $preDeleteToken->bindParam(':token', $token, PDO::PARAM_STR);
            $preDeleteToken->execute();

            header("location: ../index.php");
        }
    } else {
        echo "Link expired or is invalid.";
    }
} else {
    echo "No token.";
}
?>
