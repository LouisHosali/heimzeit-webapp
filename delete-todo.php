<?php include 'auth-check.php'; ?>
<?php
session_start();
require 'config.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $stmt = $pdo->prepare("DELETE FROM todos WHERE id = ?");
    $stmt->execute([$id]);
}
header("Location: dashboard.php");
exit;
?>
