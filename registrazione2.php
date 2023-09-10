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

//Controllo se password c'è
$sql_check = "SELECT * FROM utenti WHERE pwd = '$password'";
$result_check = $connessione->query($sql_check);

if ($result_check->num_rows > 0) {
    echo "Questa Password è già presente nel database, la  preghiamo di inserirne un'altra.<br>";   
    echo "<a href='registrazione.php'><button>Torna Indietro</button></a>";
} else {
    $sql = "INSERT INTO utenti (username, pwd) VALUES ('$username','$password')";
    
    if($connessione->query($sql) === true){
        echo "registrazione Effettuata con successo <br>";
        echo "<a href='index.html'><button>Vai al Login</button></a>";
    }else{
        echo "errore durante la registrazione... $sql. " . $connessione->error;
    }
}


