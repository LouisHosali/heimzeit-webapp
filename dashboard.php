<?php
include 'auth-check.php';
require 'config.php';
session_start();
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>Dashboard – Heimzeit</title>
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
  <a href="dashboard.php"> Dashboard</a>
  <a href="entry.php"> Neuer Eintrag</a>
  <a href="todos.php"> To-Do's</a>
  <a href="view-entries.php"> Bewohneransicht</a>
</nav>

<main class="dashboard-main">
  <section class="start-card">
    <h1>Willkommen bei Heimzeit</h1>
<?php
$formatter = new IntlDateFormatter(
  'de_DE',
  IntlDateFormatter::FULL,
  IntlDateFormatter::NONE,
  'Europe/Zurich',
  IntlDateFormatter::GREGORIAN,
  'EEEE, d. MMMM y'
);
$heute = $formatter->format(new DateTime());
?>
<p>Heute ist <strong><?= $heute ?></strong>.</p>    <p class="sub">Hier können Sie das Tagesprogramm organisieren, Aufgaben verwalten und den Menüplan einsehen.</p>

    <div class="action-buttons" style="margin-top:2rem;">
      <a href="entry.php" class="cta-button"> Neuen Eintrag erstellen</a>
      <a href="view-entries.php" class="cta-button secondary"> Tagesansicht</a>
    </div>
  </section>
</main>

</body>
</html>