<!DOCTYPE html>
<html>
<head>
    <title>Pagina Admin</title>
</head>

<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php"); 
    exit();
}
// Deconectare
if (isset($_POST['logout'])) {
    session_destroy(); 
    header("Location: login.php"); 
    exit();
}
?>

<body>
    <h2>Bun venit, <?php echo $_SESSION['admin']; ?>!</h2>

    <form method="POST" action="">
        <input type="submit" name="logout" value="Deconectare">
    </form>
</body>
</html>