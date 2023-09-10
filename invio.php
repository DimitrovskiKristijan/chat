<?php
header('Content-Type: application/json');

$jObj = null;
$data = json_decode(file_get_contents('php://input'), true);

$mittente = $data['mittente'];
$destinatario = $data['destinatario']; 
$messaggio = $data['messaggio'];

//Collegamento al DB
$indirizzoServerDBMS = "localhost";
$nomeDb = "chat";
$conn = mysqli_connect($indirizzoServerDBMS, "root", "", $nomeDb);
if ($conn->connect_errno > 0) {
    $jObj = preparaRisp(-1, "Connessione rifiutata");
} else {
    $jObj = preparaRisp(0, "Connessione ok");
}

$utente = "SELECT id FROM utenti WHERE username = '$mittente'";
$risQuery = $conn->query($utente);
if ($risQuery->num_rows == 0) {
    echo json_encode(['error' => 'Utente mittente non valido']);
    exit;
}
$row = $risQuery->fetch_assoc();
$IDMittente = $row['id'];
$destinatario = intval($destinatario);

$query = "INSERT INTO messaggi (mittente, destinatario, messaggio) VALUES ('$IDMittente', '$destinatario', '$messaggio')";
if ($conn->query($query)) {
    echo json_encode(['success' => 'Messaggio inviato']);
} else {
    echo json_encode(['error' => 'Errore durante invio del messaggio']);
}
$conn->close();

function preparaRisp($cod, $desc, $jObj = null) {
    if (is_null($jObj)) {
        $jObj = new stdClass();
    }
    $jObj->cod = $cod;
    $jObj->desc = $desc;
    return $jObj;
}
?>
