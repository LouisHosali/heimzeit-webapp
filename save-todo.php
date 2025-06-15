<?php include 'auth-check.php'; ?>
<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['text'], $_POST['date'])) {
    $text = trim($_POST['text']);
    $date = $_POST['date'];
    $user = $_SESSION['user'];

    if ($text !== '' && $date !== '') {
        $stmt = $pdo->prepare("INSERT INTO todos (user_email, text, date) VALUES (?, ?, ?)");
        $stmt->execute([$user, $text, $date]);
    }
}
header("Location: dashboard.php");
exit;
?>
<form action="save-todo.php" method="POST" style="margin-bottom: 1.5rem;">
  <input type="text" name="text" placeholder="Neue Aufgabe..." required style="padding: 0.5rem; width: 50%;">
  <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>" required style="padding: 0.5rem;">
  <button type="submit" style="padding: 0.5rem 1rem; background-color: #1E40AF; color: white; border: none; border-radius: 4px;">Hinzufügen</button>
</form>