<?php include 'auth-check.php'; ?>
<?php session_start(); require 'config.php'; ?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>Neuer Eintrag – Heimzeit</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="logo-header">
  <a href="dashboard.php">
    <img src="Assets/Logo.png" alt="Heimzeit Logo">
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
  <section>
    <h2>Neuen Eintrag erstellen</h2>
    <form action="save-entry.php" method="POST">
      <label>Datum: <input type="date" name="datum" required></label>
      <label>Beginn: <input type="time" name="startzeit" required></label>
      <label>Ende: <input type="time" name="endzeit" required></label>
      <label>Titel: <input type="text" name="titel" required></label>
      <label>Ort: <input type="text" name="ort"></label>
      <label>Kategorie:
        <select name="kategorie" required>
          <option value="kreativ">Kreativ</option>
          <option value="bewegung">Bewegung</option>
          <option value="gedaechtnis">Gedächtnistraining</option>
          <option value="menü">Menü</option>
          <option value="event">Event</option>
          <option value="info">Info</option>
          <option value="erinnerung">Erinnerung</option>
        </select>
      </label>
      <label>Beschreibung (optional): 
        <textarea name="beschreibung" rows="3"></textarea>
      </label>
      <button type="submit">Speichern</button>
    </form>
  </section>
</main>
</body>
</html>