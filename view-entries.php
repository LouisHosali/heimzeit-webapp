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

<nav class="nav-bar" aria-label="Navigation">
  <a href="dashboard.php">🏠 Dashboard</a>
  <a href="dashboard.php#eintrag">➕ Neuer Eintrag</a>
  <a href="dashboard.php#todos">✅ To-Do's</a>
  <a href="view-entries.php">👁️ Bewohneransicht</a>
</nav>

<main class="dashboard-main">
  <?php if (isset($_GET['updated'])): ?>
    <div class="success-message">✅ Der Eintrag wurde erfolgreich bearbeitet!</div>
  <?php endif; ?>

  <section>
    <h2>Alle Einträge (Bewohneransicht)</h2>

    <?php
    $stmt = $pdo->query("SELECT * FROM eintraege ORDER BY datum DESC, zeit ASC");
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
        echo "<div class='kategorie-icon'>$icon</div>";
        echo "<h3>" . htmlspecialchars($eintrag['titel']) . "</h3>";
        echo "<time datetime='{$eintrag['datum']}'>" . date("d.m.Y", strtotime($eintrag['datum'])) . "</time>";
        echo " – <span>" . htmlspecialchars($eintrag['startzeit']) . "–" . htmlspecialchars($eintrag['endzeit']) . "</span>";
        if ($eintrag['ort']) echo "<p><strong>Ort:</strong> " . htmlspecialchars($eintrag['ort']) . "</p>";
        if ($eintrag['beschreibung']) echo "<p>" . nl2br(htmlspecialchars($eintrag['beschreibung'])) . "</p>";
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