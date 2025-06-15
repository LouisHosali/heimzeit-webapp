<?php include 'auth-check.php'; ?>
<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $pass = $_POST['password'] ?? '';

    // Benutzer aus Datenbank holen
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $userData = $stmt->fetch();

    // Login prüfen
    if ($userData && password_verify($pass, $userData['password'])) {
        $_SESSION['user'] = $userData['email'];
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Login fehlgeschlagen.";
    }
}
?>