<?php
    $sql = "SELECT * FROM SKILLS WHERE ID_PLAYER = $pageid";
    $pre = $pdo->prepare($sql);
    $pre->execute();
    $dataSkills = $pre->fetchAll(PDO::FETCH_ASSOC);
?>

<section>
    <h2>Skills</h2>
        <div id="skills">
            <?php
                foreach($dataSkills as $skill){ ?>
                <div class="skill-item item"><?php echo $skill['skill'];?></div>
                <?php }
            ?>
        </div>
</section>