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

        $to = $postMail;
        $subject = "Update password";
        $message = "Please update your password by clicking the link below: \n";
        $message .= "Contenu de l'e-mail. <a href='https://www.team-roaster-pro.alwaysdata.net/update-password.php?token=$token'>Reset password here.</a>";


        $headers = "From: team-roster-pro@alwaysdata.net\r\n";
        $headers .= "Reply-To: team-roster-pro@alwaysdata.net\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
        
        // Envoyer l'e-mail
        $mailSent = mail($to, $subject, $message, $headers);
        
        // Vérifier si l'e-mail a été envoyé avec succès
        if ($mailSent) {
            echo "L'e-mail a été envoyé avec succès.";
        } else {
            echo "Erreur lors de l'envoi de l'e-mail.";
        }
    }
}
?>
