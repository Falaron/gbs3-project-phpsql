<?php
require_once "config.php";

$manager_id = isset($_POST['MANAGER_ID']) ? $_POST['MANAGER_ID'] : null;
$token = bin2hex(random_bytes(32));

$date = new DateTime('NOW');
$date->add(new DateInterval('P1DT5H'));
$expirationDate = $date->format('Y-m-d H:i:s'); // Formatage de la date pour l'inclure dans la requête

echo $expirationDate; // Supprimez cette ligne après avoir vérifié que la date est correcte

if (isset($_POST['email'])) {
    $postMail = $_POST['email'];
    
    $sql = "SELECT ID FROM MANAGER WHERE mail = :postMail";
    $pre = $pdo->prepare($sql);
    $pre->bindParam(':postMail', $postMail, PDO::PARAM_STR);
    $pre->execute();
    $data = $pre->fetch(PDO::FETCH_ASSOC);
   
    if (!empty($data)) {
        $manager_id = $data['ID'];

        $token = bin2hex(random_bytes(32));

        $sqlInsert = "INSERT INTO RESET_TOKENS(MANAGER_ID, token, expiration) VALUES (:MANAGER_ID, :token, :expiration)";
        $preInsert = $pdo->prepare($sqlInsert);
        $preInsert->bindParam(':MANAGER_ID', $manager_id, PDO::PARAM_INT);
        $preInsert->bindParam(':token', $token, PDO::PARAM_STR);
        $preInsert->bindParam(':expiration', $expirationDate, PDO::PARAM_STR); // Utilisation de la date formatée
        $preInsert->execute();

        // Envoyer l'e-mail
        $to = $postMail;
        $subject = "Update password";
        $message = "Click on the following link to update your password: \n";
        $message .= "update-password.php?token=" . $token;

        // Vous pouvez personnaliser le reste du message selon vos besoins
        $headers = "From: superteam@gmail.com";

        // Assurez-vous que votre serveur est configuré pour envoyer des e-mails
        mail($to, $subject, $message, $headers);
        var_dump($to);
        var_dump($subject);
        var_dump($message);
        var_dump($headers);
    }
}
?>
