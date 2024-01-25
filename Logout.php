<?php
setcookie('utente', '', time() - 3600, '/');
$_SESSION = array();
header('Location: login.php');
exit;
?>