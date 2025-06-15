<?php
include 'auth-check.php';
session_start();
require 'config.php';

$id = $_GET['id'] ?? null;
if (!$id) {
  header("Location: view-entries.php");
  exit;
}

$stmt = $pdo->prepare("SELECT * FROM eintraege WHERE id = ?");
$stmt->execute([$id]);
$entry = $stmt->fetch();

if (!$entry) {
  echo "Eintrag nicht gefunden.";
  exit;
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>Eintrag bearbeiten – Heimzeit</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="logo-header">
  <a href="dashboard.php">
    <img src="Assets/Logo.png" alt="Heimzeit Logo" style="height: 100px;">
  </a>
</header>

<nav class="nav-bar">
  <a href="dashboard.php">🏠 Dashboard</a>
  <a href="dashboard.php#eintrag">➕ Neuer Eintrag</a>
  <a href="dashboard.php#todos">✅ To-Do's</a>
  <a href="view-entries.php">👁️ Bewohneransicht</a>
</nav>

<main class="dashboard-main">
  <section>
    <h2>Eintrag bearbeiten</h2>
    <form action="update-entry.php" method="POST">
      <input type="hidden" name="id" value="<?= $entry['id'] ?>">

      <label for="datum">Datum:</label>
      <input type="date" id="datum" name="datum" value="<?= $entry['datum'] ?>" required>

      <label for="startzeit">Beginn:</label>
      <input type="time" id="startzeit" name="startzeit" value="<?= $entry['startzeit'] ?>" required>

      <label for="endzeit">Ende:</label>
      <input type="time" id="endzeit" name="endzeit" value="<?= $entry['endzeit'] ?>" required>

      <label for="titel">Titel:</label>
      <input type="text" id="titel" name="titel" value="<?= htmlspecialchars($entry['titel']) ?>" required>

      <label for="ort">Ort:</label>
      <input type="text" id="ort" name="ort" value="<?= htmlspecialchars($entry['ort']) ?>">

      <label for="kategorie">Kategorie:</label>
      <select id="kategorie" name="kategorie">
        <?php
        $kategorien = ['kreativ','bewegung','gedaechtnis','menü','event','info','erinnerung'];
        foreach ($kategorien as $kat) {
          $selected = ($entry['kategorie'] === $kat) ? 'selected' : '';
          echo "<option value=\"$kat\" $selected>" . ucfirst($kat) . "</option>";
        }
        ?>
      </select>

      <label for="beschreibung">Beschreibung:</label>
      <textarea id="beschreibung" name="beschreibung" rows="4"><?= htmlspecialchars($entry['beschreibung']) ?></textarea>

      <button type="submit">Änderungen speichern</button>
    </form>
  </section>
</main>
</body>
</html>