<?php
require_once "connessione.php";

$paginaHTML = file_get_contents("nuovoGiocatore.html");

use DB\DBAccess; //importa la classe DBAccess presente in "connessione"

$tagPermessi = '<em><strong><ul><li>'; //se ci fosse un tag non permesso, lo rimuove fino alla fine e si ha codice non valido
$messaggiPerForm = ''; //messaggi di errore per la form

//Variabili per il form
$nome = '';
$capitano = '';
$dataNascita = '';
$numeroMaglia = '';
$luogo = '';
$altezza = '';
$squadra = '';
$ruolo = '';
$magliaNazionale = '';
$punti = '';
$note = '';

function pulisciInput($value) {
    $value = trim($value); //trim() rimuove gli spazi bianchi (o altri caratteri) dall'inizio e dalla fine di una stringa
    $value = strip_tags($value); //strip_tags() rimuove le tag HTML e PHP da una stringa
    $value = htmlentities($value); //htmlentities() converte i caratteri speciali in entità HTML
    //se faccio prima "htmlentities", "strip_tags" non è più utile
    return $value;
}
function pulisciNote($value){
    global $tagPermessi;

    $value = trim($value); 
    $value = strip_tags($value, $tagPermessi); 
    return $value;
}

//per il controllo degli errori/input, si adotta come si vede il pattern matching

