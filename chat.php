     <!-- AVVIO SESSIONE DA RISPOSTA "Accesso" di  Login.php-->
     <?php
    session_start();
    if(!isset($_SESSION['Accesso']) || $_SESSION['Accesso'] != true){
        header("location: index.html");
        exit;
    }
    ?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Chat</title>
        <link rel="stylesheet" href="CSS/style.css">    
    </head>
    <body>
    <h1>CHAT</h1>
    <button id="disconnetti"><a href="index.html">Disconnetti</a></button>
        <header>
            
        </header>
        <main>
           <div>
           <ul id="listaContatti" sceltoUtente="<?php echo $_SESSION['username']; ?>"> <!-- data utente da problemi--></ul>
            </div>
            <section>
                <header id="nomeSopra"></header>
                <section id="chat" class="chat"></section>
                <div id="barraInvio">
                    <input type="text" id="barraScrittura" placeholder="Scrivi...">
                    <button id="btnInvio">
                        <span>Invia</span>
                    </button>
                </div>          
            </section>
        </main> 
    </body>
    <script src="JS/script.js"></script> <!-- METTO ALLA FINE PERCHE' SE MESSO SOTTO L' HEAD NON VUOLE PRENDERMELO-->
    </html> 

