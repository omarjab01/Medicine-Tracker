<?php

require_once('./config/config.php');

// $user_id = $_SESSION['id'] ;

// echo $user_id;

$idUtenteLoggato = $_POST['id-utente'];

$nomeMedicina = $_POST['nome-medicina'];
$dosaggio = $_POST['dosaggio'];
$frequenza = $_POST['frequenza'];


$queryInsert = "INSERT INTO `medicine` (`nomeMedicina`, `dosaggio`, `frequenza`, `ID_Utente`) VALUES ('$nomeMedicina', '$dosaggio', '$frequenza', '$idUtenteLoggato')";

if($conn->query($queryInsert) === true){
    echo "Medicina Aggiunta!";
    session_start();
    header('Location: ../index.php');
}else{
    echo "Errore :(";
}

$conn->close();
?>
