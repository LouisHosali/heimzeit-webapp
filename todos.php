<?php include 'auth-check.php'; ?>
<?php session_start(); require 'config.php'; ?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>To-Do's – Heimzeit</title>
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
    <h2>Meine To-do-Liste</h2>

    <form action="save-todo.php" method="POST">
      <input type="text" name="text" placeholder="Neue Aufgabe..." required>
      <button type="submit">Hinzufügen</button>
    </form>

    <?php
    $user = $_SESSION['user'];
    $stmt = $pdo->prepare("SELECT * FROM todos WHERE user_email = ? ORDER BY done ASC, id DESC");
    $stmt->execute([$user]);
    $todos = $stmt->fetchAll();

    if (count($todos) === 0) {
      echo "<p>Keine Aufgaben vorhanden.</p>";
    } else {
      echo "<ul style='list-style: none; padding: 0;'>";
      foreach ($todos as $todo) {
        $style = $todo['done'] ? "color:gray; text-decoration:line-through;" : "color:#1A1A1A;";
        echo "<li style='margin-bottom: 1rem; $style'>";
        echo htmlspecialchars($todo['text']);
        echo " <form action='toggle-todo.php' method='POST' style='display:inline; margin-left:1rem;'>
                <input type='hidden' name='id' value='{$todo['id']}'>
                <button type='submit'>Erledigt</button>
              </form>";
        echo " <form action='delete-todo.php' method='POST' style='display:inline; margin-left:0.5rem;'>
                <input type='hidden' name='id' value='{$todo['id']}'>
                <button type='submit'>Löschen</button>
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