<?php
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

$IDMittente = $data['mittente'];
$IDDestinatario = $data['destinatario'];

//Collegamento al DB
$indirizzoServerDBMS = "localhost";
$nomeDb = "chat";
$conn = mysqli_connect($indirizzoServerDBMS, "root", "", $nomeDb);
if($conn->connect_errno>0){
   $jObj = preparaRisp(-1, "Connessione rifiutata");
}else{
    $jObj = preparaRisp(0, "Connessione ok");
}

$query = "SELECT mittente, destinatario, messaggio, orario 
          FROM messaggi 
          WHERE ((mittente = '$IDMittente' AND destinatario = '$IDDestinatario') OR 
                (mittente = '$IDDestinatario' AND destinatario = '$IDMittente')) 
          ORDER BY orario";
$result = $conn->query($query);
$messaggi = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $messaggi[] = ['mittente' => $row['mittente'],'destinatario' => $row['destinatario'],'messaggio' => $row['messaggio'],'orario' => $row['orario']];
    }
    echo json_encode($messaggi);
} else {
    echo json_encode(['error' => 'Errore nella query']);
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
