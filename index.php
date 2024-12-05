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
        <h1>Hírek</h1>
        <p1>Séra Dávid, U7JZ93</p1>
</div>
    <div id = "cikk">
    <?php while ($a = $result->fetchObject()):
        if ($a->megjdatum > '2024-01-01'):?>
            <h2><?=$a->cim?></h2>
            <p><?=$a->megjdatum?></p>
            <p><?=$a->szoveg?></p>
            <p><?=$a->hozzaszolasokszama?> hozzászólás</p>
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
            <div class="input">
            <label for="input">Név:<br></label>
            <input type="text" id="input" placeholder="">
            <div class="input"><br>
            <label for="input">Szöveg:<br></label>
            <input type="text" id="input" placeholder="">
            <br><br>
            <button onclick="searchTable()">Küldés</button>
            </div>
            <hr>
        <?php endif; ?>
    <?php endwhile; ?>
    </div>
</body>