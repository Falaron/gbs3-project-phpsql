<?php
    $sql = "SELECT * FROM GAMES WHERE ID_PLAYER = $pageid";
    $pre = $pdo->prepare($sql);
    $pre->execute();
    $dataGames = $pre->fetchAll(PDO::FETCH_ASSOC);
?>

<section>
    <h2>Ranking</h2>
        <div id="games">
            
            <?php
                foreach($dataGames as $game){ ?>
                    <div class="game-item item">
                        <strong><?php echo $game['name'];?></strong>
                        <em><?php echo $game['game_rank'];?></em>
                    </div>
                <?php }
            ?>
        </div>
</section>