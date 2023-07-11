<!DOCTYPE html>
<html>
<head>
    <title>conectare</title>
</head>
<body>
    <h2>Conectare</h2>
    <form method="POST" action="">
        <label for="username">Utilizator:</label>
        <input type="text" name="username" id="username" required><br><br>

        <label for="password">Parolă:</label>
        <input type="password" name="password" id="password" required><br><br>

        <input type="submit" value="Conectare">
    </form>
</body>
</html>


<?php
// conexiunea
$hostname="localhost";
$username = "root";
$password = "";
$database = "logg";

$conn = new mysqli($hostname, $username, $password, $database);

// Verificare
    if ($conn->connect_error) {
        die("Conexiunea la baza de date a eșuat: " . $conn->connect_error);
    }

    session_start();

    if (isset($_SESSION['admin'])) {
        header("Location: admin.php");
        exit();
    }
    
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user = $_POST["username"];
    $pass = $_POST["password"];

    // verificarea daca exista
    $sql = "SELECT * FROM users WHERE username = '$user' AND password = '$pass'";
    $result = $conn->query($sql);

    //rezultat
    if ($result->num_rows > 0) {
        $_SESSION['admin'] = $user;
        header("Location: admin.php"); 
        exit();
    } else {
        echo "Utilizator sau parolă incorecte!";
    }
    
 }   
$conn->close();


?>

