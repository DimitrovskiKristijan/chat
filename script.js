urlBase = "http://localhost/ChatDimitrovski/";

let btnInvio = document.getElementById('btnInvio'); 
let barraScrittura = document.getElementById('barraScrittura');
let IDUtente = document.getElementById('listaContatti').getAttribute('sceltoUtente'); 
let utenteSceltoScritta = document.getElementById('nomeSopra');
let chat = document.getElementById('chat');
let IDUtenteScelto = null;  
let destinatario = null; 
let utenteID = null; 

window.onload = function(){
    trovaUtente();  
    btnInvio.addEventListener('click', () => {
        const messaggio = barraScrittura.value.trim();
        if (messaggio != '') {
             destinatario = IDUtenteScelto; 
            const data = {
                mittente: IDUtente,
                destinatario: destinatario, 
                messaggio: messaggio
            };
            fetch(urlBase + 'Server/invio.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(risposta => risposta.json())
            .then(data => {    
                if (data.success) {
                    VisualizzaMess(IDUtente, messaggio, true);
                }
            })
            .catch(error => console.error('Errore durante la richiesta:', error.message));    
            barraScrittura.value = '';
        }
    });
    stampaMessaggi(IDUtente,destinatario);
}

const listaContatti = document.getElementById('listaContatti');
function trovaUtente(){
    fetch(urlBase + 'Server/trovaUtente.php')
        .then(risposta => risposta.json())
        .then(data => {
            data.forEach(utente => {
                if (utente.username == IDUtente) {
                    utenteID = utente.id;
                } else if (utente.username != IDUtente) {
                    const Contatti = document.createElement('li');
                    Contatti.textContent = utente.username;
                    listaContatti.appendChild(Contatti);
                    Contatti.addEventListener('click', () => {
                        IDUtenteScelto = utente.id;                       
                        utenteSceltoScritta.textContent = utente.username; 
                        chat.innerHTML = '';
                        stampaMessaggi(utenteID,IDUtenteScelto);
                    });
                }
            });
        })
        .catch(error => console.error('Errore durante la richiesta:', error));
}

function stampaMessaggi(utenteId,destinatario) {
    const data = {
        mittente: utenteId,
        destinatario: destinatario
    };
    fetch(urlBase + 'Server/messaggi.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(risposta => risposta.json())
    .then(data => {     
        data.forEach(messaggio => {
            VisualizzaMess(messaggio.mittente, messaggio.messaggio, messaggio.mittente == utenteID);
        });
    })
    .catch(error => console.error('Errore durante il caricamento dei messaggi:', error));
}

function VisualizzaMess(mittente, messaggio,messUtente) {   
    const mess = document.createElement('div'); 
    mess.classList.add('messaggino');
    if (messUtente) {
        mess.classList.add('messaginoInviato');
    } else {
        mess.classList.add('messagginoRicevuto');
    }
    const messagginoUtente = document.createElement('span');
    messagginoUtente.textContent = mittente + ': ';
    const testo = document.createElement('span');
    testo.classList.add('testo');
    testo.textContent = messaggio;
    mess.appendChild(messagginoUtente);
    mess.appendChild(testo);
    chat.appendChild(mess);
}