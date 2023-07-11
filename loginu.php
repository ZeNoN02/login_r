<!DOCTYPE html>
<html>
<head>
    <title>User</title>
</head>
<body>
    <h2>Conectare</h2>
    <form method="POST" action="">
        <label for="username">Utilizator:</label>
        <input type="text" name="username" id="username" required><br><br>

        <label for="password">Parolă:</label>
        <input type="password" name="password" id="password" required><br><br>

        <input type="submit" name="login" value="Conectare">
        <input type="submit" name="register" value="Înregistrare">
    </form>
</body>
</html>

<?php
// conexiunea
$hostname = "localhost";
$username = "root";
$password = "";
$database = "logg";

$conn = new mysqli($hostname, $username, $password, $database);

// Verificare
if ($conn->connect_error) {
    die("Conexiunea la baza de date a eșuat: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["login"])) {
        $user = $_POST["username"];
        $pass = $_POST["password"];

    
        $sql = "SELECT * FROM usersimple WHERE username = '$user' AND password = '$pass'";
        $result = $conn->query($sql);

        // rezultat
        if ($result->num_rows > 0) {
            echo "Logare reușită!";
        } else {
            echo "Utilizator sau parolă incorecte!";
        }
    }
     // Înregistrare
    if (isset($_POST["register"])) {
        
        $user = $_POST["username"];
        $pass = $_POST["password"];

        $check_user_sql = "SELECT * FROM usersimple WHERE username = '$user'";
        $check_user_result = $conn->query($check_user_sql);

        if ($check_user_result->num_rows > 0) {
            echo "Acest utilizator există deja!";
        } else {
            // inserare în baza de date
            $insert_user_sql = "INSERT INTO usersimple (username, password) VALUES ('$user', '$pass')";
            if ($conn->query($insert_user_sql) === TRUE) {
                echo "Înregistrare reușită!";
            } else {
                echo "Eroare la înregistrare: " . $conn->error;
            }
        }
    }

    $conn->close();
}
?>
