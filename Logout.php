<?php
session_start();

// Elimina il cookie 'utente'
setcookie('utente', '', time() - 3600, '/');

// Cancella tutte le variabili di sessione
$_SESSION = array();

// Distruggi la sessione
session_destroy();

// Reindirizza l'utente alla pagina di login o ad un'altra pagina
header('Location: login.php');
exit;
?>