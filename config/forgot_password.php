<?php
$manager_id = isset($_POST['MANAGER_ID']) ? $_POST['MANAGER_ID'] : null;

if (isset($_POST['mail'])) {
    $postMail = $_POST['mail'];

    
    $query = "SELECT ID FROM MANAGER WHERE mail = :postMail";
    $pre = $pdo->prepare($query);
    $pre->bindParam(':postMail', $postMail, PDO::PARAM_STR);
    $pre->execute();
    
    $data = $pre->fetchAll(PDO::FETCH_ASSOC);

   
if (!empty($data)) {
    // Assurez-vous d'avoir la variable $manager_id définie avant de l'utiliser
    $manager_id = $data[0]['ID'];

     $token = bin2hex(openssl_random_pseudo_bytes(4));

    // Utilisez des requêtes préparées pour éviter les injections SQL
    $sqlInsert = "INSERT INTO RESET_TOKENS(MANAGER_ID, token) VALUES (:MANAGER_ID, :token)";
    $preInsert = $pdo->prepare($sqlInsert);
    $preInsert->bindParam(':MANAGER_ID', $manager_id, PDO::PARAM_INT);
    $preInsert->bindParam(':token', $token, PDO::PARAM_STR);
    $preInsert->execute();
    }
}
?>



  


  $query = "SELECT * FROM RESET_TOKENS WHERE token = :token AND expiration > NOW()";
  var_dump($token);
  var_dump($query)
?>

