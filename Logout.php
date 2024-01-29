<?php
setcookie('utente', '', time() - 3600, '/');
header('Location: login.php');
exit;
?>