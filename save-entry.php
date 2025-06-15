<?php include 'auth-check.php'; ?>
<?php
session_start();
require 'config.php';

// Prüfen, ob Formular abgeschickt wurde
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $datum = $_POST['datum'] ?? '';
  $start = $_POST['startzeit'] ?? '';
  $ende = $_POST['endzeit'] ?? '';
  $titel = $_POST['titel'] ?? '';
  $ort = $_POST['ort'] ?? '';
  $kategorie = $_POST['kategorie'] ?? '';
  $beschreibung = $_POST['beschreibung'] ?? '';
  $user = $_SESSION['user'] ?? 'unbekannt';

  // In DB speichern
  $stmt = $pdo->prepare("INSERT INTO eintraege (datum, startzeit, endzeit, titel, ort, kategorie, beschreibung, created_by) 
                       VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->execute([$datum, $start, $ende, $titel, $ort, $kategorie, $beschreibung, $user]);
  // Redirect mit Erfolgsmeldung
  header("Location: dashboard.php?saved=1#eintrag");
  exit;
} else {
  // Falls ohne POST aufgerufen wurde
  header("Location: dashboard.php");
  exit;
}
header("Location: dashboard.php?saved=1#eintrag");