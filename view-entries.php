<?php
include 'auth-check.php';
session_start();
require 'config.php';
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>Bewohneransicht – Heimzeit</title>
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
  <a href="dashboard.php">Dashboard</a>
  <a href="entry.php">Neuer Eintrag</a>
  <a href="todos.php">To-Do's</a>
  <a href="view-entries.php">Bewohneransicht</a>
  <a href="logout.php" class="logout-link">Logout</a>
</nav>

<main class="dashboard-main">
  <?php if (isset($_GET['updated'])): ?>
    <div class="success-message">✅ Der Eintrag wurde erfolgreich bearbeitet!</div>
  <?php endif; ?>

  <section>
    <h2>Alle Einträge (Bewohneransicht)</h2>

    <?php
    $stmt = $pdo->query("SELECT * FROM eintraege ORDER BY datum DESC, startzeit ASC");
    $eintraege = $stmt->fetchAll();

    if (count($eintraege) === 0) {
      echo "<p>Es wurden noch keine Einträge erfasst.</p>";
    } else {
      echo "<div class='kachel-container'>";

      $icons = [
        "kreativ" => "🎨",
        "bewegung" => "🏃",
        "gedaechtnis" => "🧠",
        "menü" => "🍽️",
        "event" => "🎉",
        "info" => "ℹ️",
        "erinnerung" => "🔔"
      ];

      foreach ($eintraege as $eintrag) {
        $icon = $icons[$eintrag['kategorie']] ?? "📌";

        echo "<article class='kachel {$eintrag['kategorie']}'>";
        echo "<div class='kategorie-icon'>{$icon}</div>";

        // Titel
        if (!empty($eintrag['titel'])) {
          echo "<h3>" . htmlspecialchars($eintrag['titel']) . "</h3>";
        }

        // Datum & Uhrzeit
        echo "<p><time datetime='" . htmlspecialchars($eintrag['datum']) . "'>";
        echo date("d.m.Y", strtotime($eintrag['datum']));
        echo "</time>";

        if (!empty($eintrag['startzeit']) || !empty($eintrag['endzeit'])) {
          echo " – ";
          echo !empty($eintrag['startzeit']) ? htmlspecialchars($eintrag['startzeit']) : "";
          if (!empty($eintrag['endzeit'])) {
            echo "–" . htmlspecialchars($eintrag['endzeit']);
          }
        }
        echo "</p>";

        // Ort
        if (!empty($eintrag['ort'])) {
          echo "<p><strong>Ort:</strong> " . htmlspecialchars($eintrag['ort']) . "</p>";
        }

        // Beschreibung
        if (!empty($eintrag['beschreibung'])) {
          echo "<p>" . nl2br(htmlspecialchars($eintrag['beschreibung'])) . "</p>";
        }

        echo "<a href='edit-entry.php?id=" . urlencode($eintrag['id']) . "'>✏️ Bearbeiten</a>";
        echo "</article>";
      }

      echo "</div>";
    }
    ?>
  </section>
</main>

</body>
</html>