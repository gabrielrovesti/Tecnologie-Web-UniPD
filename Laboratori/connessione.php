<?php
namespace DB;
class DBAccess{
    private const HOST_DB = "127.0.0.1";
    private const DATABASE_NAME = "grovesti";
    private const USERNAME = "grovesti";
    private const PASSWORD = "ahx4uyooPueC5nia";

    private $connection;

    public function openDBConnection(){
        // mysqli_report(MYSQLI_REPORT_ERROR); qui disabilita errori 
        // mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); qui disabilita errori e lancia eccezioni
        $this->connection = mysqli_connect(DBAccess::HOST_DB, DBAccess::USERNAME, DBAccess::PASSWORD, DBAccess::DATABASE_NAME); //crea una connessione con tutti i dati sopra
        
        if(mysqli_connect_errno()){ //se la connessione fallisce
            return false;  //ritorna false
        }
        else{
            return true; //altrimenti ritorna true
        }
    }

    public function getList(){
        $query = "SELECT * FROM giocatori ORDER BY ID ASC";
        //Non usare mai versioni di funzioni con "mysql" e non con "mysqli" perchè sono deprecate le prime
        //Motivazione: https://bugs.php.net/bug.php?id=35450
        $queryResult=mysqli_query($this->connection, $query) or die("Errore in openDBConnection: ".mysqli_error($this->connection)); //esegue la query e se fallisce ritorna un errore
        if (mysqli_num_rows($queryResult) == 0){ //se non ci sono righe di qualche risultato
            return null; //ritorna null
        }
        else{
            $result = array(); //altrimenti crea un array
            while($row = mysqli_fetch_assoc($queryResult)){ //mentre ci sono righe nel risultato
                array_push($result, $row); //aggiungi la riga all'array result
            }
            $queryResult->free(); //libero la memoria
            return $result; //ritorna la lista contenente tutti i risultati
        }
    }

    public function closeDBConnection(){
        if($this->connection != null){
            $this->connection->close();
        }
    }
    
}

?>