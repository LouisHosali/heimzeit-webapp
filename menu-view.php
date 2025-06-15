<?php
include 'auth-check.php';
session_start();
require 'config.php';
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>Wochenmenü – Heimzeit</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
  <a href="menu-view.php">🍽️ Menü</a>
</nav>

<main class="dashboard-main">
  <section>
    <h2>🍽️ Menü-Übersicht</h2>

    <?php
    $stmt = $pdo->prepare("SELECT * FROM eintraege WHERE kategorie = 'menü' ORDER BY datum ASC");
    $stmt->execute();
    $menues = $stmt->fetchAll();

    if (count($menues) === 0) {
      echo "<p>Es wurden noch keine Menüs eingetragen.</p>";
    } else {
      echo "<div class='kachel-container'>";
      foreach ($menues as $eintrag) {
        echo "<article class='kachel menü'>";
        echo "<div class='kategorie-icon'>🍽️</div>";
        echo "<h3>" . htmlspecialchars($eintrag['titel']) . "</h3>";
        echo "<time datetime='{$eintrag['datum']}'>" . date("l, d.m.Y", strtotime($eintrag['datum'])) . "</time>";
        if ($eintrag['beschreibung']) {
          echo "<p>" . nl2br(htmlspecialchars($eintrag['beschreibung'])) . "</p>";
        }
        echo "<a href='edit-entry.php?id={$eintrag['id']}'>✏️ Bearbeiten</a>";
        echo "</article>";
      }
      echo "</div>";
    }
    ?>
  </section>
</main>
</body>
</html>