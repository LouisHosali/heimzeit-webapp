<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $pass = $_POST['password'];

    // Prüfen, ob E-Mail schon existiert
    $check = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $check->execute([$email]);

    if ($check->rowCount() > 0) {
        echo "Diese E-Mail-Adresse ist bereits registriert. <a href='register.html'>Zurück</a>";
        exit;
    }

    // Passwort hashen
    $hash = password_hash($pass, PASSWORD_BCRYPT);

    // In DB speichern
    $stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
    $stmt->execute([$email, $hash]);

    echo "Registrierung erfolgreich. <a href='login.html'>Jetzt einloggen</a>";
}
?>