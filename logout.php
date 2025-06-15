<?php include 'auth-check.php'; ?>
<?php
session_start();
session_destroy();
header("Location: login.html");
exit;
?>