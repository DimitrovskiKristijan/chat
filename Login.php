<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "chat";
$connessione = new mysqli($host,$user,$password,$db);
if($connessione === false){
    die("errore connessione: " .$connessione->connect_error);
}
$username = $connessione->real_escape_string($_POST['username']);
$password = $connessione->real_escape_string($_POST['pwd']);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $sql_select = "SELECT * FROM utenti WHERE username = '$username' AND pwd = '$password'";
    if ($result = $connessione->query($sql_select)) {
        if ($result->num_rows == 1) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            session_start();
            $_SESSION['Accesso'] = true;
            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header('location: chat.php');
        } else {
            echo "I dati inseriti non corrispondono";
        }
    } else {
        echo "Si è verificato un errore attendere prego...";
    }
    $connessione->close();

}
?>

