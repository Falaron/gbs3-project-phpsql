<?php
    require('config/config.php');

    $token = isset($_GET['token']) ? $_GET['token'] : null;

    if ($token) {
        // Vérifier la validité du token dans la base de données
        $query = "SELECT * FROM RESET_TOKENS WHERE token = :token AND expiration > NOW()";
        $pre = $pdo->prepare($query);
        $pre->bindParam(':token', $token, PDO::PARAM_STR);
        $pre->execute();
        $tokenData = $pre->fetch(PDO::FETCH_ASSOC);

        if ($tokenData) {
            require('view/vupdate-password.php');
        } else {
            echo "The link may have expired or is not valid.";
        }
    } else {
        echo "Page not found. No token to update your password.";
    }

    
?>