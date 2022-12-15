<?php
use DB\DBAccess;

//require_once "connessione.php"; //require_once è come include ma se il file è già stato incluso non lo include nuovamente
//posso usare il path come ../ per tornare indietro di una cartella
//si usa invece una concatenazione di stringhe per fare in modo di muoversi tra le cartelle
//a prescindere dal sistema operativo

    require_once "..".DIRECTORY_SEPARATOR."connessione.php"; //DIRECTORY_SEPARATOR è una costante che contiene il separatore di directory del sistema operativo

    $paginaHTML = file_get_contents("squadra_php.html"); //legge il file squadra.html e lo mette in una stringa

    $connessione = new DBAccess(); //crea un oggetto di tipo DBAccess come handle per la connessione
    $stringaGiocatori = "";
    $giocatori = "";   

    $connOk = $connessione->openDBConnection(); //apre la connessione e la salva in connOk

    //Normalmente, come informatici siamo portati ad avere il caso positivo;
    //anche da un punto di vista architetturale, si deve fare in modo il ramo true sia il più probabile
    if($connOk){
        $giocatori = $connessione->getList(); //salva la lista dei giocatori in giocatori
        $connessione->closeDBConnection(); //chiude la connessione

        if(!$giocatori != null){
            $stringaGiocatori .= '<dl id="giocatori">'; //crea una stringa vuota

        foreach ($giocatori as $giocatore) { //Eseguiamo un ciclo per prendere ogni giocatore dal DB
            //Compito per casa: creare i vari dt e dd (serve una form)
            //Pagina inserisci giocatore (con i campi della squadra e mettere il campo "Capitano")

            //$stringaGiocatori .= '<dt>'.$giocatore['nome'].'</dt>'; //aggiunge il nome del giocatore
            //$stringaGiocatori .= '<dd>'.$giocatore['cognome'].'</dd>'; //aggiunge il cognome del giocatore
        }
    
            $stringaGiocatori .= '</dl>'; //aggiunge la chiusura della lista
        }
        else{
            $stringaGiocatori = "<p>Nessun giocatore presente</p>";
        }
    }
    else{
        //Occorre mettere il testo in forma paragrafo <p> per fare in modo che il browser lo interpreti come codice html
        $stringaGiocatori = "<p>I sistemi sono momentaneamente fuori servizio</p>"; 
        //se ci fosse un problema reale, chiaramente si cerca di contattare l'admin il prima possibile
    }

    echo str_replace("<listaGiocatori />", $stringaGiocatori, $paginaHTML); 
    //sostituisce la stringa <listaGiocatori /> con la stringa $stringaGiocatori cercando nella pagina HTML
?>