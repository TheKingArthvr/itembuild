<?php
  session_start();
  if (!isset($_SESSION["logged_in"]) || !$_SESSION["logged_in"]) {
    header("Location: login.php");
    exit;
  }
?>

<!-- Hier kommt der Inhalt der Dashboard-Seite -->
