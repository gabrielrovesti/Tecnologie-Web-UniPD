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
            //creare i vari dt e dd

            $stringaGiocatori .= "<dt>" . $giocatore['nome'];
            if($giocatore['capitano']){
                $stringaGiocatori .= " - <em>Capitano</em>";
            }
            $stringaGiocatori .= "</dt>"
                . '<dd> <img src="' . $giocatore['immagine'] . '" alt=""/>'
                . '<dl class="giocatore"> <dt>Data di nascita</dt>'
                . '<dd>' . $giocatore['dataNascita'] . '</dd>'
                . '<dt>Luogo</dt>'
                . '<dd>' . $giocatore['luogo'] . '</dd>'
                . '<dt>Squadra</dt>'
                . '<dd>' . $giocatore['squadra'] . '</dd>'
                . '<dt>Ruolo</dt>'
                . '<dd>' . $giocatore['ruolo'] . '</dd>'
                . '<dt>Altezza</dt>'
                . '<dd>' . $giocatore['altezza'] . '</dd>'
                . '<dt>Maglia</dt>'
                . '<dd>' . $giocatore['maglia'] . '</dd>'
                . '<dt>Maglia in nazinale</dt>'
                . '<dd>' . $giocatore['magliaNazionale'] . '</dd>';

            if($giocatore['ruolo'] != 'Libero'){
                $stringaGiocatori .= '<dt>Punti totali </dt>';
            }
            else{
                $stringaGiocatori .= '<dt>Ricezioni</dt>';
            }
            $stringaGiocatori .= '<dd>' . $giocatore['punti'] . '</dd>';

            if ($giocatore['riconoscimenti']) {
                $stringaGiocatori .= '<dt class="Riconoscimenti">Riconoscimenti</dt>'
                    . '<dd>' . $giocatore['riconoscimenti'] . '</dd>';
            }

            if ($giocatore['note']) {
                $stringaGiocatori .= '<dt class="Riconoscimenti">Riconoscimenti</dt>'
                    . '<dd>' . $giocatore['note'] . '</dd>';
            }
            $stringaGiocatori .= '</dl></dd>';
        }
            $stringaGiocatori .= '</dl>'; //aggiunge la chiusura della lista
        }
        else{
            $stringaGiocatori = "<p>Nessun giocatore presente</p>";
        }
    }
    else{
        //Occorre mettere il testo in forma paragrafo <p> per fare in modo che il browser lo interpreti come codice html
        $stringaGiocatori="<span>Alcun giocatore è presente</span>"; #manda una mail all'amministratore per avvisarlo        
        //se ci fosse un problema reale, chiaramente si cerca di contattare l'admin il prima possibile
    }

    echo str_replace("<listaGiocatori />", $stringaGiocatori, $paginaHTML); 
    //sostituisce la stringa <listaGiocatori /> con la stringa $stringaGiocatori cercando nella pagina HTML
?>