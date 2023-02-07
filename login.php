<?php
  // Verbindung zur Datenbank herstellen
  $host = "sql7.freemysqlhosting.net";
  $username = "sql7596380";
  $password = "xBEXftGBYp";
  $dbname = "	sql7596380";

  $conn = mysqli_connect($host, $username, $password, $dbname);
  
  // Überprüfen, ob die Verbindung erfolgreich war
  if (!$conn) {
      die("Verbindung zur Datenbank fehlgeschlagen: " . mysqli_connect_error());
  }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
      
    // Passwort hashieren
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
      
    // Überprüfen, ob die E-Mail-Adresse in der Datenbank vorhanden ist
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // E-Mail-Adresse gefunden
        $user = mysqli_fetch_assoc($result);
      
        // Überprüfen, ob das Passwort gültig ist
        if (password_verify($password, $user["password"])) {
            // Passwort ist gültig
            // Benutzer erfolgreich angemeldet
            session_start();
            $_SESSION["logged_in"] = true;
            $_SESSION["user_id"] = $user["id"];
            header("Location: dashboard.php");
            exit;
        } else {
            // Passwort ist ungültig
            $error_message = "Passwort ist ungültig";
        }
    } else {
          // E-Mail-Adresse nicht gefunden
          $error_message = "E-Mail-Adresse nicht gefunden";
    }
}