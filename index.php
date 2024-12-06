<?php
    require 'db.php';
    session_start();
    $db = getDb();
    $result = $db->query("SELECT
    hir.id AS article_id,
    hir.cim,
    hir.megjdatum,
    hir.szoveg,
    COUNT(DISTINCT hozzaszolas.id) AS hozzaszolasokszama
    FROM hir
    LEFT JOIN hozzaszolas ON hir.id = hozzaszolas.hirid
    GROUP BY hir.id, hir.cim, hir.megjdatum, hir.szoveg
    ORDER BY hir.megjdatum DESC
");

    
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css"> 
    <title>Hírek</title>
</head>
<body id = "hatter">
    <div id = nev>
        <h id = "cim">Hírek</h>
        <p id = "neptun">Séra Dávid, U7JZ93</p>
</div>
    <div id = "cikk">
    <?php while ($a = $result->fetchObject()):
        if ($a->megjdatum > '2024-01-01'):?>
            <h><?= htmlspecialchars($a->cim) ?></h>
            <p><?= htmlspecialchars($a->megjdatum) ?></p>
            <p><?= nl2br(htmlspecialchars($a->szoveg)) ?></p>
            <p><?= htmlspecialchars($a->hozzaszolasokszama) ?> hozzászólás</p>
            <?php $comments = $db->query("
                SELECT szerzo, hozzszoveg
                FROM hozzaszolas
                WHERE hirid = {$a->article_id}
            ");
            ?>
            <?php while ($b = $comments->fetchObject()):?>
            <ul>
                <li><?=$b->szerzo?>: <?=$b->hozzszoveg?></li>
            </ul>
            <?php endwhile; ?>
            <p>Új Hozzászólás írása</p>
            <form action="comment.php" method="post">
                <input type="hidden" name="hirid" value="<?= $a->article_id ?>">
                <p>
                    <div class="form-group">
                    <label for="nev">Név:<br></label>
                    <input type="text" name="nev" id="nev" required>
                    </div>
                </p>
                <p>
                    <label for="text">Szöveg:</label><br>
                    <textarea name="szoveg" id="szoveg" rows="2" required></textarea>
                </p>
                <button type="submit">Küldés</button>
            </form>
        <?php endif; ?>
    <?php endwhile; ?>
    </div>
</body>