if(isset($_POST['submit'])){  //se è stato premuto il bottone "submit" all'interno della form
    $nome = pulisciInput($_POST['nome']); //pulisce il nome
    if (strlen($nome) == 0){
        $messaggiPerForm .= '<li>Nome e cognome non inseriti</li>';
    }
    else{
        if(preg_match("/\d/", $nome)){ //se il nome contiene un numero
            $messaggiPerForm .= '<li>Nome e cognome non possono contenere numeri</li>';
        }
    }

    $capitano = pulisciInput($_POST['capitano']); //pulisce il capitano

    $dataNascita = pulisciInput($_POST['nome']); //pulisce il nome
    if (strlen($dataNascita) == 0){
        $messaggiPerForm .= '<li>Data di nascita non inserita</li>';
    }
    else{
        if(!preg_match("/\d{4}\-\d{2}\-\d{2}/", $dataNascita)){ //se la data non è nel formato corretto (anno - mese - giorno)
            $messaggiPerForm .= '<li>La data di nascita non è nel formato corretto</li>';
        }
    }

    $numeroMaglia = pulisciInput($_POST['maglia']);
    if (strlen($numeroMaglia) == 0){
        $messaggiPerForm .= '<li>Numero di maglia non inserito</li>';
    }
    else{
        if(!(ctype_digit($numeroMaglia))){ //c_type_digit() controlla se la stringa contiene solo caratteri numerici
            $messaggiPerForm .= '<li>Il numero di maglia deve essere inserito come numero</li>';
        }
    }

    $luogo = pulisciInput($_POST['luogo']);
    if (strlen($luogo) == 0){
        $messaggiPerForm .= '<li>Luogo non inserito</li>';
    }
    else{
        if(preg_match("/\d/", $luogo)){
            $messaggiPerForm .= '<li>Il luogo non può contenere numeri</li>';
        }
    }

    $altezza = pulisciInput($_POST['altezza']);
    if (strlen($altezza) == 0){
        $messaggiPerForm .= '<li>Altezza non inserita</li>';
    }
    else{
        if(!(ctype_digit($altezza)) && ($altezza > 129)){
            $messaggiPerForm .= '<li>L\'altezza deve essere un numero maggiore di 130</li>';
        }
    }

    $squadra = pulisciInput($_POST['squadra']);
    if (strlen($squadra) == 0){
        $messaggiPerForm .= '<li>Squadra non inserita</li>';
    }
    else{
        if(preg_match("/\d/", $squadra)){
            $messaggiPerForm .= '<li>La squadra non può contenere numeri</li>';
        }
    }

    $ruolo = pulisciInput($_POST['ruolo']);
    if (strlen($ruolo) == 0){
        $messaggiPerForm .= '<li>Ruolo non inserito</li>';
    }
    else{
        if(preg_match("/\d/", $ruolo)){
            $messaggiPerForm .= '<li>Il ruolo non può contenere numeri</li>';
        }
    }

    $magliaNazionale = pulisciInput($_POST['magliaNazionale']);
    if (strlen($magliaNazionale) == 0){
        $messaggiPerForm .= '<li>Maglia nazionale non inserito</li>';
    }
    else{
        if(!(ctype_digit($magliaNazionale))){
            $messaggiPerForm .= '<li>Il numero di maglia nazionale deve essere inserito come numero</li>';
        }
    }

    $punti = pulisciInput($_POST['punti']);
    if (strlen($punti) == 0){
        $messaggiPerForm .= '<li>Punti non inseriti</li>';
    }
    else{
        if(!(ctype_digit($punti))){
            $messaggiPerForm .= '<li>I punti devono essere inseriti come numero</li>';
        }
    }

    $note = pulisciNote($_POST['note']);
    if (strlen($note) == 0){
        $messaggiPerForm .= '<li>Note non inserite</li>';
    }
    else{
        if(preg_match("/\d/", $note)){
            $messaggiPerForm .= '<li>Le note non possono contenere numeri</li>';
        }
    }

    $riconoscimenti = pulisciInput($_POST['riconoscimenti']);
    if (strlen($riconoscimenti) == 0){
        $messaggiPerForm .= '<li>Riconoscimenti non inseriti</li>';
    }
    else{
        if(preg_match("/\d/", $riconoscimenti)){
            $messaggiPerForm .= '<li>I riconoscimenti non possono contenere numeri</li>';
        }
    }

    if($messaggiPerForm == ""){ //se non ci sono messaggi di errore
        $connessione = new DBAccess();
        $connOK = $connessione->openDBConnection();
        if($connOK){
            //si può sia lavorare prendendo l'input che usando un array associativo
            $queryOK = $connessione->insertNewPlayer($nome, $cognome, $dataNascita, $numeroMaglia, $luogo, $altezza, $squadra, $ruolo, $magliaNazionale, $punti, $note, $riconoscimenti);
            if($queryOK){
                //sempre dare feedback all'utente anche quando le cose vanno bene
                //attenzione: tutti i messaggi di errore devono essere chiari, gli input devono essere controllati bene, 
                //non si deve disorientare l'utente e tutto deve essere accessibile
                //attenzione all'errore 404

                //L'area a cui si accede dopo il login e si deve entrare nella dashboard dell'utente (non in home)
                //occorre "premiare" l'utente, dicendogli cosa deve fare in più
                $messaggiPerForm = '<div id = "messageErrors"><p>L\'inserimento è avvenuto con successo</p></div>';
            }
            else{
                $messaggiPerForm = '<div id = "messageErrors"><p>Problema nell\'inserimento dei dati, controlla se hai
                usato caratteri speciali</p></div>';
            }
        }
        else{
            $messaggiPerForm = '<div id = "messageErrors"<p>I nostri sistemi sono al momento non funzionanti,
            ci scusiamo per il disagio</p></div>';
        }
    }
    else{
        $messaggiPerForm = '<div id = "messageErrors"><ul>' . $messaggiPerForm . '</ul></div>';
    }
}

$paginaHTML = str_replace("<messaggiForm />", $messaggiPerForm, $paginaHTML); //sostituisce il valore del segnaposto con il codice corrispondente
$paginaHTML = str_replace("<valoreNome />", $nome, $paginaHTML); //sostituisce il valore del segnaposto con il codice corrispondente
$paginaHTML = str_replace("<valData />", $dataNascita, $paginaHTML);
$paginaHTML = str_replace("<valLuogo />", $luogo, $paginaHTML);
$paginaHTML = str_replace("<valoreAltezza />", $altezza, $paginaHTML);
$paginaHTML = str_replace("<valoreSquadra />", $squadra, $paginaHTML);
$paginaHTML = str_replace("<valoreRuolo />", $ruolo, $paginaHTML);
$paginaHTML = str_replace("<valoreMagliaNazionale />", $magliaNazionale, $paginaHTML);
$paginaHTML = str_replace("<valorePunti />", $punti, $paginaHTML);
$paginaHTML = str_replace("<valoreNote />", $note, $paginaHTML);
$paginaHTML = str_replace("<valoreRiconoscimenti />", $riconoscimenti, $paginaHTML);
?>