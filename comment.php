<?php
require 'db.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nev = trim($_POST['nev']);
    $szoveg = trim($_POST['szoveg']);
    $hirid = (int)$_POST['hirid'];

    // Validate input
    if (empty($nev) || empty($szoveg) || $hirid <= 0) {
        die("Error: All fields are required, and a valid news ID must be provided.");
    }

    // Check if the news article exists
    $db = getDb();
    $stmt = $db->prepare("SELECT id FROM hir WHERE id = :hirid");
    $stmt->execute(['hirid' => $hirid]);
    if ($stmt->rowCount() === 0) {
        die("Error: The specified news article does not exist.");
    }

    // Insert the comment into the database
    $stmt = $db->prepare("INSERT INTO hozzaszolas (szerzo, hozzszoveg, hirid) VALUES ( :nev, :szoveg, :hirid)");
    $stmt->execute([
        'hirid' => $hirid,
        'nev' => $nev,
        'szoveg' => $szoveg
    ]);

    // Redirect to index.php
    header("Location: index.php");
    exit;
}
?>