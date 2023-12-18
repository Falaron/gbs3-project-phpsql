<?php
$manager_id = isset($_POST['MANAGER_ID']) ? $_POST['MANAGER_ID'] : null;
$token = bin2hex(random_bytes(32));

$date = new DateTime('NOW');
$date->add(new DateInterval('P1DT5H'));
echo $date->format('Y-m-d H:i:s');

if (isset($_POST['mail'])) {
    $postMail = $_POST['mail'];

    
    $query = "SELECT ID FROM MANAGER WHERE mail = :postMail";
    $pre = $pdo->prepare($query);
    $pre->bindParam(':postMail', $postMail, PDO::PARAM_STR);
    $pre->execute();
    $data = $pre->fetch(PDO::FETCH_ASSOC);
    var_dump($data);
    $manager_id = $data;

   
if (!empty($data)) {
    // Assurez-vous d'avoir la variable $manager_id définie avant de l'utiliser
    $manager_id = $data['ID'];

     $token = bin2hex(random_bytes(32));

    // Utilisez des requêtes préparées pour éviter les injections SQL
    $sqlInsert = "INSERT INTO RESET_TOKENS(MANAGER_ID, token, expiration) VALUES (:MANAGER_ID, :token, :$date)";
    $preInsert = $pdo->prepare($sqlInsert);
    $preInsert->bindParam(':MANAGER_ID', $manager_id, PDO::PARAM_INT);
    $preInsert->bindParam(':token', $token, PDO::PARAM_STR);
    $preInsert->execute();

    $query = "SELECT * FROM RESET_TOKENS WHERE token = :token AND expiration > NOW()";
    }
}
Var_dump($token);

?>



  


  


