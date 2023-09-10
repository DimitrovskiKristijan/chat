<?php
    header('Content-Type: application/json');

    $jObj = null; 
    //Collegamento al DB
    $indirizzoServerDBMS = "localhost";
    $nomeDb = "chat";
    $conn = mysqli_connect($indirizzoServerDBMS, "root", "", $nomeDb);
    if($conn->connect_errno>0){
        $jObj = preparaRisp(-1, "Connessione rifiutata");
    }else{
        $jObj = preparaRisp(0, "Connessione ok");
    }
    $query = "SELECT id, username FROM utenti";
    $result = $conn->query($query);
    $data = array();
    if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $data[] = $row;
    }
    }
   
    $conn->close();
    echo json_encode($data);
    
function preparaRisp($cod, $desc, $jObj = null){
    if(is_null($jObj)){
        $jObj = new stdClass();
    }
    $jObj->cod = $cod;
    $jObj->desc = $desc;
    return $jObj;
}
