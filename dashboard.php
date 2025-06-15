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

<nav class="nav-bar" role="navigation" aria-label="Hauptnavigation">
  <a href="dashboard.php">🏠 Dashboard</a>
  <a href="#eintrag">➕ Neuer Eintrag</a>
  <a href="#todos">✅ To-Do's</a>
  <a href="view-entries.php">👁️ Bewohneransicht</a>
</nav>

<header class="dashboard-header">
  <h1>Dashboard Pflege</h1>
  <a href="logout.php" class="logout-button">Logout</a>
</header>

<main class="dashboard-main">
  <?php if (isset($_GET['saved'])): ?>
    <div class="success-message">✅ Der Eintrag wurde erfolgreich gespeichert!</div>
  <?php endif; ?>

  <!-- Aktivitäten erstellen -->
  <section id="eintrag" aria-labelledby="eintrag-heading">
    <h2 id="eintrag-heading">Neuen Eintrag erstellen</h2>
    <form action="save-entry.php" method="POST" id="neuer-eintrag-form">
      <label for="datum">Datum:</label>
      <input type="date" id="datum" name="datum" required>

      <label for="startzeit">Beginn:</label>
      <input type="time" id="startzeit" name="startzeit" required>

      <label for="endzeit">Ende:</label>
      <input type="time" id="endzeit" name="endzeit" required>

      <label for="titel">Titel:</label>
      <input type="text" id="titel" name="titel" required>

      <label for="ort">Ort:</label>
      <input type="text" id="ort" name="ort">

      <label for="kategorie">Kategorie:</label>
      <select id="kategorie" name="kategorie" required>
        <option value="kreativ">Kreativ</option>
        <option value="bewegung">Bewegung</option>
        <option value="gedaechtnis">Gedächtnistraining</option>
        <option value="menü">Menü</option>
        <option value="event">Event</option>
        <option value="info">Info</option>
        <option value="erinnerung">Erinnerung</option>
      </select>

      <label for="beschreibung">Beschreibung (optional):</label>
      <textarea id="beschreibung" name="beschreibung" rows="3"></textarea>

      <button type="submit">Speichern</button>
    </form>
  </section>

  <!-- To-Do-Liste -->
  <section id="todos" aria-labelledby="todos-heading">
    <h2 id="todos-heading">Meine To-do-Liste</h2>

    <form action="save-todo.php" method="POST">
      <label for="todo-text" class="visually-hidden">Neue Aufgabe:</label>
      <input type="text" id="todo-text" name="text" placeholder="Neue Aufgabe..." required>
      <button type="submit" aria-label="Aufgabe hinzufügen">Hinzufügen</button>
    </form>

    <?php
    $user = $_SESSION['user'];
    $stmt = $pdo->prepare("SELECT * FROM todos WHERE user_email = ? ORDER BY done ASC, id DESC");
    $stmt->execute([$user]);
    $todos = $stmt->fetchAll();

    if (count($todos) === 0) {
      echo "<p>Keine Aufgaben vorhanden.</p>";
    } else {
      echo "<ul class='todo-liste'>";
      foreach ($todos as $todo) {
        $style = $todo['done'] ? "color:gray; text-decoration:line-through;" : "color:#1A1A1A;";
        echo "<li style='$style'>" . htmlspecialchars($todo['text']);

        echo "<form action='toggle-todo.php' method='POST' style='display:inline; margin-left:1rem;'>
                <input type='hidden' name='id' value='{$todo['id']}'>
                <button type='submit' aria-label='Als erledigt markieren'>✔️</button>
              </form>";

        echo "<form action='delete-todo.php' method='POST' style='display:inline; margin-left:0.5rem;'>
                <input type='hidden' name='id' value='{$todo['id']}'>
                <button type='submit' aria-label='Aufgabe löschen'>🗑️</button>
              </form>";

        echo "</li>";
      }
      echo "</ul>";
    }
    ?>
  </section>
</main>

</body>
</html>