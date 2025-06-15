<?php include 'auth-check.php'; ?>
<?php
session_start();
require 'auth-check.php';
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $datum = $_POST['datum'];
  $start = $_POST['startzeit'];
  $ende = $_POST['endzeit'];
  $titel = $_POST['titel'];
  $ort = $_POST['ort'];
  $kategorie = $_POST['kategorie'];
  $beschreibung = $_POST['beschreibung'];

  $stmt = $pdo->prepare("UPDATE eintraege SET datum = ?, startzeit = ?, endzeit = ?, titel = ?, ort = ?, kategorie = ?, beschreibung = ? WHERE id = ?");
  $stmt->execute([$datum, $start, $ende, $titel, $ort, $kategorie, $beschreibung, $id]);

  header("Location: view-entries.php?updated=1");
  exit;
}
header("Location: view-entries.php?updated=1");